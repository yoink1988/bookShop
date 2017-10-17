<?php
namespace Controllers;
/**
 * Description of Cart
 *
 * @author yoink
 */
class Cart
{
    private $model;

    public function __construct()
    {
        $this->model = new \Models\Cart();
	}

	public function postCart($params)
	{
		if(!empty((int)$params['count']))
		{
			if($this->model->isBookInCart($params['id_user'], $params['id_book']))
			{
				\Utils\Response::SuccessResponse(200);
				\Utils\Response::doResponse('Already in Cart');
			}
			else
			{
				if($this->model->addToCart($params))
				{
					\Utils\Response::SuccessResponse(200);
					\Utils\Response::doResponse('Added');
				}
			}
		}
		else
		{
			\Utils\Response::SuccessResponse(200);
			\Utils\Response::doResponse('Count must be Numeric value');
		}

	}

	public function getCart($params)
	{
		if(!empty((int)$params['id']))
		{
			if($res = $this->model->getCart($params['id']))
			{
				\Utils\Response::SuccessResponse(200);
				\Utils\Response::doResponse($res);
			}
			else
			{
				\Utils\Response::SuccessResponse(200);
				\Utils\Response::doResponse("Cart is empty yet");
			}
		}
		else
		{
			throw new \Exception('400', 'Bad Request');
		}
	}

	public function putCart($params)
	{
//		print_r($params);
//		exit;
		if(isset($params[0]['id_user']) && !empty($params[0]['id_user']))
		{
			$userId = array_shift($params)['id_user'];

			$errs = 0;
			foreach ($params as $book)
			{
				if($book['checkbox'])
				{
					if(!$this->model->deleteFromCart($userId, $book))
					{
						$errs++;
					}
				}
				else
				{
					if(!$this->model->changeCount($userId, $book))
					{
						$errs++;
					}
				}
			}
			if($errs == 0)
			{
				\Utils\Response::SuccessResponse(200);
				\Utils\Response::doResponse("Updated");
			}
		}

	}

	public function deleteCart($params)
	{
		if(!empty((int)$params['id']))
		{
			if($this->model->clearCart($params))
			{
				\Utils\Response::SuccessResponse(200);
				\Utils\Response::doResponse("Cleared");
			}
		}
		else
		{
			throw new \Exception('400', 'Bad Request');
		}
	}



}
