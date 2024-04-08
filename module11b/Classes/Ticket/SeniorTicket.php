<?php
namespace Classes\Ticket;
class SeniorTicket extends Ticket {
    protected function calculateType() {
        return "Senior";
    }

    protected function calculatePrice() {
        // Calculate senior citizen ticket price logic here
        // For example, $2 off for seniors (over 55 years old)
        return $this->getMovie()->getCost() - 2;
    }
}
