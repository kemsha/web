<?php

require_once __DIR__.'/BaseDao.class.php';

class AuthDao extends BaseDao{

    public function __construct(){
        parent::__construct("auth");
    }
}

?>