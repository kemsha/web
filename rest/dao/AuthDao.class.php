<?php

require_once __DIR__.'/BaseDao.class.php';

class AuthDao extends BaseDao{

    public function __construct(){
        parent::__construct("auth");
    }

    public function getAuthByEmail($email)
    {
        return $this -> queryUnique("Select * From auth Where email= :email", ['email'=>$email]);
    }

    public function getAuthByID($id){
        return $this->queryUnique("Select * From auth where id= :id", ['id'=>$id]);
    }
}

?>