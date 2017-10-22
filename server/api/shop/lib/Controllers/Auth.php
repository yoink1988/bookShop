<?php
namespace Controllers;
/**
 * Description of Auth
 *
 * @author yoink
 */
class Auth
{
    private $model;

    public function __construct()
    {
        $this->model = new \Models\Auth();
	}

	public function getAuth($params)
	{
		return $this->model->checkAuth($params);
	}

	public function putAuth($params)
	{
		if($this->model->checkLogData($params))
		{
			return $this->model->login($params);
		}
		return false;
	}

}
