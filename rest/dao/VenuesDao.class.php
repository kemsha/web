<?php

require_once __DIR__.'/BaseDao.class.php';

class VenuesDao extends BaseDao{

    public function __construct(){
        parent::__construct("venues");
    }

    public function getVenuesByName($venue_name){
        return $this->queryUnique("Select * From venues Where venue_name= :venue_name", ['venue_name'=> $venue_name]);
    }
}

?>