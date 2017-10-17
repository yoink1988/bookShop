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
                                                'discount, status, role')
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
//		$params['hash'] = $this->generateHash();
        $query = \database\QInsert::getInstance()->setTable('users')
												->setParams($params);

		
        $res = $this->db->insert($query);
        dump($res);
    }



}
