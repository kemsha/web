<?php
require_once __DIR__.'/BaseDao.class.php';

class TicektsEventsDao extends BaseDao {

    public function __construct(){
        parent::__construct("eventstickets");
    }
    
    public function getEventsAndTicket(){
        $stm = "SELECT t.ticket_type, e.event_name, e.event_date, v.venue_name, v.venue_location";
        $stm.= "FROM eventstickets et";
        $stm.= "JOIN tickets t ON et.tickets_id = t.id";
        $stm.= "JOIN events e ON et.events_id = e.id";
        $stm.= "JOIN venues v ON e.venues_id = v.id";
        $result = $this->conn->prepare($stm);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEventsAndTicketById($id){
        $stm = "SELECT et.id, t.ticket_type, e.event_name, e.event_date, v.venue_name, v.venue_location";
        $stm.= "FROM eventstickets et";
        $stm.= "JOIN tickets t ON et.tickets_id = t.id";
        $stm.= "JOIN events e ON et.events_id = e.id";
        $stm.= "JOIN venues v ON e.venues_id = v.id";
        $stm.= "WHERE et.id = :id";
        $result = $this->conn->prepare($stm);
        $result->execute(['id'=>$id]);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>