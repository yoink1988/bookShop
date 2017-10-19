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
        if($res = $this->model->getOrders($params))
		{
			\Utils\Response::SuccessResponse(200);
			\Utils\Response::doResponse($res);			
		}
		else
		{
			\Utils\Response::SuccessResponse(200);
			\Utils\Response::doResponse('Not Found');
		}
    }

    public function putOrders($params)
    {
		if((!empty($params['id'])) && (!empty($params['id_status'])))
		{
			$id =  $params['id'];
			unset($params['id']);

			if($this->model->changeStatus($id, $params))
			{
				\Utils\Response::SuccessResponse(200);
				\Utils\Response::doResponse('Updated');
			}
		}
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
