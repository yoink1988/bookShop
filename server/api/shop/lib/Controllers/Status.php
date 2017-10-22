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
		
		return $this->model->getStatus($id);
	}
}
