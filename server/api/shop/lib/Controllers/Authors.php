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
		if(\Models\Auth::isAdmin())
		{
			return $this->model->addAuthor($params);
		}
		throw new \Exception(403);
    }

	public function putAuthors($params)
	{
		if(\Models\Auth::isAdmin())
		{
			return $this->model->updateAuthor($params);
		}
		throw new \Exception(403);
	}
	
	public function deleteAuthors($params)
	{
		if(\Models\Auth::isAdmin())
		{
			return $this->model->deleteAuthor($params);
		}
		throw new \Exception(403);
	}
}
