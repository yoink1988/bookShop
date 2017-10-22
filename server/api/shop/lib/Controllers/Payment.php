<?php
namespace Controllers;
/**
 * Description of Payment
 *
 * @author yoink
 */
class Payment
{
    private $model;

    public function __construct()
    {
        $this->model = new \Models\Payment();
	}

	public function getPayment()
	{
		 return $this->model->getPayment();
	}

}
