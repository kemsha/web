<?php
Flight::route('GET /events', function () {
    Flight::json(Flight::eventsService()->getEventsWithVenues());
});

Flight::route('POST /events', function(){
    $data = Flight::request()->data->getData();
    $ticketsEvents = Flight::eventsService()->add($data);

});

Flight::route('DELETE /events', function(){

    Flight::eventsService()->delete($id);
    Flight::json(['message'=>'deleted']);
});
