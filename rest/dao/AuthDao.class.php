<?php

require_once __DIR__.'/BaseDao.class.php';

class AuthDao extends BaseDao{

    public function __construct(){
        parent::__construct("auth");
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getAuthByEmail($email)
    {
        return $this -> queryUnique("Select * From auth Where email= :email", ['email'=>$email]);
    }
}

?>