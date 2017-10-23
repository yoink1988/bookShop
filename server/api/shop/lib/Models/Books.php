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
	public function getBooks($params = null)
	{
		$query = \database\QSelect::getInstance()->setColumns('b.id as id,'
															. ' b.title, b.description, '
															. 'b.price, b.discount, b.status,'
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

		if(isset($params['id']))
		{
			$id = $this->db->clearString($params['id']);
			if($params['status'] != 'all')
			{
				$status = $this->db->clearString($params['status']);
				$query->setWhere("b.id = {$id} and b.status = {$status}");
			}
			else
			{
				$query->setWhere("b.id = {$id}");
			}
		}
		else
		{
			if($params['status'] != 'all')
			{
				$status = $this->db->clearString($params['status']);
				$query->setWhere("b.status = {$status}");
			}
		}

		if($res = $this->db->select($query))
		{
			return $this->uniq($res);
		}

		return false;
	}
	
	public function addBook($params)
	{
		if(!\Utils\Validator::validBookName($params['book']['title']))
		{
			return 'Check Title field';
		}
		if(!\Utils\Validator::validDescript($params['book']['description']))
		{
			return 'Check Description field';
		}
		if(!\Utils\Validator::validPrice($params['book']['price']))
		{
			return 'Check Price field';
		}
		if(!\Utils\Validator::validDiscount($params['book']['discount']))
		{
			return 'Check Discount field';
		}

		$query  = \database\QInsert::getInstance()->setTable('books')
												->setParams($params['book']);
		if($this->db->insert($query))
		{
			$id = $this->db->getLastInsertID();
			if($this->appendAuthors($params['authors'], $id) && $this->appendGenres($params['genres'], $id))
			{
				return true;
			}
			return false;
		}
	}

	private function appendAuthors(array $authorIds, $bId)
	{
		if(empty($authorIds))
		{
			return true;
		}
		$err = 0;
		foreach ($authorIds as $aId)
		{
			if(!$this->addAuthLink(array('id_book' => $bId, 'id_author' => $aId)))
			{
				$err++;
			}
		}
		if($err == 0)
		{
			return true;
		}
		return false;
	}

	private function addAuthLink(array $params)
	{
		
		$q = \database\QInsert::getInstance()->setTable('book_author')
											->setParams($params);

		return $this->db->insert($q);
	}

	private function appendGenres(array $gereIds, $bId)
	{
		if(empty($gereIds))
		{
			return true;
		}
		$err = 0;
		foreach ($gereIds as $gId)
		{
			if(!$this->addGenreLink(array('id_book' => $bId, 'id_genre' => $gId)))
			{
				$err++;
			}
		}
		if($err == 0)
		{
			return true;
		}
		return false;
	}

	private function addGenreLink(array $params)
	{
		$q = \database\QInsert::getInstance()->setTable('book_genre')
											->setParams($params);

		return $this->db->insert($q);
	}

	public function updateBook($params)
	{
		if(!\Utils\Validator::validBookName($params['book']['title']))
		{
			return 'Check Title field';
		}
		if(!\Utils\Validator::validDescript($params['book']['description']))
		{
			return 'Check Description field';
		}
		if(!\Utils\Validator::validPrice($params['book']['price']))
		{
			return 'Check Price field';
		}
		if(!\Utils\Validator::validDiscount($params['book']['discount']))
		{
			return 'Check Discount field';
		}

		$bookParams = $params['book'];
		$id = $params['book']['id'];
		unset($params['book']);
		unset($bookParams['id']);

		$query = \database\QUpdate::getInstance()->setTable('books')
												->setParams($bookParams)
												->setWhere("id = {$id}");
		if($this->db->update($query))
		{
			if($this->appendAuthors($params['authToAdd'], $id)
			&& $this->appendGenres($params['genToAdd'], $id)
			&& $this->unsetAuthors($params['authToDel'], $id)
			&& $this->unsetGenres($params['genToDel'], $id))
			{
				return true;
			}
		}
		return false;
    }

	private function unsetAuthors(array $authorIds, $bId)
	{
		if(empty($authorIds))
		{
			return true;
		}
		$err = 0;
		foreach ($authorIds as $aId)
		{
			if(!$this->delAuthLink($bId, $aId))
			{
				$err++;
			}
		}
		if($err == 0)
		{
			return true;
		}
		return false;
	}
	private function unsetGenres(array $genreIds, $bId)
	{
		if(empty($genreIds))
		{
			return true;
		}
		$err = 0;
		foreach ($genreIds as $gId)
		{
			if(!$this->delGenLink($bId, $gId))
			{
				$err++;
			}
		}
		if($err == 0)
		{
			return true;
		}
		return false;
	}

    private function delAuthLink($bId, $aId)
    {
        $bId = $this->db->clearString($bId);
        $aId = $this->db->clearString($aId);
        $query = \database\QDelete::getInstance()->setTable('book_author')
            ->setWhere("id_book = {$bId} and id_author = {$aId}");

        return $this->db->delete($query);
    }

    private function delGenLink($bId, $gId)
    {
        $bId = $this->db->clearString($bId);
        $gId = $this->db->clearString($gId);

        $query = \database\QDelete::getInstance()->setTable('book_genre')
                                                ->setWhere("id_book = {$bId} and id_genre = {$gId}");

        return $this->db->delete($query);
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
