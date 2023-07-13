<?php

require_once __DIR__.'/BaseDao.class.php';

class TicketsDao extends BaseDao{

    public function __construct(){
        parent::__construct("tickets");
    }
    
    public function getTicketsByType($ticket_type){
        $stm = "SELECT t.id,t.ticket_type FROM tickets t WHERE ticket_type = :ticket_type";
        $result = $this->conn->prepare($stm);
        $result->execute(['ticket_type', $ticket_type]);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTicketsById($id){
        $stm = "SELECT t.id FROM tickets t WHERE t.id = :id";
        $result = $this->conn->prepare($stm);
        $result->execute(['id', $id]);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>