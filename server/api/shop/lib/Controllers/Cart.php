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
		if($this->model->isBookInCart($params['id_user'], $params['id_book']))
		{
			return 'Already in Cart';
		}
		else
		{
			if($this->model->addToCart($params))
			{
				return 'Added';
			}
				return false;
		}
//


	}

	public function getCart($params)
	{
		return $this->model->getCart($params['id']);
	}

	public function putCart($params)
	{
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
				return true;
			}
			return false;
		}

	}

	public function deleteCart($params)
	{
		if(!empty((int)$params['id']))
		{
			return $this->model->clearCart($params['id']);
		}
		return false;

	}



}
