<?php
namespace Models;

/**
 * Description of Genres
 *
 * @author yoink
 */
class Genres
{
	private $db;

	public function __construct()
	{
		$this->db = \database\Database::getInstance();
    }

    public function getGenres($params = null)
    {
        $query = \database\QSelect::getInstance()->setColumns('id, name')
                                                ->setTable('genres');

        $res = $this->db->select($query);
        dump($res);
    }

}
