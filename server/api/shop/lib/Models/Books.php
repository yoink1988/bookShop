<?php
namespace Models;

/**
 * Description of Books
 *
 * @author yoink
 */
class Books
{
	private $db;
	public function __construct()
	{
		$this->db = \database\Database::getInstance();
	}
	public function getBooks($id = null)
	{
    

		
//		$query = \database\QSelect::getInstance()->setColumns('b.id as id,'
//															. ' b.title, b.description, '
//															. 'b.price, b.discount')
//														->setTable('books b')
//														->setOrder('b.id');


		$query = \database\QSelect::getInstance()->setColumns('b.id as id,'
															. ' b.title, b.description, '
															. 'b.price, b.discount,'
															. ' a.id as a_id,'
															. ' a.name as a_name, '
															. 'g.id as g_id,'
															. 'g.name as g_name')
												->setTable('books b')
												->setjoin('left join book_author ba '
														. 'on b.id = ba.id_book '
														. 'left join authors a '
														. 'on ba.id_author = a.id '
														. 'left join book_genre bg '
														. 'on b.id = bg.id_book '
														. 'left join genres g '
														. 'on bg.id_genre = g.id')

														->setOrder('b.id');
		if($id)
        {
            $id = $this->db->clearString($id);
			$query->setWhere("b.id = $id");
        }

		$res = $this->db->select($query);
//		return $res;

		return $this->uniq($res);
//		var_dump($un);
	}
	
	public function addBook($params)
	{
//		$params = $this->db->clearParams($params);

		$query  = \database\QInsert::getInstance()->setTable('books')
												->setParams($params);
		$res = $this->db->insert($query);

		var_dump($res);
	}

	public function updateBook($id, $params)
	{
		$query = \database\QUpdate::getInstance()->setTable('books')
												->setParams($params)
												->setWhere("id = $id");
		$res = $this->db->update($query);
		var_dump($res);
	}

	public function deleteBook($id)
	{
		$query = \database\QDelete::getInstance()->setTable('books')
												->setWhere("id = $id");
		$res = $this->db->delete($query);
		var_dump($res);
	}

//	private function un($res)
//	{
//		$unic = array();
//		foreach($res as $n => $book)
//		if(!isset($unic[$n]))
//		{
//			$unic[$n] = $book;
//		}
//		else
//		{
//			$unic[$n] = array_merge($unic[$n], $book);
//		}
//		return $unic;
//	}


//	private function uniq($res)
//	{
//		$b=0;
//		$unic = array();
//		foreach($res as $book)
//		{
//
//			if(!isset($unic[$b]))
//			{
//				$unic[$b] = $book;
//				$a=0;
//				$g=0;
//
//			}
//			if($unic[$b]['id'] == $book['id'])
//			{
//
//				if(!isset($unic[$b]['authors']) || !isset($unic[$b]['genres']))
//				{
//					$unic[$b]['authors'][$a]['id'] = $book['a_id'];
//					$unic[$b]['authors'][$a]['name'] = $book['a_name'];
//					unset($unic[$b]['a_id']);
//					unset($unic[$b]['a_name']);
//					$unic[$b]['genres'][$g]['id'] = $book['g_id'];
//					$unic[$b]['genres'][$g]['name'] = $book['g_name'];
//					unset($unic[$b]['g_id']);
//					unset($unic[$b]['g_name']);
//				}
//				else
//				{
//					if($unic[$b]['authors'][$a]['id'] != $book['a_id'] )
//					{
//					$a++;
//					$unic[$b]['authors'][$a]['id'] = $book['a_id'];
//					$unic[$b]['authors'][$a]['name'] = $book['a_name'];
//					}
//					if($unic[$b]['genres'][$g]['id'] != $book['g_id'] )
//					{
//					$g++;
//					$unic[$b]['genres'][$g]['id'] = $book['g_id'];
//					$unic[$b]['genres'][$g]['name'] = $book['g_name'];
//					}
//
//				}
//
//			}
//			else
//			{
//				$b++;
//
//			}
//
//		}
//		return $unic;
//	}
	private function uniq($res)
	{
		$unic = array();
		foreach($res as $book)
		{
			$b=0;
			if(!isset($unic[$book['id']]))
			{
				$unic[$book['id']] = $book;
				$a=0;
				$g=0;
			}
			if($unic[$book['id']]['id'] == $book['id'])
			{

				if(!isset($unic[$book['id']]['authors']))
				{
					$unic[$book['id']]['authors'][$a]['id'] = $book['a_id'];
					$unic[$book['id']]['authors'][$a]['name'] = $book['a_name'];
					unset($unic[$book['id']]['a_id']);
					unset($unic[$book['id']]['a_name']);
				}
				else
				{
					if($unic[$book['id']]['authors'][$a]['id'] != $book['a_id'] )
					{
					$a++;
					$unic[$book['id']]['authors'][$a]['id'] = $book['a_id'];
					$unic[$book['id']]['authors'][$a]['name'] = $book['a_name'];
					}

				}
				if(!isset($unic[$book['id']]['genres']))
				{
					$unic[$book['id']]['genres'][$g]['id'] = $book['g_id'];
					$unic[$book['id']]['genres'][$g]['name'] = $book['g_name'];
					unset($unic[$book['id']]['g_id']);
					unset($unic[$book['id']]['g_name']);
				}
				else
				{
					if($unic[$book['id']]['genres'][$g]['id'] != $book['g_id'] )
					{
					$g++;
					$unic[$book['id']]['genres'][$g]['id'] = $book['g_id'];
					$unic[$book['id']]['genres'][$g]['name'] = $book['g_name'];
					}
				}
			}
		}

		$indexed = array();
		foreach ($unic as $item)
		{
			$indexed[] = $item;
		}
		return $indexed;
	}




}
