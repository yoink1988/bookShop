<?php
namespace Models;

/**
 * Description of Authors
 *
 * @author yoink
 */
class Authors
{
	private $db;

	public function __construct()
	{
		$this->db = \database\Database::getInstance();
	}

    public function getAuthors($id=null)
    {
		$query = \database\QSelect::getInstance()->setColumns('id, name')
												->setTable('authors');
		if($id)
		{
			$id = $this->db->clearString($id);
			$query->setWhere("id = {$id}");
		}
        return $this->db->select($query);
    }

	public function addAuthor($params)
	{
		if(\Utils\Validator::validAuthName($params['name']))
		{
			$query = \database\QInsert::getInstance()->setTable('authors')
													->setParams($params);
			return $this->db->insert($query);
		}
		return false;
	}

	public function updateAuthor($params)
	{
		if(\Utils\Validator::validAuthName($params['name']))
		{
			$id = $this->db->clearString($params['id']);
			unset($params['id']);

			$query = \database\QUpdate::getInstance()->setTable('authors')
													->setParams($params)
													->setWhere("id = {$id}");
			return $this->db->update($query);
		}
		return false;
	}
	
	public function deleteAuthor($params)
	{
		$id = $this->db->clearString($params['id']);

		$query = \database\QDelete::getInstance()->setTable('authors')
												->setWhere("id = {$id}");

		if($this->db->delete($query))
		{
			return $this->deleteAuthLink($id);
		}
		return false;
	}

	private function deleteAuthLink($id)
	{
		$query = \database\QDelete::getInstance()->setTable('book_author')
												->setWhere("id_author = {$id}");

		return $this->db->delete($query);
	}

}
