<?php
namespace Controllers;
/**
 * Description of Status
 *
 * @author yoink
 */
class Status
{
	public $model;

	public function __construct()
	{
		$this->model = new \Models\Status();
	}

	public function getStatus($params=null)
	{
		$id = $params;
		if(isset($params['id']))
		{
			$id = $params['id'];
		}
		
		if($res = $this->model->getStatus($id))
		{
			\Utils\Response::SuccessResponse(200);
			\Utils\Response::doResponse($res);
		}
	}
}
