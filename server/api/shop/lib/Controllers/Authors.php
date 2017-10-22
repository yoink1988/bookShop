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
		return $this->model->getAuthors($id);
	}

    public function postAuthors($params)
    {
		return $this->model->addAuthor($params);
    }

	public function putAuthors($params)
	{
		return $this->model->updateAuthor($params);
	}
	
	public function deleteAuthors($params)
	{
		return $this->model->deleteAuthor($params);
	}
}
