<?php

/**
 * @OA\Get(path="/tickets/", tags={"orders"}, summary="Returns all tickets from the api. ", security={{"ApiKeyAuth": {}}},
 *      @OA\Response(response=200,description="List of tickets")
 * )
 */
Flight::route('GET /tickets', function () {
    Flight::json(Flight::TicketsService()->getAll());
});

/**
 * @OA\Get(path="/tickets/{id}", tags={"orders"}, summary="Returns a ticket by id",security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(in="path", name="id", example=1, description="Id of ticket"),
 *     @OA\Response(response="200", description="Fetch individual ticket")
 * )
 */
Flight::route('GET /tickets/@id', function(){
    Flight::json(Flight::TicketService()->getTicketById($id));
});
