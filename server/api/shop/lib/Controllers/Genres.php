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
       if(!empty($params['name']))
		{
			if($this->model->addGenre($params))
			{
				\Utils\Response::SuccessResponse(200);
				\Utils\Response::doResponse('Added');
			}
		}
		else
		{
			\Utils\Response::SuccessResponse(200);
			\Utils\Response::doResponse('Check name field');
		}
    }
	public function putGenres($params)
	{
		if(!empty((int)$params['id']) && !empty($params['name']))
		{
			$id = array_shift($params);

			if($this->model->updateGenre($id, $params))
			{
				\Utils\Response::SuccessResponse(200);
				\Utils\Response::doResponse('Renamed');
			}
		}
		else
		{
			\Utils\Response::SuccessResponse(200);
			\Utils\Response::doResponse('Check name field');
		}
	}
	public function deleteGenres($params)
	{
		if(!empty((int)$params['id']))
		{
			$id = $params['id'];

			if($this->model->deleteGenre($id))
			{
				if($this->model->deleteGenreLink($id))
				{
					\Utils\Response::SuccessResponse(200);
					\Utils\Response::doResponse('Deleted');
				}
			}
		}
		else
		{
			\Utils\Response::SuccessResponse(200);
			\Utils\Response::doResponse('Select Genre to delete');
		}
	}
}
