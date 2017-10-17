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
		$id = null;
		if(!empty((int)$params['id']))
		{
			$id = $params['id'];
		}
        if($res = $this->model->getOrders($id))
		{
			\Utils\Response::SuccessResponse(200);
			\Utils\Response::doResponse($res);			
		}
    }

    public function putOrders($params)
    {
        $this->model->getOrders($params);
    }

	public function postOrders($params)
	{
		if(count($params) == 2)
		{
			$orderParams = array_shift($params);
			$orderInfoParams = array_shift($params);
//			print_r($orderInfoParams);
//			exit();
			if($id = $this->model->addOrder($orderParams))
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
					\Utils\Response::SuccessResponse(200);
					\Utils\Response::doResponse('Order Added');
				}

			}
			else
			{
				throw new \Exception('Ne udalos, poprobuite pozje',403);
			}

//			print_r($orderParams);

		}
	}

}
