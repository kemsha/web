<?php
Flight::route('GET /ticket', function () {
    Flight::json(Flight::TicketsService()->getAll());
});

Flight::route('POST /ticket', function(){
    $data = Flight::request()->data->getData();
    $ticketsEvents = Flight::TicketsService()->add($data);

});

Flight::route('DELETE /tickets', function(){
    Flight::ticketsService()->delete($id);
    Flight::json(['message'=>'deleted']);
});