<?php
Flight::route('GET /ticketsevents', function () {
    Flight::json(Flight::TicketsEventsService()->getAll());
});