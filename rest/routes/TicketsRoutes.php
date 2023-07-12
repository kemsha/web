<?php
Flight::route('GET /ticket', function () {
    Flight::json(Flight::TicketsService()->getAll());
});

Flight::route('POST /ticket', function(){
    $data = Flight::request()->data->getData();
    $ticketsEvents = Flight::TicketsService()->add($data);

});