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
		if(!isset($params['status']))
		{
			$params['status'] = 1;
		}
		return $this->model->getBooks($params);
	}
	
	public function postBooks(array $params)
	{
		if(\Models\Auth::isAdmin())
		{
			return $this->model->addBook($params);
		}
		throw new \Exception(403);
	}

	public function putBooks($params)
	{
		if(\Models\Auth::isAdmin())
		{
			return $this->model->updateBook($params);
		}
		throw new \Exception(403);
	}

	public function deleteBooks($params)
	{
		if(\Models\Auth::isAdmin())
		{
			if(!empty($params['id']))
			{
				$id = $params['id'];
				$this->model->deleteBook($id);
			}
		}
		throw new \Exception(403);
	}
}
