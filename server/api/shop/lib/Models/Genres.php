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
	public function addGenre(array $params)
	{
		if(\Utils\Validator::validGenreName($params['name']))
		{
			if(!$this->isGenreExists($params['name']))
			{
				$query = \database\QInsert::getInstance()->setTable('genres')
														->setParams($params);

				return $this->db->insert($query);
			}
		}
		return false;
	}

	private function isGenreExists($name)
	{
		$name = $this->db->clearString($name);
		$q = \database\QSelect::getInstance()->setColumns('name')
											->setTable('genres')
											->setWhere("name = {$name}");

		return $this->db->select($q);
	}

	public function updateGenre(array $params)
	{
		if(\Utils\Validator::validGenreName($params['name']))
		{
			$id = $this->db->clearString($params['id']);
			unset($params['id']);
			
			$query = \database\QUpdate::getInstance()->setTable('genres')
													->setParams($params)
													->setWhere("id = {$id}");
			return $this->db->update($query);
		}
		return false;
	}
	
	public function deleteGenre($params)
	{
		$id = $this->db->clearString($params['id']);

		$query = \database\QDelete::getInstance()->setTable('genres')
												->setWhere("id = {$id}");
		
		if($this->db->delete($query))
		{
			return $this->deleteGenreLink($id);
		}
		return false;
	}

	private function deleteGenreLink($id)
	{
		$query = \database\QDelete::getInstance()->setTable('book_genre')
												->setWhere("id_genre = {$id}");
		return $this->db->delete($query);
	}
}
