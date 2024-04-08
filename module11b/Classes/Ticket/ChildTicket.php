<?php
namespace Classes\Ticket;

class ChildTicket extends Ticket {
    protected function calculateType() {
        return "Child";
    }

    protected function calculatePrice() {
        // Calculate child ticket price logic here
        // Free (0-4 years old)
        return $this->getMovie()->getCost() * 0;
    }
}

