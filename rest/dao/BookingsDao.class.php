<?php

require_once __DIR__.'/BaseDao.class.php';

class BookingsDao extends BaseDao{

    public function __construct(){
        parent::__construct("bookings");
    }    

}

?>