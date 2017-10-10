<?php
namespace database;
/**
 * Description of Database
 *
 * @author yoink
 */
class Database
{
	private $pdo = null;
	private static $instance = null;

	private function __construct(\PDO $pdo)
	{
		$this->pdo = $pdo;
	}

	public static function getInstance()
	{
		if (self::$instance instanceof self)
		{
			return self::$instance;
		}

		$pdo = new \PDO(DB_HOST,DB_USER,DB_PWD, array(
//				\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
				\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC));
		return self::$instance = new self($pdo);
	}

	/**
	 *
	 * @param \database\QSelect $query
	 */
	public function select(\database\QSelect $query)
	{
//		var_dump($query->getQueryString());
//		exit();
		
		if(!$stmt = $this->pdo->query($query->getQueryString()))
		{
			echo $this->getError();
		}
		$result = array();
		if ($stmt instanceof \PDOStatement)
		{
			foreach ($stmt as $row)
			{
				$result[] = $row;
			}
		}

		return $result;
	}
	
	public function insert(\database\QInsert $query)
	{
		$res = $this->pdo->exec($query->getStringQuery());
		return $res !== false;
	}
	
	public function delete(\database\QDelete $query)
	{

	}
	public function update(\database\QUpdate $query)
	{

	}

	public function getError()
	{
		$errInfo = $this->pdo->errorInfo();

		if ($errInfo[2])
		{
//			var_dump($errInfo);
			return "$errInfo[2]";
		}
		return '';
	}
	
}