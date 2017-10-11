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
        if($params)
		{
			$res = $this->model->addAuthor($params);
		}
		else
		{
			throw new \Exception('Net imeni avtora');
		}
    }
	public function putAuthors($params)
	{
		if(!empty($params['id']))
		{
			$id = array_shift($params);
			$this->model->updateAuthor($id,$params);
		}
		else
		{
			throw new \Exception('net Id -author-');
		}
	}
	public function deleteAuthos($params)
	{
		if(!empty($params['id']))
		{
			$id = $params['id'];
			$this->model->deleteAuthor($id);
		}
		else
		{
			throw new \Exception('net Id -delete--auth-');
		}
	}
}
