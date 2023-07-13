<?php

require_once __DIR__.'/BaseDao.class.php';

class BookingsTicketsDao extends BaseDao {

    public function __construct(){
        parent::__construct("bookingstickets");
    }

    public function getBookingsAndUsers() {
        $stm = "SELECT bt.id, u.first_name, u.last_name, bt.ticket_amount_type AS 'Ticket amount',  t.ticket_type, b.booking_date";
        $stm.= "FROM bookingstickets bt";
        $stm.= "JOIN tickets t ON bt.tickets_id = t.id";
        $stm.= "JOIN bookings b ON bt.bookings_id = b.id";
        $stm.= "JOIN users u ON b.users_id = u.id";
        $result = $this->conn->prepare($stm);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBookingAndUsersbyID($id) {
        $stm = "SELECT bt.id, u.first_name, u.last_name, bt.ticket_amount_type AS 'Ticket amount',  t.ticket_type, b.booking_date";
        $stm.= "FROM bookingstickets bt";
        $stm.= "JOIN tickets t ON bt.tickets_id = t.id";
        $stm.= "JOIN bookings b ON bt.bookings_id = b.id";
        $stm.= "JOIN users u ON b.users_id = u.id";
        $stm.= "WHERE bt.id = :id";
        $result = $this->conn->prepare($stm);
        $result->execute(['id' => $id]);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    public function deleteBooking(){
        $stm = $this->conn->prepare("DELETE FROM bookingstickets WHERE booking_id = :booking_id");
        $stm->bindParam(':booking_id', $booking_id);
        $stm->execute();
    }

}

?>