<?php
require_once __DIR__.'/BaseService.class.php';
require_once __DIR__.'/../EventsDao.class.php';
require_once __DIR__.'/../UsersDao.class.php';
require_once __DIR__.'/../TicketsDao.class.php';

class BookingsService extends BaseService
{
    private $eventsDao;
    private $usersDao;
    private $ticketsDao;


    public function __construct()
    {
        parent::__construct(BookingsDao::getInstance());
        $this->eventsDao = EventsDao(getInstance());
        $this->usersDao = UsersDao(getInstance());
        $this->ticketsDao = TicketsDao(getInstance());
    }

    public function getBookingsAndUsers(){
        return $this->dao->getBookingsAndUsers();
    }

    public function getBookingsAndUsersByID($id){
        return $this->dao->getBookingsAndUsersByID($id);
    }

    public function getEventByID($id){
        return $this->dao->getEventByID($id);
    }

    public function getEventsTicketsById($id){
        return $this->dao->getEventsTicketsById();
    }


    public function addBookingWithUser($bookingDescriptor) {
        $event = $this->eventsDao->getEventWithName($bookingDescriptor['event_name']);
        $user = $this->usersDao->getUsersByName($bookingDescriptor['first_name'], $bookingDescriptor['last_name']);

        if (!isset($event['id'])) {
            return null;
        } else {
            $calcAmount = $bookingDescriptor['ticket_amount'] * $ticket['ticket_price'];
        }
        $booking = $this->dao->add(['Ticket Amount'=>$bookingDescriptor['Ticket Amount']],
        'event_name'=> $bookingDescriptor['event_name'],
        'ticket_price'=> $calcAmount,
        'booking_date'=> $bookingDescriptor['Date_of_Booking'];
        'event_date'=> $bookingDescriptor['Date_of_Event'],
        'booked_by'=> $user['id']);

        $newInventory = $bookingDescriptor['Ticket_Amount'] + $ticket['In_inventory'];

        $this->eventsDao->update(['In_inventory'=>$newInventory], $event['id']);

        return $booking;
    }

    public function updateBooking($bookingDescriptor,$id){
        $event = $this->eventsDao->get_event_by_name($bookingDescriptor['event_name']);
        $user = $this->usersDao->get_user_by_name($bookingDescriptor['first_name'], $bookingDescriptor['last_name']);
        $oldBooking = $this->dao->getBookingsAndUsersByID($id);

        if(!isset($event['id'])) {
            return null;
        } else {
            $calcAmount = $bookingDescriptor['Ticket_Amount'] * $ticket['Ticket_Price'];
        }

        $booking = $this->dao->update(['Ticket_Amount'=>$bookingDescriptor['Ticket_Amount'],
        'event_name'=>$bookingDescriptor['event_name'],
        'Ticket_price'=>$calcAmount,
        'booking_date'=>$bookingDescriptor['Date_Of_Booking'],
        'event_date'=>$bookingDescriptor['Date_Of_Event'],
        'booked_by'=>$user['id']], $id);

        $newInventory = $bookingDescriptor['Ticket_Amount'] + ($ticket['In_inventory'])

    }
}

?>