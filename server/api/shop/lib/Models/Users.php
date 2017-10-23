<?php
namespace Models;
/**
 * Description of Users
 *
 * @author yoink
 */
class Users
{
    private $db;
    public function __construct()
    {
        $this->db = \database\Database::getInstance();
    }

    public function getUsers($id = null)
    {
        $query = \database\QSelect::getInstance()->setColumns('id, name, login,'.
                                                'discount, status, role, hash')
                                                ->setTable('users');
		if($id)
		{
			$id = $this->db->clearString($id);
			$query->setWhere("id = {$id}");
		}
        return $this->db->select($query);
    }
	
    public function addUser($params)
    {
		if(!\Utils\Validator::validName($params['name']))
		{
			return 'Invalid Name';
		}
		if(!\Utils\Validator::validEmail($params['login']))
		{
			return 'Invalid Email';
		}
		if(!\Utils\Validator::validPassword($params['pass']))
		{
			return 'Invalid Password';
		}

		$params['pass'] = md5($params['pass']);
		$params['status'] = '1';
		$params['role'] = 'user';

        $query = \database\QInsert::getInstance()->setTable('users')
												->setParams($params);

		
        if($this->db->insert($query))
		{
			return true;
		}
		return false;
    }

	public function updateUser($params)
	{
		if(!\Utils\Validator::validName($params['name']))
		{
			return 'Invalid Name';
		}
		if(!\Utils\Validator::validEmail($params['login']))
		{
			return 'Invalid Email';
		}
		if(!\Utils\Validator::validDiscount($params['discount']))
		{
			return 'Discount limit is 50%';
		}

		if(isset($params['pass']))
		{
			if(!\Utils\Validator::validPassword($params['pass']))
			{
				return 'Invalid Password';
			}
			$params['pass'] = md5($params['pass']);
		}

		$id = $this->db->clearString($params['id']);
		unset($params['id']);

		$q = \database\QUpdate::getInstance()->setTable('users')
											->setParams($params)
											->setWhere("id = {$id}");

	    return $this->db->update($q);
	}



}
