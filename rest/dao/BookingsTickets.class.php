<?php

require_once __DIR__.'/BaseDao.class.php';

class BookingsTickets extends BaseDao {

    public function __construct(){
        parent::__construct("bookings_&_tickets");
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getTaB($tickets_id){
        return $this->queryUnique("Select * From bookings_&_tickets Where tickets_id= :tickets_id", ['tickets_id'=>$tickets_id]);
    }

    public function deleteTicket($tickets_id){
        $stm = $this->conn->prepare("Delete From bookings_&_tickets where tickets_id=:tickets_id");
        $stm->bindParam(':tickets_id', $tickets_id);
        $stm->execute();
    }

    public function deleteBooking($bookings_id){
        $stm = $this->conn->prepare("Delete from bookings_&_tickets where bookings_id=:bookings_id");
        $stm->bindParam(':bookings_id', $boookings_id);
        $stm->execute();
    }
}

?>