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
		$this->model->getAuthors($params);
	}

    public function postAuthors()
    {
        
    }
	public function putAuthors(){}
	public function deleteAuthors(){}
}
