<?php
namespace Models;

/**
 * Description of Books
 *
 * @author yoink
 */
class Books
{
	private $db;
	public function __construct()
	{
		$this->db = \database\Database::getInstance();
	}
	public function getBooks($params = null)
	{
		//validate Params

		
		$query = \database\QSelect::getInstance()->setColumns('b.id as id,'
															. ' b.title,'
															. ' a.id as a_id,'
															. ' a.name as a_name')
												->setTable('books b')
												->setjoin('left join book_author ba '
														. 'on b.id = ba.id_book '
														. 'left join authors a '
														. 'on ba.id_author = a.id')
//														->setWhere('b.id = 2')
														->setOrder('b.id');
		$result = $this->db->select($query);
		var_dump($result);
//		$res = $this->getUniqueData($result);
//		var_dump(json_encode($res));
//		if($params)
	}
//	public function uniq(array $result)
//	{
//		$res = array();
//		foreach ($result as $book)
//		{
//
//		}
//	}

	protected function getUniqueData(array $dbResult)
	{
		foreach ($dbResult as $inner)
		{
			if (!isset($unique[$inner['id']]))
			{
				$unique[$inner['id']] = $inner;
			}
			if (isset($unique[$inner['id']]['id']) == $inner['id'])
			{
				foreach ($inner as $k => $value)
				{
					if ($k == 'id_genre' || $k == 'a_id' || $k == 'a_name' || $k == 'genre')
					{
						if ($unique[$inner['id']][$k]!=$value)
						{
							$unique[$inner['id']][$k] = array_unique(array_merge_recursive($unique[$inner['id']],$inner)[$k]);
						}
						else
						{
							$unique[$inner['id']][$k] = array($unique[$inner['id']][$k]);
						}
					}
				}
			}
		}
//		var_dump($unique);
		$result = $this->combineUniqueData($unique);

		return $result;

	}

	protected function combineUniqueData(array $unique)
	{

		$result = array();

		foreach ($unique as $book => $value)
		{
			$result[$book] = $value;
//			if (isset($value['id_genre']))
//			{
//				$result [$book]['genre'] = array_combine($value['id_genre'],$value['genre']);
//				unset($result [$book]['id_genre']);
//			}

			if (isset($value['a_id']))
			{
				$result [$book]['author'] = array_combine($value['a_id'],$value['a_name']);
				unset($result[$book]['a_id']);
				unset($result[$book]['a_name']);
			}
		}
		return $result;
	}

	public function addBook($params)
	{}
}
