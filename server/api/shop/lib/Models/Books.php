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
//		file_put_contents('sql.txt', print_r($this->uniq($res), true));
		if($res)
		{
			return $this->uniq($res);
		}
		else
		{
			return 'no books found';
		}

	}
	
	public function addBook($params)
	{
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

	private function uniq($res)
	{
		$unic = array();
		foreach($res as $book)
		{
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
					if( !in_array( array("id" => "{$book['a_id']}", "name" => "{$book['a_name']}"), $unic[$book['id']]['authors']))
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
					if( !in_array( array("id" => "{$book['g_id']}", "name" => "{$book['g_name']}"), $unic[$book['id']]['genres']))
					{
					$g++;
					$unic[$book['id']]['genres'][$g]['id'] = $book['g_id'];
					$unic[$book['id']]['genres'][$g]['name'] = $book['g_name'];
					}
				}
			}
		}
		return array_values($unic);
	}




}
