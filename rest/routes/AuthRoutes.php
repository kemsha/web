<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

Flight::route('POST /login', function() {
    $login = Flight::request()->data->getData();

    $user = Flight::usersService()->getUserByEmail($login['email']);

    if(isset($user['id'])) {
        if($user['password'] == md5($login['password'])) {
            unset($user['password']);
            $jwt = JWT::encode($user, Config::JWT_SECRET(), 'HS256');
            Flight::json(['token' => $jwt]);
        } else {
            Flight::json(["message" => "Incorrect password"], 404);
        }

    } else {
        Flight::json(["message" => "User does not exist"], 404);
    }
});

Flight::route('POST /register', function(){
    $data = Flight::request()->data->getData();
    unset($data['Repeat the password']);
    $data['password'] = md5($data['password']);

    $catch = Flight::userService()->add(['username' => $data['password'],
            'email'=> $data['email']]);
    unset($catch['password']);

    $jwt = JWT::encode($catch, Config::JWT_SECRET(), HS256);
    Flight::json(['token'=> $jwt]);
});

?>