<?php

require_once __DIR__.'/BaseService.class.php';
require_once __DIR__.'/../dao/EventsDao.class.php';
require_once __DIR__.'/../dao/VenuesDao.class.php';

class EventsService extends BaseService {

    public function __construct()
    {
        parent::__construct(new EventsDao());
        $this->venuesDao = new VenuesDao();
        
    }

    public function getEventByName($event_name){
        return $this->dao->getEventByName($event_name);
    }
    
    public function addEvent($params){
        
        $venue = $this->venuesDao->getVenuesByName($params['venue_name']);
        
        $event = $this->EventDao->add([
            'event_name'=>$params['event_name'],
            'event_date'=>$params['event_date'],
            'venues_id'=>$params['venues_id']
        ]);
    }

}

?>