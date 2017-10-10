<?php
namespace Models;

/**
 * Description of Genres
 *
 * @author yoink
 */
class Genres
{
	private $db;

	public function __construct()
	{
		$this->db = \database\Database::getInstance();
	}

}
