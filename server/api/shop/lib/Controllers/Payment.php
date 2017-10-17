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
		if($res = $this->model->getPayment())
		{
			\Utils\Response::SuccessResponse(200);
			\Utils\Response::doResponse($res);
		}
		else
		{
			throw new \Exception('try again later', 404);
		}
	}

}
