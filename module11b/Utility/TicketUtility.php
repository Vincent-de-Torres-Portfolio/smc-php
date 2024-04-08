<?php

namespace Utility;

use Classes\Member;
use Classes\Movie;
use Classes\Ticket\ChildTicket;
use Classes\Ticket\StudentTicket;
use Classes\Ticket\GeneralTicket;
use Classes\Ticket\SeniorTicket;

class TicketUtility
{
    public static function createTicket(string $ticketType, Movie $movie, Member $member)
    {
        switch (strtoupper($ticketType)) {
            case 'CHILD':
                return new ChildTicket($movie, $member);
            case 'STUDENT':
                return new StudentTicket($movie, $member);
            case 'GENERAL':
                return new GeneralTicket($movie, $member);
            case 'SENIOR':
                return new SeniorTicket($movie, $member);
            default:
                throw new \InvalidArgumentException('Invalid ticket type.');
        }
    }
}
