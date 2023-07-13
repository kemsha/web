<?php

require_once __DIR__.'/BaseDao.class.php';

class BookingsDao extends BaseDao{

    public function __construct(){
        parent::__construct("bookings");
    }    

    public function getBookingByDate($date)
    {
        $stm = ("SELECT b.id, b.booking_date FROM bookings b WHERE booking_date = :date");
        $result = $this->conn->prepare($stm);
        $result->execute(['date' => $date]);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBookingById($id){
        $stm = ("SELECT b.id FROM bookings b WHERE b.id= :id");
        $result = $this->conn->prepare($stm);
        $result->execute(['id'=>$id]);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>