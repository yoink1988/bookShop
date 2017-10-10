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

    public function getUsers($params = null)
    {
        $query = \database\QSelect::getInstance()->setColumns('id, name, login,'. 
                                                'pass, discount, status, role')
                                                ->setTable('users');
        $res = $this->db->select($query);
        dump($res);
    }
}
