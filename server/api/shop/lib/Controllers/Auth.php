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

	public function putAuth($params)
	{
		if((!empty($params['login']) && (!empty($params['pass']))))
		{

			setcookie('qqqqqqqqq', 'qqqqqqqqqqqqqqq', time() + 60*60*24*30, '/');
			echo'qweqwe';
		}
	}

}
