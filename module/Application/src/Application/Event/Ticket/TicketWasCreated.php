<?php

namespace Application\Event\Ticket;

class TicketWasCreated
{
    private $ticketId;

    public function __construct($ticketId)
    {
        // validate that $ticketId is a UUID
        $this->ticketId = $ticketId;
    }

    public function getTicketId()
    {
        return $this->ticketId;
    }
}
