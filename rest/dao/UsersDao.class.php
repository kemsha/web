<?php

require_once __DIR__.'/BaseDao.class.php';

class UsersDao extends BaseDao{

    public function __construct(){
        parent::__construct("users");
    }
}

?>