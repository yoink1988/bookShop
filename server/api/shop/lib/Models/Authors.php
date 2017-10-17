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
		$res = array();
		$query = \database\QSelect::getInstance()->setColumns('id, name')
												->setTable('authors');
		if($id)
		{
			$id = $this->db->clearString($id);
			$query->setWhere("id = $id");
		}
        $res = $this->db->select($query);
		return $res;
    }

	public function addAuthor($params)
	{
		$query = \database\QInsert::getInstance()->setTable('authors')
												->setParams($params);
		 return $this->db->insert($query);
	}

	public function updateAuthor($id, $params)
	{
		$id = $this->db->clearString($id);

		$query = \database\QUpdate::getInstance()->setTable('authors')
												->setParams($params)
												->setWhere("id = $id");
		return $this->db->update($query);
	}
	
	public function deleteAuthor($id)
	{
		$id = $this->db->clearString($id);

		$query = \database\QDelete::getInstance()->setTable('authors')
												->setWhere("id = $id");
		return $this->db->delete($query);
	}

}
