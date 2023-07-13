<?php

/**
 * @OA\Get(path="/events/", tags={"events"}, summary="Returns all events from the api ", security={{"ApiKeyAuth": {}}},
 *      @OA\Response(response=200,description="List of events")
 * )
 */

Flight::route('GET /events', function () {
    Flight::json(Flight::eventsService()->getEventsWithVenues());
});


/**
* @OA\Post(
*     path="/events",
*     description="Add new events to db",
*     tags={"events"},
*     summary="Adds new events to the db",
*     security={{"ApiKeyAuth": {}}},
*     @OA\RequestBody(description="Basic event info", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*           @OA\Property(property="event_id", type="int", example="1",	description="Id of the event")
*        )
*     )),
*     @OA\Response(
*         response=200,
*         description="ticketsevents added"
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

Flight::route('POST /events', function(){
    $data = Flight::request()->data->getData();
    $ticketsEvents = Flight::eventsService()->add($data);

});

/**
*   @OA\Delete(
*     path="/events/{id}", security={{"ApiKeyAuth": {}}},
*     description="Delete events",
*     summary="Deletes events from db by its id",
*     tags={"events"},
*     @OA\Parameter(in="path", name="id", example=1, description="Id of events"),
*     @OA\Response(
*         response=200,
*         description="deleted"
*     ),
*     @OA\Response(
*         response=500,
*         description="Error, may indicate JWT abuse"
*     )
* )
*/
Flight::route('DELETE /events/@id', function($id){

    Flight::eventsService()->delete($id);
    Flight::json(['message'=>'deleted']);
});
