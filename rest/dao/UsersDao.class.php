<?php

require_once __DIR__.'/BaseDao.class.php';

class UsersDao extends BaseDao{

    public function __construct(){
        parent::__construct("users");
    }

    public function getUserByName($first_name,$last_name){
        return $this->queryUnique("Select * From users WHERE first_name= :first_name AND last_name= :last_name", ['first_name'=> $first_name, 'last_name' => $last_name]);
    }

    public function getById($id){
        return $this->queryUnique("SELECT * FROM users WHERE id= :id", ['id'=>$id]);
    }
}

?>