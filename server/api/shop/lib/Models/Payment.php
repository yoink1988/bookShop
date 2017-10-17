<?php
namespace Models;
/**
 * Description of Payment
 *
 * @author yoink
 */
class Payment
{
    private $db;
    public function __construct()
    {
        $this->db = \database\Database::getInstance();
    }

	public function getPayment()
	{
		$q = \database\QSelect::getInstance()->setTable("payment")
											->setColumns('id, name')
											->setOrder('id');

		return $this->db->select($q);
	}

}
