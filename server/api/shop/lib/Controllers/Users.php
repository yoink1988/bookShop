<?php
namespace Controllers;
/**
 * Description of Users
 *
 * @author yoink
 */
class Users
{
    private $model;
    
    public function __construct()
    {
        $this->model = new \Models\Users();
    }

    public function getUsers($params=null)
    {
        $this->model->getUsers($params=null);
        
    }
}
