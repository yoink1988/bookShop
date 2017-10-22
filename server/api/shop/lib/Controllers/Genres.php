<?php
namespace Controllers;

/**
 * Description of Genres
 *
 * @author yoink
 */
class Genres
{
	private $model;

	public function __construct()
	{
		$this->model = new \Models\Genres();
	}
    
    public function getGenres($params = null)
    {
		$id = $params;
		if($params['id'])
		{
			$id = $params['id'];
		}
        return $this->model->getGenres($id);
    }

    public function postGenres($params)
    {
		return $this->model->addGenre($params);
    }

	public function putGenres($params)
	{
		return $this->model->updateGenre($params);
	}
	
	public function deleteGenres($params)
	{
		return $this->model->deleteGenre($params);
	}
}
