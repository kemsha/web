<?php

/**
     * @OA\Get(path="/users/", tags={"users"}, summary="Returns all users from the api. ", security={{"ApiKeyAuth": {}}},
     *      @OA\Response( response=200, description="List of users")
     *  )
     */
Flight::route('GET /users', function () {
    Flight::json(Flight::usersService()->getAll());
});

/**
     * @OA\Get(path="/users/{id}", tags={"users"}, summary="Returns a single user by id", security={{"ApiKeyAuth": {}}},
     *     @OA\Parameter(in="path", name="id", example=1, description="Id of user"),
     *     @OA\Response(response="200", description="Fetch individual user")
     * )
     */

Flight::route('GET /users/@id', function ($id) {
    Flight::json(Flight::usersService()->getByID($id));
});
