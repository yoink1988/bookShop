<?php
namespace Controllers;
/**
 * Description of Book
 *
 * @author yoink
 */
class Books
{
	public $model;
	public function __construct()
	{
		$this->model = new \Models\Books();

	}

	public function getBooks($params=null)
    {
		$id = $params;
		if(isset($params['id']))
		{
			$id = $params['id'];
		}

		$res = $this->model->getBooks($id);
//		var_dump($res);
		if($res)
		{
			\Utils\Response::SuccessResponse(200);
			\Utils\Response::doResponse($res);
		}
	}
	
	public function postBooks($params)
	{
		if(count($params) == 4)
		{
			$this->model->addBook($params);
		}
		else
		{
			throw new \Exception('not All Data in Post');
		}
	}

	public function putBooks($params)
	{
		if(!empty($params['id']))
		{
			$id = array_shift($params);
			$this->model->updateBook($id,$params);
		}
		else
		{
			throw new \Exception('net Id');
		}

	}
	public function deleteBooks($params)
	{
		if(!empty($params['id']))
		{
			$id = $params['id'];
			$this->model->deleteBook($id);
		}
		else
		{
			throw new \Exception('net Id -delete-');
		}
	}
}
