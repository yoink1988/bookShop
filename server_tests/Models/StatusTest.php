<?php
namespace Models;
/**
 * Description of StatusTest
 *
 * @author yoink
 */
class StatusTest extends \PHPUnit_Framework_TestCase
{
	private $dbManager, $status;

	public function setUp()
	{
		$this->dbManager = new \DBManager();

		$this->status = new \Models\Status();
	}

	public function tearDown()
	{
		$this->dbManager->clear();
	}

	public function testGetStatusFalse()
	{
		$this->assertEquals($this->status->getStatus(), array());
	}

	public function testGetStatusTrue()
	{
		$this->dbManager->addDBRecord("insert into status set id = 1, name = 'Status'","delete from status where id = 1");
		$res = $this->status->getStatus();
		$this->assertTrue(count($res) > 0);
	}
}
