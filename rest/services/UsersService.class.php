<?php
require_once __DIR__.'/BaseService.class.php';
require_once __DIR__.'/../dao/UsersDao.class.php';

class UsersService extends BaseService {
    
    public function __construct() 
    {
        parent::__construct(new UsersDao());
    }

    public function getUserByEmail($email){
        return $this->dao->getUserByEmail($email);
    }
}

?>