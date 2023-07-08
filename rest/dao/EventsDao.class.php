<?php

require_once __DIR__.'/BaseDao.class.php';

class EventsDao extends BaseDao{

    public function __construct(){
        parent::__construct("events");
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}

?>