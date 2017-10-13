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
        $this->model->getUsers($params=null);
    }

    public function postUsers($params)
    {
//		file_put_contents('tempp.txt', print_r($params, true));
		if(!empty($params['name']) && !empty($params['login']) && (!empty($params['pass'])))
		{
			//valid
			//if()
			$params['pass'] = md5($params['pass']);
			$params['status'] = '1';
			$params['role'] = 'user';
//			$params['hash'] = $this->generateHash();
        $this->model->addUser($params);
		}
		else
		{
			echo 'aqweqweqw';
		}
    }

	//login
    public function putUsers($params)
    {
		
        $this->model->updateUsers($params);
    }


}
