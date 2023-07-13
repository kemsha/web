<?php

/**
     * @OA\Get(path="/venues/", tags={"venues"}, summary="Returns all venues from the api. ", security={{"ApiKeyAuth": {}}},
     *      @OA\Response( response=200, description="List of venues")
     *  )
     */
Flight::route('GET /venues', function () {
    Flight::json(Flight::venuesService()->getAll());
});

/**
     * @OA\Get(path="/venues/{id}", tags={"venues"}, summary="Returns a single venue by id", security={{"ApiKeyAuth": {}}},
     *     @OA\Parameter(in="path", name="id", example=1, description="Id of venue"),
     *     @OA\Response(response="200", description="Fetch individual venue")
     * )
     */

Flight::route('Get /venues/@id', function($id){
    Flight::json(Flight::venuesService()->getVenuesById($id));
});