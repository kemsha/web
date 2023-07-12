<?php

Flight::route('GET /bookings', function(){

    Flight::json(Flight::bookingsService()->getAll());
});

Flight::route('POST /bookings', function(){
    
});