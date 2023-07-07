<?php
require_once __DIR__.'/BaseService.class.php';
require_once __DIR__.'/../dao/TicketsDao.class.php';

class TicketsService extends BaseService {

    public function __construct()
    {
        parent::__construct(new TicketsDao());
    }

    public function getTicketByName($ticket_name){
        return $this->dao->getTicketByName($ticket_name);
    }
}

?>