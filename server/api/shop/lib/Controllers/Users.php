<?php
namespace Controllers;
/**
 * Description of Users
 *
 * @author yoink
 */
class Users
{
    private $model;
    
    public function __construct()
    {
        $this->model = new \Models\Users();
    }

    public function getUsers($params=null)
    {
		$id = $params;
		if(isset($params['id']))
		{
			$id = $params['id'];
		}

        return $this->model->getUsers($id);
    }

    public function postUsers($params)
    {
		return $this->model->addUser($params);
    }


    public function putUsers($params)
    {
		return $this->model->updateUser($params);
    }

	


}
