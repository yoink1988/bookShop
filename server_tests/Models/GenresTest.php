<?php
namespace Models;
/**
 * Description of GenresTest
 *
 * @author yoink
 */
class GenresTest extends \PHPUnit_Framework_TestCase
{
	private $dbManager, $genre;

	public function setUp()
	{
		$this->dbManager = new \DBManager();

		$this->genre = new \Models\Genres();
	}

	public function tearDown()
	{
		$this->dbManager->clear();
	}

	public function testGetGenresFalse()
    {
		$this->assertEquals($this->genre->getGenres(1), array());
    }
	public function testGetGenresTrue()
    {
		$this->dbManager->addDBRecord("insert into genres set id = 1, name = 'Genre'","delete from genres where id = 1");
		$res = $this->genre->getGenres(1);
		$this->assertTrue(count($res) > 0);
    }
	public function testAddGenreFalse()
	{
		$this->assertFalse($this->genre->addGenre(array('name' => 'EQ@ESA!@#$')));
	}
	public function testAddGenreTrue()
	{
		$this->dbManager->addToClear('delete from genres where id = 1');

		$this->assertTrue($this->genre->addGenre(array('id' => 1, 'name' => 'Genre')));
	}

	public function testUpdateGenreFalse()
	{
		$this->assertFalse($this->genre->updateGenre(array('id' =>'1' ,'name' => '-2')));
	}

	public function testUpdateGenreTrue()
	{
		$this->dbManager->addDBRecord("insert into genres set id = 1, name = 'Genre'", "delete from genres where id = 1");
		$this->genre->updateGenre(array('id' => 1, 'name' => 'Ggenre'));
		$res = $this->dbManager->getDBRecord('select name from genres where id = 1');

		$this->assertTrue($res[0]['name'] == 'Ggenre');
	}

	public function testDeleteGenreFalse()
	{
		$this->dbManager->addDBRecord("insert into genres set id = 1, name = 'Genre'", "delete from genres where id = 1");
		$this->dbManager->addDBRecord("insert into book_genre set id_book = 1, id_genre = 1", "delete from book_genre where id_book = 1 and id_genre = 1");
		$this->genre->deleteGenre(array('id' => 1));

		$res = $this->dbManager->getDBRecord("select * from genres where id = 1");

		$this->assertEquals($res, array());
	}
}
