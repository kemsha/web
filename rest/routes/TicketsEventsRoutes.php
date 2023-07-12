<?php
Flight::route('GET /ticketsevents', function () {
    Flight::json(Flight::TicketsEventsService()->getAll());
});

Flight::route('POST /ticketsevents', function(){
    $data = Flight::request()->data->getData();
    $ticketsEvents = Flight::TicketsEventsService()->add($data);

});

Flight::route('DELETE /ticketsevents', function(){
    Flight::ticketsEventsService()->delete($id);
    Flight::json(['message'=>'deleted']);
});