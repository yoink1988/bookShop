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
        $this->model->getOrders($params = null);
    }

    public function putOrders($params)
    {
        $this->model->getOrders($params);
    }

}
