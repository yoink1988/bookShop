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

        if($res = $this->model->getUsers($id))
		{
			\Utils\Response::SuccessResponse(200);
			\Utils\Response::doResponse($res);
		}
		else
		{
			\Utils\Response::SuccessResponse(200);
			\Utils\Response::doResponse('Not Found');
		}
    }

    public function postUsers($params)
    {
		if(!empty($params['name']) && !empty($params['login']) && (!empty($params['pass'])))
		{
			$params['pass'] = md5($params['pass']);
			$params['status'] = '1';
			$params['role'] = 'user';
			if($this->model->addUser($params))
			{
				\Utils\Response::SuccessResponse(200);
				\Utils\Response::doResponse('Success');
			}
		}
		else
		{
			\Utils\Response::SuccessResponse(200);
			\Utils\Response::doResponse('All fields are required');
		}
    }

	//login
    public function putUsers($params)
    {
		if(!empty($params['id']))
		{
			$uId = $params['id'];
			unset($params['id']);

			if(isset($params['pass']) && (!empty(trim($params['pass']))))
			{
				$params['pass'] = md5($params['pass']);
			}
			if($this->model->updateUser($uId, $params))
			{
				\Utils\Response::SuccessResponse(200);
				\Utils\Response::doResponse('Updated');
			}
		}
    }


}
