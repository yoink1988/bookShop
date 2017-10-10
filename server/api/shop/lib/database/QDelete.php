<?php

/**
 * Description of QDelete
 *
 * @author yoink
 */
class QDelete
{
	public static function instance()
	{
		return new self();
	}

		//потестить как работает
	public function getStringQuery()
	{
//		$query = '';
//		$query .= 'delete from ' . "{$this->table} ";
//
//		if ($this->where)
//		{
//			$query .= " where {$this->where}";
//		}
//		else
//		{
//			//sorry no where - no delete
//			return '';
//		}
//
//		if ($this->limit)
//		{
//			$query .= " limit {$this->limit}";
//		}
//
//		return $query;
	}
}
