<?php

namespace Classes;

class Movie {
    private $movieId;
    private $title;
    private $genre;
    private $cost;
    private $schedules;
    private $ticketNumber;
    private $poster;

    public function __construct($movieId, $title, $genre, $cost, $poster,$schedules) {
        $this->movieId = strtoupper($movieId);
        $this->title = $title;
        $this->genre = $genre;
        $this->cost = $cost;
        $this->schedules = $schedules;
        $this->ticketNumber = 1;
        $this->poster=$poster;
    }

    // Getter and setter methods for properties
    public function getMovieId() {
        return $this->movieId;
    }

    public function getAndIncrementTicketNumber() {
        return $this->ticketNumber++;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getGenre() {
        return $this->genre;
    }

    public function setGenre($genre) {
        $this->genre = $genre;
    }

    public function getCost() {
        return $this->cost;
    }

    public function setCost($cost) {
        $this->cost = $cost;
    }

    public function getPoster() {
        return $this->poster;
    }

    public function setPoster($poster) {
        $this->poster=$poster;
    }

    public function getSchedules() {
        return $this->schedules;
    }

    public function setSchedules($schedules) {
        $this->schedules = $schedules;
    }

    public function toArray() {
        return [
            'movieId' => $this->movieId,
            'title' => $this->title,
            'genre' => $this->genre,
            'cost' => $this->cost,
            'schedules' => $this->schedules,
            'poster' => $this->poster
            // Add other properties as needed
        ];
    }


}
