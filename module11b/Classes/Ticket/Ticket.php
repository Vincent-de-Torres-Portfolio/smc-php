<?php

namespace Classes\Ticket;

use Classes\Movie;
use Classes\Member;

abstract class Ticket {
    protected $id;
    protected $movie;
    protected $member;
    protected $type;
    protected $price;
    protected $purchaseDate;
    protected $theaterNumber;
    protected $movieSchedule;

    protected $movieName;


    public function __construct(Movie $movie, Member $member) {
        $this->movie = $movie;
        $this->member = $member;
        $this->purchaseDate =null;
        $this->id = $this->generateId(); // Generate ticket ID
        $this->setScheduleInfo(); // Set theater number and movie schedule
        $this->type = $this->calculateType();
        $this->price = $this->calculatePrice();
        $this->movieName = $this->movie->getTitle(); // Assign the movie name


    }

    protected abstract function calculateType();

    protected abstract function calculatePrice();

    protected function generateId(): string {
        $movieId = $this->movie->getMovieId();
        $ticketNumber = $this->movie->getAndIncrementTicketNumber();
        $paddedTicketNumber = str_pad($ticketNumber, 5, '0', STR_PAD_LEFT); // Ensure 5 characters, prepended with '0' if necessary
        return $movieId . '-' . $paddedTicketNumber;
    }

    public function getMovieName()
    {
        return $this ->movieName;

    }

    protected function setScheduleInfo(int $index = 0) {
        $schedules = $this->movie->getSchedules();
        if (!isset($schedules[$index])) {
            throw new \InvalidArgumentException('Invalid schedule index.');
        }
        $this->theaterNumber = $schedules[$index]['theaterNumber'];
        $this->movieSchedule = $schedules[$index]['movieSchedule'];
    }

    public function getId(): string {
        return $this->id;
    }

    public function getMovie(): Movie {
        return $this->movie;
    }


    public function getMember(): Member {
        return $this->member;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getPrice(): float {
        return $this->price;
    }

    public function getPurchaseDate(): string {
        return $this->purchaseDate;
    }

    public function getTheaterNumber(): int {
        return $this->theaterNumber;
    }

    public function getMovieSchedule(): string {
        return $this->movieSchedule;
    }

    public function getHtmlDetails(): string {
        $details = "<div class='ticket-details'>";
        $details .= "<h3>Ticket Details</h3>";
        $details .= "<p>Ticket ID: {$this->id}</p>";
        $details .= "<p>Movie: {$this->movie->getTitle()}</p>";
        $details .= "<p>Member: {$this->member->getName()}</p>";
        $details .= "<p>Type: {$this->type}</p>";
        $details .= "<p>Price: {$this->price}</p>";
        $details .= "<p>Purchase Date: {$this->purchaseDate}</p>";
        $details .= "<p>Theater Number: {$this->theaterNumber}</p>";
        $details .= "<p>Movie Schedule: {$this->movieSchedule}</p>";
        $details .= "</div>";
        return $details;
    }

}
