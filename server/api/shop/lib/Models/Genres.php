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

    public function getGenres($id = null)
    {
        $query = \database\QSelect::getInstance()->setColumns('id, name')
                                                ->setTable('genres');
		if($id)
		{
			$id = $this->db->clearString($id);
			$query->setWhere("id = $id");
		}

        $res = $this->db->select($query);
        return $res;
    }
	public function addGenre($params)
	{
		$query = \database\QInsert::getInstance()->setTable('genres')
												->setParams($params);
		$res = $this->db->insert($query);
		dump($res);
	}

	public function updateGenre($id, $params)
	{
		$query = \database\QUpdate::getInstance()->setTable('genres')
												->setParams($params)
												->setWhere("id = $id");
		$res = $this->db->update($query);
		var_dump($res);
	}
	public function deleteGenre($id)
	{
		$query = \database\QDelete::getInstance()->setTable('genres')
												->setWhere("id = $id");
		$res = $this->db->delete($query);
		var_dump($res);
	}
}
