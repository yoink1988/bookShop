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
		return $this->model->addBook($params);
	}

	public function putBooks($params)
	{
        return $this->model->updateBook($params);
	}
	public function deleteBooks($params)
	{
		if(!empty($params['id']))
		{
			$id = $params['id'];
			$this->model->deleteBook($id);
		}
	}
}
