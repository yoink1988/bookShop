<?php

/**
 * Description of Orders
 *
 * @author yoink
 */
class Orders
{
    private $db;
    
    public function __construct()
    {
        $this->db = \database\Database::getInstance();
    }

    public function getOrders($params=null)
    {
//        $query = \database\QSelect::getInstance()->setColumns('id, ')
    }
}
