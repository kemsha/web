<?php

/**
     * @OA\Get(path="/bookings", tags={"bookings"}, summary="Returns all bookings from the api. ", security={{"ApiKeyAuth": {}}},
     *      @OA\Response( response=200, description="List of bookings")
     *  )
     */
Flight::route('GET /bookings', function(){

    Flight::json(Flight::bookingsService()->getAll());
});

 /**
     * @OA\Get(path="/bookings/{id}", tags={"bookings"}, summary="Returns a single booking by id", security={{"ApiKeyAuth": {}}},
     *     @OA\Parameter(in="path", name="id", example=1, description="Id of booking"),
     *     @OA\Response(response="200", description="Fetch individual booking")
     * )
     */

Flight::route('GET /bookings/@id', function ($id) {
    Flight::json(Flight::bookingssService()->getEventByName($id));
});
