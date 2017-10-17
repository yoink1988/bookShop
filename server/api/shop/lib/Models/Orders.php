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

    public function getOrders($params = null)
	{
		//PARAMS

		$query = \database\QSelect::getInstance()->setColumns('o.id as id, '
				. 'u.id as u_id, u.login as u_login, u.discount as u_disc, p.id as p_id, p.name as p_name, s.id as s_id, s.name as s_name, o.date, '
				. 'oi.id_book as b_id, oi.count as count, b.title as b_title, oi.price, oi.disc_book as b_disc')
				->setTable('orders o')
				->setjoin('left join users u on o.id_user = u.id left join payment p on o.id_payment = p.id'
						. ' left join status s on o.id_status = s.id left join orderinfo oi on o.id = oi.id left join books b on oi.id_book = b.id');

		$res = $this->db->select($query);
		return $this->orderUnique($res);
    }

	public function addOrder($params)
	{
		$date = date("Y-m-d H:i:s");
		$params['id_status'] = '1';
		$params['date'] = $date;

		$q = \database\QInsert::getInstance()->setTable('orders')->setParams($params);

		if($this->db->insert($q))
		{
			return $this->db->getLastInsertID();
		}
		
//		print_r($date);
	}

	public function addOrderInfo($params)
	{
		$q = \database\QInsert::getInstance()->setTable('orderinfo')
											->setParams($params);
		return $this->db->insert($q);
	}

	private function orderUnique(array $res)
	{
		$uniq = array();
		$i = 0;
		foreach($res as $order)
		{
			if(!isset($uniq[$i]['id']))
			{
				$uniq[$i]['id'] = $order['id'];
				$uniq[$i]['u_id'] = $order['u_id'];
				$uniq[$i]['u_login'] = $order['u_login'];
				$uniq[$i]['u_disc'] = $order['u_disc'];
				$uniq[$i]['p_name'] = $order['p_name'];
				$uniq[$i]['s_id'] = $order['s_id'];
				$uniq[$i]['s_name'] = $order['s_name'];
				$uniq[$i]['date'] = $order['date'];
				$uniq[$i]['books'][] = array('b_id' => $order['b_id'],
												'title' => $order['b_title'],
												'price' => $order['price'],
												'count' => $order['count'],
												'discount' => $order['b_disc']);
			}
			else if($uniq[$i]['id'] == $order['id'])
			{
				$uniq[$i]['books'][] = array('b_id' => $order['b_id'],
								'title' => $order['b_title'],
								'price' => $order['price'],
								'count' => $order['count'],
								'discount' => $order['b_disc']);
			}
			else
			{
				$i++;
				$uniq[$i]['id'] = $order['id'];
				$uniq[$i]['u_id'] = $order['u_id'];
				$uniq[$i]['u_login'] = $order['u_login'];
				$uniq[$i]['u_disc'] = $order['u_disc'];
				$uniq[$i]['p_name'] = $order['p_name'];
				$uniq[$i]['s_id'] = $order['s_id'];
				$uniq[$i]['s_name'] = $order['s_name'];
				$uniq[$i]['date'] = $order['date'];
				$uniq[$i]['books'][] = array('b_id' => $order['b_id'],
												'title' => $order['b_title'],
												'price' => $order['price'],
												'count' => $order['count'],
												'discount' => $order['b_disc']);
			}

		}
		return $uniq;
	}
}
