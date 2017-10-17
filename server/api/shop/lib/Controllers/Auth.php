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
		if((!empty($params['id'])) && (!empty($params['hash'])))
		{
			$res = $this->model->checkAuth($params);

			if($res)
			{
				\Utils\Response::SuccessResponse(200);
				\Utils\Response::doResponse($res);
			}
			else
			{
				\Utils\Response::SuccessResponse(200);
				\Utils\Response::doResponse('NE ZALOGINEN');
			}
		}
		else
		{
			throw new \Exception('Ne Zaloginen',403);
		}
	}

	public function putAuth($params)
	{
		if($params['login'] && $params['pass'])
		{
			if($this->model->checkLogData($params))
			{

				$params['hash'] = $this->generateHash(10);

				$res = $this->model->login($params);
				if($res)
				{
					\Utils\Response::SuccessResponse(200);
					\Utils\Response::doResponse($res);
				}
			}
			else
			{
//				\Utils\Response::SuccessResponse(200);
				\Utils\Response::doResponse('incorrect login or pass');
			}

		}
		else
		{
			\Utils\Response::doResponse('incorrect login or pass');
		}
	}

//	public function deleteAuth($params)
//	{
//		if(!empty($params['id']))
//		{
//			$this->model->logOut($params['id']);
//		}
//	}

	private function generateHash($length=10)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
        $code = "";
        $clen = strlen($chars) - 1;
        while (strlen($code) < $length)
        {
            $code .= $chars[mt_rand(0,$clen)];
        }
        return $code;
    }

}
