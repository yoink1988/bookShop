<?php
include_once 'lib/config.php';
include_once 'lib/functions.php';



try{
	//zagolovki poka tut, potom uberu
	header('Access-Control-Allow-Origin: *');
//    header('Access-Control-Allow-Methods: PUT, POST, GET, DELETE');
//    header('Access-Control-Allow-Headers: Authorization, Content-Type');
	$router = new Router;
	$router->run();
}
catch (\Exception $e)
{
	if(RUN_MODE == MODE_LIVE)
	{
		\Utils\Response::ErrorResponse($e->getCode(), $e->getMessage());
	}
	else
	{
			echo $e->getMessage().'<br>';
			echo $e->getTraceAsString();
	}

}
?>