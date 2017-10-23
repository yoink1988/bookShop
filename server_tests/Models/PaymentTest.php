<?php
namespace Models;
/**
 * Description of PaymentTest
 *
 * @author yoink
 */
class PaymentTest extends \PHPUnit_Framework_TestCase
{
	private $dbManager, $payment;

	public function setUp()
	{
		$this->dbManager = new \DBManager();

		$this->payment = new \Models\Payment();
	}

	public function tearDown()
	{
		$this->dbManager->clear();
	}

	public function testGetPaymentFalse()
	{
		$this->assertEquals($this->payment->getPayment(), array());
	}
	public function testGetPaymentTrue()
	{
		$this->dbManager->addDBRecord("insert into payment set id = 1, name = 'Cash'", "delete from payment where id = 1");
		$res = $this->payment->getPayment();
		$this->assertTrue(count($res) > 0);
	}

}
