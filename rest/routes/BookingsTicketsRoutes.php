<?php
/**
     * @OA\Get(path="/bookingstickets", tags={"bookings and tickets"}, summary="Returns all bookings and tickets from the api. ", security={{"ApiKeyAuth": {}}},
     *      @OA\Response( response=200, description="List of users")
     *  )
     */
Flight::route('GET /bookingstickets', function () {
    Flight::json(Flight::BookingsTicketsService()->getAll());
});
 /**
     * @OA\Get(path="/bookingstickets/{id}", tags={"bookings and tickets"}, summary="Returns a single bookingstickets by id", security={{"ApiKeyAuth": {}}},
     *     @OA\Parameter(in="path", name="id", example=1, description="Id of bookingstickets"),
     *     @OA\Response(response="200", description="Fetch individual bookingstickets")
     * )
     */

Flight::route('GET /bookingstickets/@id', function(){
    Flight::json(Flight::BookingsTicketsService()->getEventsAndTicketById($id));
});
/**
* @OA\Post(
*     path="/bookingstickets",
*     description="Add a new bookingstickets to db",
*     tags={"bookings and tickets"},
*     summary="Adds a new bookingstickets to the db",
*     security={{"ApiKeyAuth": {}}},
*     @OA\RequestBody(description="Basic info", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*           @OA\Property(property="tickets_id", type="int", example="1",	description="Id of the ticket"),
*           @OA\Property(property="booking_id", type="int", example="1",	description="Id of the booking")
*        )
*     )),
*     @OA\Response(
*         response=200,
*         description="bookingstickets added"
*     ),
*     @OA\Response(
*         response=404,
*         description="Unexpected error"
*     ),
*     @OA\Response(
*         response=403,
*         description="JWT token not passed"
*     )
* )
*/

Flight::route('POST /bookingstickets', function(){
    $data = Flight::request()->data->getData();
    $ticketsEvents = Flight::BookingsTicketsService()->add($data);

});


/**
*   @OA\Delete(
*     path="/bookingstickets/{id}", security={{"ApiKeyAuth": {}}},
*     description="Delete bookingstickets",
*     summary="Deletes a bookingstickets from db by its id",
*     tags={"orders"},
*     @OA\Parameter(in="path", name="id", example=1, description="Id of bookingstickets"),
*     @OA\Response(
*         response=200,
*         description="Bookingstickets deleted"
*     ),
*     @OA\Response(
*         response=500,
*         description="Error, may indicate JWT abuse"
*     )
* )
*/
Flight::route('DELETE /bookingstickets', function(){
    Flight::BookingsTicketsService()->delete($id);
    Flight::json(['message'=>'deleted']);
});