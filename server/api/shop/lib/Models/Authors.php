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

    public function getAuthors()
    {
        $query = \database\QSelect::getInstance()->setColumns('id, name')
            ->setTable('authors');

        $res = $this->db->select($query);
        dump($res);
    }

}
