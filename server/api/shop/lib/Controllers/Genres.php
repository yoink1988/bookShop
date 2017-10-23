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
		if(\Models\Auth::isAdmin())
		{
			return $this->model->addGenre($params);
		}
		throw new \Exception(403);
    }

	public function putGenres($params)
	{
		if(\Models\Auth::isAdmin())
		{
			return $this->model->updateGenre($params);
		}
		throw new \Exception(403);
	}
	
	public function deleteGenres($params)
	{
		if(\Models\Auth::isAdmin())
		{
			return $this->model->deleteGenre($params);
		}
		throw new \Exception(403);		
	}
}
