<?php
namespace Classes\Ticket;
class GeneralTicket extends Ticket {
    protected function calculateType() {
        return "General";
    }

    protected function calculatePrice() {
        // General ticket price is same as the base price
        return $this->getMovie()->getCost();
    }
}
