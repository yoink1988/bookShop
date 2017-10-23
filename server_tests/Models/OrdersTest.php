<?php
namespace Models;
/**
 * Description of OrdersTest
 *
 * @author yoink
 */
class OrdersTest extends \PHPUnit_Framework_TestCase
{
	private $dbManager, $orders;

	public function setUp()
	{
		$this->dbManager = new \DBManager();

		$this->orders = new \Models\Orders();
	}

	public function tearDown()
	{
		$this->dbManager->clear();
	}

	public function testGetOrdersFalse()
	{
		$this->assertFalse($this->orders->getOrders());
    }

	public function testGetOrdersTrue()
	{
		$date = date("Y-m-d H:i:s");
		$this->dbManager->addDBRecord("insert into orders set id = 1, id_user = 1, id_payment = 1, id_status = 1, date = '$date', disc_user = 0"," delete from orders where id = 1");
		$this->dbManager->addDBRecord("insert into orderinfo set id = 1, id_book = 1, count = 1, price = 100, disc_book = 0", "delete from orderinfo where id = 1");
		$this->dbManager->addDBRecord("insert into users set id = 1, name = 'user', login = 'user@mail.ru', pass = 'qweqwe11', discount = 0","delete from users where id = 1");
		$this->dbManager->addDBRecord("insert into payment set id = 1, name = 'cash'", "delete from payment where id = 1");
		$this->dbManager->addDBRecord("insert into status set id = 1, name = 'done'","delete from status where id = 1");
		$this->dbManager->addDBRecord("insert into books set id = 1, title = 'Book', description = 'qqweqweqweqwe', price = 100, discount = 0, status = 1", "delete from books where id = 1");

		$res = $this->orders->getOrders();

		$this->assertTrue(count($res) > 0);
    }

	public function testChangeStatusTrue()
	{
		$date = date("Y-m-d H:i:s");
		$this->dbManager->addDBRecord("insert into orders set id = 1, id_user = 1, id_payment = 1, id_status = 1, date = '$date', disc_user = 0"," delete from orders where id = 1");
		$this->orders->changeStatus(1,array('id_status'=> 2));

		$res = $this->dbManager->getDBRecord('select id_status from orders where id = 1');

		$this->assertTrue($res[0]['id_status'] == 2);
	}


	public function testAddOrder()
	{
		$this->dbManager->addToClear('delete from orders where id = 1');
		$date = date("Y-m-d H:i:s");
		$id = $this->orders->addOrder(array('id' => 1, 'date' => $date));

		$this->assertTrue($id == 1);
	}

	public function testAddOrderInfo()
	{
		$this->dbManager->addToClear("delete from orderinfo where id = 1");
		$this->orders->addOrderInfo(array('id' => 1, 'id_book' => 1, 'count' => 3));

		$res = $this->dbManager->getDBRecord('select * from orderinfo where id = 1');

		$this->assertTrue(count($res) > 0);
	}

}
