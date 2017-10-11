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
        $res = $this->model->getGenres($id);
		if($res)
		{
			\Utils\Response::SuccessResponse(200);
			\Utils\Response::doResponse($res);
		}
    }

    public function postGenres($params)
    {
       if($params)
		{
			$res = $this->model->addGenre($params);
		}
		else
		{
			throw new \Exception('Net imeni janra');
		}
    }
	public function putGenres($params)
	{
		if(!empty($params['id']))
		{
			$id = array_shift($params);
			$this->model->updateGenre($id,$params);
		}
		else
		{
			throw new \Exception('net Id -genre-');
		}
	}
	public function deleteGenres($params)
	{
		if(!empty($params['id']))
		{
			$id = $params['id'];
			$this->model->deleteGenre($id);
		}
		else
		{
			throw new \Exception('net Id -delete--genre-');
		}
	}
}
