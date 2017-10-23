<?php
namespace Controllers;
/**
 * Description of Orders
 *
 * @author yoink
 */
class Orders
{
    private $model;
    
    public function __construct()
    {
        $this->model = new \Models\Orders();
    }

    public function getOrders($params = null)
    {

        return $this->model->getOrders($params);
    }

    public function putOrders($params)
    {
		if(\Models\Auth::isAdmin())
		{
			if((!empty($params['id'])) && (!empty($params['id_status'])))
			{
				$id =  $params['id'];
				unset($params['id']);

				return $this->model->changeStatus($id, $params);
			}
			return false;
		}
		throw new \Exception(403);
    }

	public function postOrders(array $params)
	{
		if(count($params) == 2)
		{
			$orderParams = array_shift($params);
			if($id = $this->model->addOrder($orderParams))
			{
				$orderInfoParams = array_shift($params);
				return $this->addOrderInfo($orderInfoParams, $id);
			}
		}
		return false;

	}
	
	private function addOrderInfo(array $orderInfoParams, $id)
	{
		$err=0;
		foreach($orderInfoParams as $row)
		{
			$row['id'] = $id;
			if(!$this->model->addOrderInfo($row))
			{
				$err++;
			}
		}
		if($err == 0 )
		{
			return true;
		}
		return false;
	}

}
