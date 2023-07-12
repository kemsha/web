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

    public function getEventsWithVenues()
    {
        return $this->query("SELECT e.id, e.event_name, e.event_date, v.venue_name, v.venue_location, v.seating_capacity FROM mydb.events e
        JOIN mydb.venues v on v.id = e.venues_id ", []);
    }

}

?>