<?php

require_once __DIR__.'/../dao/BaseDao.class.php';
require_once __DIR__.'/../dao/TicketsDao.class.php';

class BookingsService extends BaseDao{

    public function __construct(){
        parent::__construct("events");
        $this->ticketsDao = new TicketsDao();
    }

    public function getBookingByDate($booking_date){
        return $this->dao->getBookingByDate($booking_date);
    }

    public function getBookingById($id){
        return $this->dao->getBookingById($id);
    }

    public function addBooking($params){

        $ticket = $this->ticketsDao->getTicketsBy;

    }
}

?>