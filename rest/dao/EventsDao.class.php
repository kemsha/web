<?php

require_once __DIR__.'/BaseDao.class.php';

class EventsDao extends BaseDao{

    public function __construct(){
        parent::__construct("events");
    }
}

?>