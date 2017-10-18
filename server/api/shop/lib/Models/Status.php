<?php
namespace Models;
/**
 * Description of Status
 *
 * @author yoink
 */
class Status
{
	private $db;

	public function __construct()
	{
		$this->db = \database\Database::getInstance();
	}

	public function getStatus($id=null)
	{
		$id = $id;
		$query = \database\QSelect::getInstance()->setColumns('id, name')
												->setTable('status');
		if($id)
		{
			$id = $this->db->clearString($id);
			$query->setWhere("id = $id");
		}
        return $this->db->select($query);

	}
}
