<?php
Flight::route('GET /venues', function () {
    Flight::json(Flight::venuesService()->getAll());
});
