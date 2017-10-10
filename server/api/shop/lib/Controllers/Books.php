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
		$this->model->getBooks($params);
//		echo 'getBooks';
	}
	
	public function postBooks($params)
	{
//		$this->model->addBook();
	}
	public function putBooks(){}
	public function deleteBooks(){}
}
