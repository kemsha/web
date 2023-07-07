<?php
require_once __DIR__.'/BaseService.class.php';
require_once __DIR__.'/../dao/VenuesDao.class.php';

class VenuesService extends BaseService {

    public function __construct()
    {
        parent::__construct(new VenuesDao());
    }

    public function getVenuesByName($venue_name){
        return $this->dao->getVenuesByName($venue_name);
    }
}

?>