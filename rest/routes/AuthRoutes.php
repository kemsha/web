<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

 /**
     * @OA\Post(
     *     path="/login",
     *     description="Login to the system",
     *     tags={"JWT"},
     *     @OA\RequestBody(description="Basic user info", required=true,
     *       @OA\MediaType(mediaType="application/json",
     *    			@OA\Schema(
     *    				@OA\Property(property="email", type="string", example="a@gmail.com",	description="Email"),
     *    				@OA\Property(property="password", type="string", example="1234",	description="Password" )
     *          )
     *     )),
     *     @OA\Response(
     *         response=200,
     *         description="JWT token on successful response",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="unauthorized",
     *     )
     * )
     */

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

/**
* @OA\Post(
*     path="/public/register",
*     description="Register a user into the app",
*     tags={"users"},
*     @OA\RequestBody(description="Basic user register info", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*           @OA\Property(property="first_name", type="string", example="arijan",	description="User first name"),
*           @OA\Property(property="last_name", type="string", example="komsic",	description="User last name"),
*           @OA\Property(property="password", type="string", example="1234",	description="User password"),
*           @OA\Property(property="address", type="string", example="123456789",	description="User phonenumber"),
*           @OA\Property(property="email", type="string", example="a@gmail.com",	description="User email"),
*        )
*     )),
*     @OA\Response(
*         response=200,
*         description="JWT Token"
*     ),
*     @OA\Response(
*         response=404,
*         description="User not found"
*     ),
* )
*/

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