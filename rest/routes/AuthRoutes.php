<?php

require __DIR__.'/../vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

Flight::route('POST /login', function() {
    $login = Flight::request()->data->getData();

    $user = Flight::authService()->getAuthByEmail($login['email']);

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
    
    $data['password'] = md5($data['password']);
    $user = Flight::usersService()->add(['first_name' => $data['first_name'],
    'last_name' => $data['last_name'], 'address' => $data['address']]);
    $catch = Flight::authService()->add(['password' => $data['password'],
            'email'=> $data['email'],
            'admin' => 0,
            'users_id' => $user['id']]);
    unset($catch['password']);

    $jwt = JWT::encode($catch, Config::JWT_SECRET(), 'HS256');
    Flight::json(['token'=> $jwt]);
});

?>