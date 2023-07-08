<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require 'vendor/autoload.php';

require_once __DIR__.'/services/UsersService.class.php';

Flight::register('usersService', 'UsersService');

Flight::map('error', function (Exception $e) {
    Flight::json(['message'=> $e->getMessage()], 500);
});

Flight::route('/', function(){
    print_r(__DIR__.'\routes\UsersRoutes.php');
});

require_once __DIR__.'/routes/UsersRoutes.php';


Flight::start();
?>