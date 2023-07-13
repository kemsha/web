<?php
require_once __DIR__.'/BaseService.class.php';
require_once __DIR__.'/../dao/UsersDao.class.php';

class UsersService extends BaseService {
    
    public function __construct() 
    {
        parent::__construct(new UsersDao());
    }

    public function getUserByName($first_name,$last_name){
        return $this->dao->getUserByName($first_name,$last_name);
    }

    public function getById($id){
        return $this->dao->getById($id);
    }
}

?>