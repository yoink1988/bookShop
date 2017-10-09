<?php

function __autoload($className)
{
	$className = ROOT_DIR . '/' . str_replace('\\', '/', $className) . '.php';

	if (file_exists($className))
	{
		include_once $className;
	}
	else
	{
		var_dump($className);
	}
//	include_once ROOT_DIR.'/classes/'.$classname;
}
