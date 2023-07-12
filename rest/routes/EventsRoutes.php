<?php
Flight::route('GET /events', function () {
    Flight::json(Flight::EventsService()->getAll());
});

Flight::route('POST /events', function(){
    $data = Flight::request()->data->getData();
    $ticketsEvents = Flight::EventsService()->add($data);

});