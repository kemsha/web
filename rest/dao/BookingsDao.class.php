<?php

require_once __DIR__.'/BaseDao.class.php';

class BookingsDao extends BaseDao{

    public function __construct(){
        parent::__construct("bookings");
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

}



?>