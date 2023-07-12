<?php

require_once __DIR__.'/BaseService.class.php';
require_once __DIR__.'/../dao/TicketsEventsDao.class.php';

class TicketsEventsService extends BaseService {

    public function __construct()
    {
        parent::__construct(new TicketsEventsDao());
        
    }

    public function getEventByName($event_name){
        return $this->dao->getEventByName($event_name);
    }

    public function addEventAndTicket($params){

        $ticketsevent = $this->eventsAndTicketsDao->add([
            'events_id'=>$params['events_id'],
            'tickets_id'=>$params['tickets_id']
        ]);

    }
}
