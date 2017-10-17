<?php
namespace Controllers;

/**
 * Description of Authors
 *
 * @author yoink
 */
class Authors
{
	public $model;

	public function __construct()
	{
		$this->model = new \Models\Authors();
	}

	public function getAuthors($params=null)
	{
		$id = $params;
		if(isset($params['id']))
		{
			$id = $params['id'];
		}
		$res = $this->model->getAuthors($id);
		
		if($res)
		{
			\Utils\Response::SuccessResponse(200);
			\Utils\Response::doResponse($res);
		}
		else
		{
			
		}
	}

    public function postAuthors($params)
    {
        if(!empty($params['name']))
		{
			if($this->model->addAuthor($params))
			{
				\Utils\Response::SuccessResponse(200);
				\Utils\Response::doResponse('Added');
			}
		}
		else
		{
			\Utils\Response::SuccessResponse(200);
			\Utils\Response::doResponse('Check Name Field');
		}
    }


	public function putAuthors($params)
	{
		if((!empty((int)$params['id'])) && (!empty($params['name'])))
		{
			$id = array_shift($params);
			if($this->model->updateAuthor($id, $params))
			{
				\Utils\Response::SuccessResponse(200);
				\Utils\Response::doResponse('Renamed');
			}
		}
		else
		{
			\Utils\Response::SuccessResponse(200);
			\Utils\Response::doResponse('Check Name Field');
		}
	}
	public function deleteAuthors($params)
	{

		if(!empty($params['id']))
		{
			$id = $params['id'];
			if($this->model->deleteAuthor($id))
			{
				\Utils\Response::SuccessResponse(200);
				\Utils\Response::doResponse('Deleted');
			}
		}
		else
		{
			\Utils\Response::SuccessResponse(200);
			\Utils\Response::doResponse('Select Author to delete');
		}
	}
}
