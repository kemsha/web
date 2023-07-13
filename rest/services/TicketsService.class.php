<?php
require_once __DIR__.'/BaseService.class.php';
require_once __DIR__.'/../dao/TicketsDao.class.php';

class TicketsService extends BaseService {

    public function __construct()
    {
        parent::__construct(new TicketsDao());
    }

    public function getTicketByType($ticket_type){
        return $this->dao->getTicketByType($ticket_type);
    }

    public function getTicketById($id){

        return $this->dao->getTicketById($id);
    }
}
?>