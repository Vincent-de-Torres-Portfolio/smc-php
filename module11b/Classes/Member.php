<?php

namespace Classes;
use Classes\Ticket\Ticket;
class Member {
    private $name;
    private $member_id;
    private $email;
    private $registration_date;
    private $birthday;
    private $age;
    private $watchlist;
    private $history;
    private $balance;
    private $tickets;

    public function __construct($name, $email, $birthday,$member_id) {
        $this->name = $name;
        $this->member_id=$member_id;
        $this->email = $email;
        $this->registration_date = date('Y-m-d'); // Set registration date to current date
        $this->watchlist = array();
        $this->history = array();
        $this->birthday = $birthday;
        $this->age = $this->calculateAge();
        $this->balance = 0; // Initialize balance to 0
        $this->tickets=[];
    }

    // Getter and setter methods for properties
    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getMemberId()
    {
        return $this->member_id;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getRegistrationDate() {
        return $this->registration_date;
    }

    private function calculateAge() {
        $birthDate = new \DateTime($this->birthday);
        $currentDate = new \DateTime();
        return $currentDate->diff($birthDate)->y;
    }

    public function getAge() {
        return $this->calculateAge();
    }

    public function getWatchlist() {
        return $this->watchlist;
    }

    public function addToWatchlist($item) {
        $this->watchlist[] = $item;
    }

    public function getHistory() {
        return $this->history;
    }

    public function addToHistory($event) {
        $this->history[] = $event;
    }

    public function getBalance() {
        return $this->balance;
    }

    public function addTicket($ticket) {
        $this->tickets[] = $ticket;
    }

    // Method to get tickets array
    public function getTickets() {
        return $this->tickets;
    }

    // Method to add funds to balance
    private function addBalance($amount) {
        $this->balance += $amount;
    }

    // Method to deduct funds from balance
    private function deductBalance($amount) {
        $this->balance -= $amount;
    }

    // Method to make a purchase
    public function purchase($amount) {
        if ($amount < 0) {
            // If purchase amount is negative, it indicates adding funds to balance
            $this->addBalance(abs($amount));
        } else {
            // If purchase amount is positive, it indicates deducting funds from balance
            if ($this->balance >= $amount) {
                // Check if balance is sufficient for the purchase
                $this->deductBalance($amount);
                return $amount; // Return the amount deducted
            } else {
                return false; // Insufficient balance
            }
        }
        return true;
    }

    private function isTicketExpired(Ticket $ticket): bool {
        // Get the current date
        $currentDate = date('Y-m-d');
        // Compare the current date with the movie schedule date of the ticket
        return $currentDate > $ticket->getMovieSchedule();
    }

    public function getHtmlDetails(): string {
        $details = "<div class='member-details'>";
        $details .= "<h2>Member Details</h2>";
        $details .= "<p>Name: {$this->name}</p>";
        $details .= "<p>Member ID: {$this->member_id}</p>";
        $details .= "<p>Email: {$this->email}</p>";
        $details .= "<p>Registration Date: {$this->registration_date}</p>";
        $details .= "<p>Age: {$this->age}</p>";
        $details .= "<p>Balance: {$this->balance}</p>";

        // Display tickets and their expiration status
        $details .= "<h3>Tickets</h3>";
        if (!empty($this->tickets)) {
            $details .= "<table border='1'>";
            $details .= "<tr><th>Ticket ID</th><th>Movie Title</th><th>Schedule</th><th>Expiration</th></tr>";
            foreach ($this->tickets as $ticket) {
                $expired = $this->isTicketExpired($ticket) ? 'Expired' : 'Active';
                $details .= "<tr>";
                $details .= "<td>{$ticket->getId()}</td>";
                $details .= "<td>{$ticket->getMovie()->getTitle()}</td>";
                $details .= "<td>{$ticket->getMovieSchedule()}</td>";
                $details .= "<td>$expired</td>";
                $details .= "</tr>";
            }
            $details .= "</table>";
        } else {
            $details .= "<p>No tickets found.</p>";
        }

        $details .= "</div>";
        return $details;
    }
}
