<?php

require_once __DIR__.'/BaseDao.class.php';

class EventsDao extends BaseDao{

    public function __construct(){
        parent::__construct("events");
    }

    public function getEventByName($name)
    {
        $this->queryUnique("SELECT e.id FROM events e WHERE event_name = :name", ['name' => $name]);
    }
}

?>