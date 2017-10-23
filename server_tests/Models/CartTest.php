<?php
namespace Models;
/**
 * Description of CartTest
 *
 * @author yoink
 */
class CartTest extends \PHPUnit_Framework_TestCase
{
	private $dbManager, $cart;

	public function setUp()
	{
		$this->dbManager = new \DBManager();

		$this->cart = new \Models\Cart();
	}

	public function tearDown()
	{
		$this->dbManager->clear();
	}

	public function testIsBookInCartFalse()
	{
		$this->assertFalse($this->cart->isBookInCart(1,1));
	}
	public function testIsBookInCartTrue()
	{
		$this->dbManager->addDBRecord('insert into cart set id_user = 1, id_book = 1',"delete from cart where id_user = 1 and id_book = 1");
		$this->assertTrue($this->cart->isBookInCart(1,1));
	}

	public function testAddToCartFalse()
	{
		$this->assertFalse($this->cart->addToCart(array('count' => -2)));
	}

	public function testAddToCartTrue()
	{
		$this->dbManager->addToClear('delete from cart where id_user = 1 and id_book = 1');

		$this->assertTrue($this->cart->addToCart(array('count' => 3, 'id_user' => 1, 'id_book' => 1)));
	}

	public function testGetCartFalse()
	{
		$this->assertEquals($this->cart->getCart(1), array());
	}

	public function testGetCartTrue()
	{
		$this->dbManager->addDBRecord('insert into cart set id_user = 1, id_book = 1',"delete from cart where id_user = 1 and id_book = 1");
		$this->dbManager->addDBRecord('insert into books set id = 1',"delete from books where id = 1");
		$result = $this->cart->getCart(1);
		$this->assertTrue(count($result) > 0);
	}

	public function testChangeCountFalse()
	{
		$this->assertFalse($this->cart->changeCount('', array('count' => '-2')));
	}

	public function testChangeCountTrue()
	{
		$this->dbManager->addDBRecord('insert into cart set id_user = 1, id_book = 1, count = 2', 'delete from cart where id_user = 1');
		$this->cart->changeCount('1', array('id_book' => 1 , 'count' => 3));
		$res = $this->dbManager->getDBRecord('select count from cart where id_user = 1 and id_book = 1');
		$this->assertTrue($res[0]['count'] == 3);
	}

	public function testDeleteFromCart()
	{
		$this->dbManager->addDBRecord('insert into cart set id_user = 1, id_book = 1, count = 2', 'delete from cart where id_user = 1');
		$res1 = $this->dbManager->getDBRecord('select count(*) from cart where id_user = 1');
		$this->cart->deleteFromCart(1, array( 'id_book' => 1));
		$res2 = $this->dbManager->getDBRecord('select count(*) from cart where id_user = 1');
		$this->assertTrue($res1[0] > $res2[0]);
	}

	public function testclearCart()
	{
		$this->dbManager->addDBRecord('insert into cart set id_user = 1, id_book = 1, count = 2', 'delete from cart where id_user = 1');
		$this->dbManager->addDBRecord('insert into cart set id_user = 1, id_book = 2, count = 2', 'delete from cart where id_user = 1');
		$this->dbManager->addDBRecord('insert into cart set id_user = 1, id_book = 3, count = 2', 'delete from cart where id_user = 1');

		$this->cart->clearCart(1);

		$res = $this->dbManager->getDBRecord('select * from cart where id_user = 1');
		$this->assertTrue(count($res) == 0);
	}

}
