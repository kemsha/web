<?php

require_once __DIR__.'/BaseDao.class.php';

class TicketsDao extends BaseDao{

    public function __construct(){
        parent::__construct("tickets");
    }

}

?>