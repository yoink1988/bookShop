<?php
namespace Models;
/**
 * Description of Auth
 *
 * @author yoink
 */
class Auth
{

    private $db;
    public function __construct()
    {
        $this->db = \database\Database::getInstance();
    }

}
