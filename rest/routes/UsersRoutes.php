<?php
Flight::route('GET /users', function () {
    Flight::json(Flight::usersService()->getAll());
});
