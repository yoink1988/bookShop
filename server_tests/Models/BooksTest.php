<?php
namespace Models;
/**
 * Description of BooksTest
 *
 * @author yoink
 */
class BooksTest extends \PHPUnit_Framework_TestCase
{

	private $dbManager, $books;

	public function setUp()
	{
		$this->dbManager = new \DBManager();

		$this->books = new \Models\Books();
	}

	public function tearDown()
	{
		$this->dbManager->clear();
	}

	public function testGetBooksFalse()
	{
		$this->assertFalse($this->books->getBooks(), array());
	}

	public function testGetBooksTrue()
	{
		$this->dbManager->addDBRecord("insert into books set id = 1, title = 'Book', description = 'qqweqweqweqwe', price = 100, discount = 0, status = 1", "delete from books where id = 1");
		$this->dbManager->addDBRecord("insert into authors set id = 1, name = 'Author'","delete from authors where id = 1");
		$this->dbManager->addDBRecord("insert into genres set id = 1, name = 'Genre'","delete from genres where id = 1");
		$this->dbManager->addDBRecord("insert into book_genre set id_book = 1, id_genre = 1","delete from book_genre where id_book = 1 and id_genre = 1");
		$this->dbManager->addDBRecord("insert into book_author set id_book = 1, id_author = 1","delete from book_author where id_book = 1 and id_author = 1");

		$res = $this->books->getBooks();

		$this->assertTrue(count($res) > 0);
	}

	public function testAddBookFalseInvalidTitle()
	{
		$params = array(
			'book' => array(
				'title' => 'B33__@!$ok',
				'description' => '',
				'price' => '',
				'discount' => ''
			)
		);

		$res = $this->books->addBook($params);
		$this->assertEquals($res , 'Check Title field');
	}


	public function testAddBookFalseInvalidDescription()
	{
		$params = array(
			'book' => array(
				'title' => 'BookName',
				'description' => '22',
				'price' => '',
				'discount' => ''
			)
		);

		$res = $this->books->addBook($params);
		$this->assertEquals($res , 'Check Description field');
	}
	public function testAddBookFalseInvalidPrice()
	{
		$params = array(
			'book' => array(
				'title' => 'BookName',
				'description' => 'ffasd23de',
				'price' => 'qweqwe',
				'discount' => ''
			)
		);

		$res = $this->books->addBook($params);
		$this->assertEquals($res , 'Check Price field');
	}
	public function testAddBookFalseInvalidDiscount()
	{
		$params = array(
			'book' => array(
				'title' => 'BookName',
				'description' => 'ffasd23de',
				'price' => '120.00',
				'discount' => '55'
			)
		);

		$res = $this->books->addBook($params);
		$this->assertEquals($res, 'Check Discount field');
	}

	public function testAddBookTrue()
	{

		$params = array(
			'book' => array(
				'id' => 1,
				'title' => 'BookName',
				'description' => 'ffasd23de',
				'price' => '120.00',
				'discount' => '33'
			),
			'authors' => array(),
			'genres' => array()
		);

		$this->dbManager->addToClear("delete from books where id = 1");
		
		$this->assertTrue($this->books->addBook($params));
	}


	public function testUpdateBookInvalidTitle()
	{
		$this->dbManager->addDBRecord("insert into books set id = 1, title = 'Book', "
									. "description = 'dasdasdasdasd asdasd', "
									. "price = '120.0', "
									. "discount = 22, "
									. "status = '1'", "delete from books where id = 1");

		$res = $this->books->updateBook(array('book' => array('title' => '#$#@','price' => '','description' => '','discount' => '')));
		$this->assertEquals($res , 'Check Title field');
    }

	public function testUpdateBookInvalidDescription()
	{
		$this->dbManager->addDBRecord("insert into books set id = 1, title = 'Book', "
									. "description = 'dasdasdasdasd asdasd', "
									. "price = '120.0', "
									. "discount = 22, "
									. "status = '1'", "delete from books where id = 1");

		$res = $this->books->updateBook(array('book' => array('title' => 'Boook','price' => '23.00','description' => 'w','discount' => '5')));
		$this->assertEquals($res , 'Check Description field');
    }
	public function testUpdateBookInvalidPrice()
	{
		$this->dbManager->addDBRecord("insert into books set id = 1, title = 'Book', "
									. "description = 'dasdasdasdasd asdasd', "
									. "price = '120.0', "
									. "discount = 22, "
									. "status = '1'", "delete from books where id = 1");

		$res = $this->books->updateBook(array('book' => array('title' => 'Boook','price' => 'qwe','description' => 'wqwewqeqw','discount' => '5')));
		$this->assertEquals($res , 'Check Price field');
    }
	public function testUpdateBookInvalidDiscount()
	{
		$this->dbManager->addDBRecord("insert into books set id = 1, title = 'Book', "
									. "description = 'dasdasdasdasd asdasd', "
									. "price = '120.0', "
									. "discount = 22, "
									. "status = '1'", "delete from books where id = 1");

		$res = $this->books->updateBook(array('book' => array('title' => 'Boook','price' => '120.0','description' => 'wqwewqeqw','discount' => '533')));
		$this->assertEquals($res , 'Check Discount field');
    }


	public function testUpdateBookTrue()
	{
		$params = array(
			'book' => array(
				'id' => 1,
				'title' => 'Boook',
				'price' => '120.0',
				'description' => 'wqwewqeqw',
				'discount' => '33'
			),
			'authToAdd' => array(),
			'genToAdd' => array(),
			'authToDel' => array(),
			'genToDel' => array()
		);


		$this->dbManager->addDBRecord("insert into books set id = 1, title = 'Book', "
									. "description = 'dasdasdasdasd asdasd', "
									. "price = '120.0', "
									. "discount = 22, "
									. "status = '1'", "delete from books where id = 1");


		$this->assertTrue($this->books->updateBook($params));
    }
}
