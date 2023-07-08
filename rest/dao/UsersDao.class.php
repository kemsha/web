<?php

require_once __DIR__.'/BaseDao.class.php';

class UsersDao extends BaseDao{

    public function __construct(){
        parent::__construct("users");
    }

    public static function getInstance() {
        if (!isset(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getUserByName($first_name,$last_name){
        return $this->queryUnique("Select * From users WHERE first_name= :first_name AND last_name= :last_name", ['first_name'=> $first_name, 'last_name' => $last_name]);
    }
}

?>