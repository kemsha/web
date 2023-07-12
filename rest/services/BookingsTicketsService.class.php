<?php

require_once __DIR__.'/BaseService.class.php';
require_once __DIR__.'/../dao/BookingsTicketsDao.class.php';
require_once __DIR__.'/../dao/BookingsDao.class.php';
require_once __DIR__.'/../dao/AuthDao.class.php';
require_once __DIR__.'/../dao/EventsDao.class.php';
require_once __DIR__.'/../dao/TicketsEventsDao.class.php';

class BookingsTicketsService extends BaseService
{
    
    private $authDao;
    private $eventsDao;
    private $bookingsDao;
    private $eventsAndTicketsDao;

    public function __construct()
    {
        parent::__construct(new BookingsTicketsDao());   
        $this->authDao = new AuthDao();
        $this->eventsDao = new EventsDao();
        $this->bookingsDao = new BookingsDao();
        $this->eventsAndTicketsDao = new TicketsEventsDao();
    }     

    public function addBookingAndTicket($params)
    {
        $user = $this->authDao->getAuthByEmail($params['email']);
        $event = $this->eventsDao->getEventByName($params['event_name']);

        $booking = $this->bookingsDao->add([
            'booking_date' => $params['booking_date'],
            'users_id' => $user['id'],
            'events_id' => $event['id']
        ]);

        $bookingAndTicket = $this->dao->add([
            'ticket_amount_type' => $params['ticket_amount_type'],
            'bookings_id' => $booking['id'],
            'bookings_tickets_id' => $params['ticket_id']
        ]);

        return $bookingAndTicket;
    }
}