<?php

require_once __DIR__.'/../dao/BaseDao.class.php';

class BookingsService extends BaseDao{

    public function __construct(){
        parent::__construct("events");
    }

    public function getEventByName($name)
    {
        $this->queryUnique("SELECT e.id FROM events e WHERE event_name = :name", ['name' => $name]);
    }
}

?>