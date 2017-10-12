<?php
namespace Models;
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

    public function getOrders($params)
    {
		$query = \database\QSelect::getInstance()->setColumns('o.id as id, '
				. 'u.login, p.name, s.name as status')->setTable('orders o')
				->setjoin('left join users u on o.id_user = u.id left join payment p on o.id_payment = p.id'
						. ' left join status s on o.id_status = s.id');

		$res = $this->db->select($query);
		dump($res);
    }
}
