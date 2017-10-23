<?php
namespace Models;
/**
 * Description of AuthorsTest
 *
 * @author yoink
 */
class AuthorsTest extends \PHPUnit_Framework_TestCase
{

	private $dbManager, $author;

	public function setUp()
	{
		$this->dbManager = new \DBManager();

		$this->author = new \Models\Authors();
	}

	public function tearDown()
	{
		$this->dbManager->clear();
	}

	public function testGetAuthorsFalse()
    {
		$this->assertEquals($this->author->getAuthors(1), array());
    }

	public function testGetAuthorsTrue()
    {
		$this->dbManager->addDBRecord("insert into authors set id = 1, name = 'Author'","delete from authors where id = 1");
		$res = $this->author->getAuthors(1);
		$this->assertTrue(count($res) > 0);
    }

	public function testaddAuthorFalse()
	{
		$this->assertFalse($this->author->addAuthor(array('name' => 'EQ@ESA!@#$')));
	}

	public function testAddAuthorTrue()
	{
		$this->dbManager->addToClear('delete from authors where id = 1');

		$this->assertTrue($this->author->addAuthor(array('id' => 1, 'name' => 'Author')));
	}

	public function testUpdateAuthorFalse()
	{
		$this->assertFalse($this->author->updateAuthor(array('id' =>'1' ,'name' => '-2')));
	}

	public function testUpdateAuthorTrue()
	{
		$this->dbManager->addDBRecord("insert into authors set id = 1, name = 'Avtor'", "delete from authors where id = 1");
		$this->author->updateAuthor(array('id' => 1, 'name' => 'Aavtor'));
		$res = $this->dbManager->getDBRecord('select name from authors where id = 1');

		$this->assertTrue($res[0]['name'] == 'Aavtor');
	}

	public function testDeleteAuthor()
	{
		$this->dbManager->addDBRecord("insert into authors set id = 1, name = 'Avtor'", "delete from authors where id = 1");
		$this->dbManager->addDBRecord("insert into book_author set id_book = 1, id_author = 1", "delete from book_author where id_book = 1 and id_author = 1");
		$this->author->deleteAuthor(array('id' => 1));

		$res = $this->dbManager->getDBRecord("select * from authors where id = 1");

		$this->assertEquals($res, array());
	}
}
