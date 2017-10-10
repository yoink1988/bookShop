<?php
namespace Models;

/**
 * Description of Authors
 *
 * @author yoink
 */
class Authors
{
	private $db;

	public function __construct()
	{
		$this->db = \database\Database::getInstance();
	}
	

}
