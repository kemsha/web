<?php

/**
 * @OA\Get(path="/ticketsevents/", tags={"tickets and events"}, summary="Returns all tickets and events from the api ", security={{"ApiKeyAuth": {}}},
 *      @OA\Response(response=200,description="List of tickets and events")
 * )
 */

Flight::route('GET /ticketsevents', function () {
    Flight::json(Flight::TicketsEventsService()->getAll());
});

/**
 * @OA\Get(path="/ticketsevents/{id}", tags={"tickets and events"}, summary="Returns a single ticketsevents by id", security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(in="path", name="id", example=1, description="Id of tickets and events"),
 *     @OA\Response(response="200", description="Fetch individual ticketsevents")
 * )
 */

Flight::route('GET /ticketsevents/@id', function(){
    Flight::json(Flight::TicketsEventsService()->getEventsAndTicketById($id));
});

/**
* @OA\Post(
*     path="/ticketsevents",
*     description="Add a new ticketsevents to db",
*     tags={"tickets and events"},
*     summary="Adds a new ticketsevetns to the db",
*     security={{"ApiKeyAuth": {}}},
*     @OA\RequestBody(description="Basic event info", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*           @OA\Property(property="ticket_id", type="int", example="1",	description="Id of the ticket"),
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

Flight::route('POST /ticketsevents', function(){
    $data = Flight::request()->data->getData();
    $ticketsEvents = Flight::TicketsEventsService()->add($data);

});

/**
*   @OA\Delete(
*     path="/ticketsevents/{id}", security={{"ApiKeyAuth": {}}},
*     description="Delete ticketsevents",
*     summary="Deletes ticketsevents from db by its id",
*     tags={"tickets and events"},
*     @OA\Parameter(in="path", name="id", example=1, description="Id of ticketsevents"),
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

Flight::route('DELETE /ticketsevents', function(){
    Flight::ticketsEventsService()->delete($id);
    Flight::json(['message'=>'deleted']);
});