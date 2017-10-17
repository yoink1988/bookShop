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

        return $this->db->select($query);
    }
	public function addGenre($params)
	{
		$query = \database\QInsert::getInstance()->setTable('genres')
												->setParams($params);
		
		return $this->db->insert($query);
	}

	public function updateGenre($id, $params)
	{
		$id = $this->db->clearString($id);
		
		$query = \database\QUpdate::getInstance()->setTable('genres')
												->setParams($params)
												->setWhere("id = $id");
		return $this->db->update($query);
	}
	
	public function deleteGenre($id)
	{
		$id = $this->db->clearString($id);

		$query = \database\QDelete::getInstance()->setTable('genres')
												->setWhere("id = $id");
		return $this->db->delete($query);
	}
}
