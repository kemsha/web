<?php
require_once __DIR__.'/BaseService.class.php';
require_once __DIR__.'/../dao/TicketsEventsDao.class.php';

class TicketsEventsService extends BaseService {
    
    public function __construct() 
    {
        parent::__construct(new TicketsEventsDao());
    }

    public function getTicketsEventsByID($id){
        return $this->dao->getTicketsEventsByID($id);
    }
}

?>