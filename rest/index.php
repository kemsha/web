<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require __DIR__.'/vendor/autoload.php';

require_once __DIR__.'/services/UsersService.class.php';
require_once __DIR__.'/services/AuthService.class.php';
require_once __DIR__.'/services/BookingsService.class.php';
require_once __DIR__.'/services/eventsService.class.php';
require_once __DIR__.'/services/TicketsEventsService.class.php';
require_once __DIR__.'/services/TicketsService.class.php';
require_once __DIR__.'/services/UsersService.class.php';
require_once __DIR__.'/services/VenuesService.class.php';

Flight::register('usersService', 'UsersService');
Flight::register('authService', 'AuthService');
Flight::register('bookingsService', 'BookingsService');
Flight::register('eventsService', 'EventsService');
Flight::register('ticketsService', 'TicketsService');
Flight::register('ticketsEventsService', 'TicketsEventsService');
Flight::register('venuesService', 'VenuesService');

// Flight::map('error', function (Exception $e) {
//     Flight::json(['message'=> $e->getMessage()], 500);
// });

Flight::route('/', function(){
    print_r(__DIR__.'\routes\UsersRoutes.php');
});

require_once __DIR__.'/routes/UsersRoutes.php';
require_once __DIR__.'/routes/AuthRoutes.php';
require_once __DIR__.'/routes/BookingsRoutes.php';
require_once __DIR__.'/routes/EventsRoutes.php';
require_once __DIR__.'/routes/BookingsTicketsRoutes.php';
require_once __DIR__.'/routes/TicketsEventsRoutes.php';
require_once __DIR__.'/routes/TicketsRoutes.php';
require_once __DIR__.'/routes/VenuesRoutes.php';


Flight::start();
?>