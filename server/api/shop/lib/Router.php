<?php

/**
 * Description of Router
 *
 * @author yoink
 */
class Router
{
	public $args = null;
	public function __construct()
	{
		$this->url = $_SERVER['REQUEST_URI'];
		$this->reqMeth = $_SERVER['REQUEST_METHOD'];
	}

	public function run()
	{
//		echo '<pre>';
		$this->parseUrl();

		if(class_exists($this->class))
		{
			$controller = new $this->class;
			switch ($this->reqMeth)
            {
                case 'GET':
                    $this->execMethod($controller, $this->func, $this->args);
                    break;
                case 'POST':
					$this->args = $this->getPostArgs();

//				file_put_contents('tempp.txt', print_r(file_get_contents("php://input"), true));
                    $this->execMethod($controller, $this->func, $this->args);
                    break;
                case 'PUT':
					$this->args = $this->getPutArgs();
                    $this->execMethod($controller, $this->func, $this->args);
                    break;
                case 'DELETE':
                    $this->execMethod($controller, $this->func, $this->args);
                    break;
                default:
					echo 'Bsssad Request';
                    return false;
            }
		}
		else
		{
			throw new Exception($this->class);
		}

	}

	private function execMethod($class, $method, $param = null)
    {
        if (method_exists($class, $method))
        {
            $res = $class->$method($param);
        }
		else
		{
			throw new Exception('no func','405');
		}
	}

	public function parseUrl()
	{
		$arrayUrl = explode('/api/', $this->url);
        $this->class = '\Controllers\\'.ucfirst(array_shift(explode('/', $arrayUrl[1])));
		$this->func = strtolower($this->reqMeth).ucfirst(array_shift(explode('/', $arrayUrl[1])));

		if(substr("$arrayUrl[1]",-1) == '/')
		{
			$arrayUrl[1] = substr("$arrayUrl[1]", 0, -1);
		}

		$args = explode('/', $arrayUrl[1]);

		array_shift($args);
		if($args)
		{
			if($args[0] !== "")
			{
				$argPare = array_chunk($args, 2);
				if((count($args) % 2) == 0)
				{
					foreach($argPare as $pair)
					{
						$arg[$pair[0]] = $pair[1];
						$this->args = $arg;
					}
				}
				else
				{
					if((int)$args[0])
					{
						$this->args['id'] = $args[0];
					}
					else
					{
						throw new Exception('Bad REquest');
					}
				}
			}
		}
	}
	private function getPostArgs()
    {
		return json_decode(file_get_contents("php://input"), true);
//        return $_POST;
    }
	private function getPutArgs()
    {
        return json_decode(file_get_contents("php://input"), true);

//		$tmp = array();
//       parse_str(file_get_contents("php://input"), $tmp);
//	   return $tmp;
    }
}
