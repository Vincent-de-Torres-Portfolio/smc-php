<?php
namespace Classes\Ticket;
class StudentTicket extends Ticket {
    protected function calculateType() {
        return "Student";
    }

    protected function calculatePrice() {
        // Calculate student ticket price logic here
        // For example, discounted price for students/[5-17]
        return $this->getMovie()->getCost() * 0.5; // 50% discount
    }
}
