<?php

require_once __DIR__.'/BaseService.class.php';
require_once __DIR__.'/../dao/EventsDao.class.php';

class EventsService extends BaseService {

    public function __construct()
    {
        parent::__construct(new EventsDao());
    }

    public function getEventByName($event_name){
        return $this->dao->getEventByName($event_name);
    }
}

?>