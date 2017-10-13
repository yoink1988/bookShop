<?php
namespace Models;
/**
 * Description of Auth
 *
 * @author yoink
 */
class Auth
{

    private $db;
    public function __construct()
    {
        $this->db = \database\Database::getInstance();
    }

	public function checkLogData($data)
	{
		$q = \database\QSelect::getInstance()->setColumns('pass, status')
												->setTable('users')
												->setWhere("login = {$this->db->clearString($data['login'])}");

		$res = $this->db->select($q);
		if(!$res)
		{
			return false;
		}

		if($res[0]['pass'] == md5($data['pass']) && ($res[0]['status'] != '0'))
		{
			return true;
		}
		return false;
	}

	public function login($params)
	{

		$q = \database\QUpdate::getInstance()->setTable('users')->setParams(array('hash' => "{$params['hash']}"))
																->setWhere("login = {$this->db->clearString($params['login'])}");
					
		$res = $this->db->update($q);
		if($res)
		{

			$q = \database\QSelect::getInstance()->setColumns('id, name, role, discount, hash')->setTable('users')
												->setWhere("login = {$this->db->clearString($params['login'])} "
												. "and pass = {$this->db->clearString(md5($params['pass']))}");


			return $this->db->select($q);
		}
		else
		{
			echo $this->db->getError();
		}


	}

	public function checkAuth($params)
	{
		$q = \database\QSelect::getInstance()->setColumns('hash, status')->setTable('users')
											->setWhere("id = {$this->db->clearString($params['id'])}"
											. " and hash = {$this->db->clearString($params['hash'])}");

		$res = $this->db->select($q);
		if(($res[0]['hash'] == $params['hash']) && $res[0]['status'] != '0')
		{
			$res = $this->getUserData($params['id']);
			return $res;
		}
		else
		{
			throw new Exception('401','NOT AUTORIZED');
		}
	}

//	public function logOut($id)
//	{
//		$q = \database\QDelete::getInstance()->setC
//	}

	public function getUserData($id)
	{
		$q = \database\QSelect::getInstance()->setTable('users')->setColumns('id, name, role, discount, hash')
											->setWhere("id = {$this->db->clearString($id)}");

		return $this->db->select($q);
	}

}
