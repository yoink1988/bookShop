<?php
namespace Models;
/**
 * Description of Cart
 *
 * @author yoink
 */
class Cart
{
    private $db;
    public function __construct()
    {
        $this->db = \database\Database::getInstance();
    }

	public function isBookInCart($idUser, $idBook)
	{
		$idUser = $this->db->clearString($idUser);
		$idBook = $this->db->clearString($idBook);
		$q = \database\QSelect::getInstance()->setTable('cart')->setColumns('id_book')
											->setWhere("id_user = {$idUser} and id_book = {$idBook}");

		if($res = $this->db->select($q))
		{
			return true;
		}
		return false;

	}

	public function addToCart(array $params)
	{
		if(!\Utils\Validator::validCount($params['count']))
		{
			return false;
		}
		
		$q = \database\QInsert::getInstance()->setTable('cart')->setParams($params);
		return $this->db->insert($q);
	}

	public function getCart($id)
	{
		$id = $this->db->clearString($id);
		$q = \database\QSelect::getInstance()->setColumns('b.id as id, b.title, b.price, b.discount, c.count')
											->setTable('books b')
											->setjoin('left join cart c on c.id_book = b.id')
											->setWhere("c.id_user = {$id}");

		return $this->db->select($q);
	}


	
	public function changeCount($userId, $params)
	{
		if(!\Utils\Validator::validCount($params['count']))
		{
			return false;
		}
		$userId = $this->db->clearString($userId);
		$idBook = $this->db->clearString($params['id_book']);
		$params = array('count' => $params['count']);

		$q = \database\QUpdate::getInstance()->setTable('cart')
											->setParams($params)
											->setWhere("id_user = {$userId} and "
											. "id_book = {$idBook}");

		return $this->db->update($q);
	}

	public function deleteFromCart($userId, $params)
	{
		$userId = $this->db->clearString($userId);
		$idBook = $this->db->clearString($params['id_book']);

		$q= \database\QDelete::getInstance()->setTable('cart')
											->setWhere("id_user = {$userId} and id_book = {$idBook}");
		return $this->db->delete($q);
	}

	public function clearCart($id)
	{
		$id = $this->db->clearString($id);
		$q = \database\QDelete::getInstance()->setTable('cart')
											->setWhere("id_user = {$id}");

		return $this->db->delete($q);
	}
}

