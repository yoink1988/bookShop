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

	public function postGenres(){}
	public function putGenres(){}
	public function deleteGenres(){}
}