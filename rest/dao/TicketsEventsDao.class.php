<?php
require_once __DIR__.'/BaseDao.class.php';

class TicektsEventsDao extends BaseDao {

    public function __construct(){
        parent::__construct("events_&_tickets");
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getTaE($tickets_id){
        return $this->queryUnique("Select * From events_&_tickets Where tickets_id= :tickets_id", ['tickets_id'=>$tickets_id]);
    }

    public function deleteTicket($tickets_id){
        $stm = $this->conn->prepare("Delete From events_&_tickets where tickets_id=:tickets_id");
        $stm->bindParam(':tickets_id', $tickets_id);
        $stm->execute();
    }

    public function deleteEvent($events_id){
        $stm = $this->conn->prepare("Delete from events_&_tickets where events_id=:events_id");
        $stm->bindParam(':events_id', $events_id);
        $stm->execute();
    }
}

?>