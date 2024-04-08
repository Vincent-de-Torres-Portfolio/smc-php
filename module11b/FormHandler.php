<?php
session_start();

// Include the required classes and utilities
require_once 'Classes/Member.php';
require_once 'Classes/Movie.php';
require_once 'Classes/Cart.php';

require_once 'Classes/Ticket/Ticket.php';
require_once 'Classes/Ticket/ChildTicket.php';
require_once 'Classes/Ticket/StudentTicket.php';
require_once 'Classes/Ticket/SeniorTicket.php';
require_once 'Classes/Ticket/GeneralTicket.php';

require_once 'Utility/Utility.php';
require_once 'Utility/CartUtility.php';
require_once 'Utility/TicketUtility.php';
require_once 'Utility/MovieUtility.php';
require_once 'Utility/Cookie.php';

use Utility\CartUtility;
use Utility\TicketUtility;
use Utility\MovieUtility;

use Classes\Member;
use Classes\Cart;
use Classes\Movie;
use Classes\Ticket\ChildTicket;
use Classes\Ticket\StudentTicket;
use Classes\Ticket\GeneralTicket;
use Classes\Ticket\SeniorTicket;

// Check if the action is to add a ticket to the cart
if ($_GET["action"] === "addToCart") {
    // Retrieve data from the form
    $movieId = $_GET["movie_id"];
    $ticketType = $_GET["ticket_type"];

    // Retrieve movies from the session
    $movies = $_SESSION["movies"];

    // Retrieve the selected movie
    $selectedMovie = $movies[$movieId];
    echo $selectedMovie;

    // Create a Movie object based on the selected movie
    $movie = new Movie(
        $selectedMovie->getMovieId(),
        $selectedMovie->getTitle(),
        $selectedMovie->getGenre(),
        $selectedMovie->getCost(),
        $selectedMovie->getSchedules(),
        $selectedMovie->getTicketNumber(),
        $selectedMovie->getPoster()
    );

    // Retrieve member object (Assuming it's stored in session)
    $member = $_SESSION["member_object"];

    // Create the appropriate ticket based on the selected ticket type
    switch ($ticketType) {
        case 'child':
            $ticket = new ChildTicket($movie, $member);
            break;
        case 'student':
            $ticket = new StudentTicket($movie, $member);
            break;
        case 'senior':
            $ticket = new SeniorTicket($movie, $member);
            break;
        case 'general':
        default:
            $ticket = new GeneralTicket($movie, $member);
            break;
    }

    // Check if the cart exists in the session
    if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = new Cart("jnbjk",$member); // Assuming Cart class exists
    }

    // Add the ticket to the cart
    $_SESSION["cart"]->addTicket($ticket);

    // Redirect to the cart page or any other page
    header("Location: index.php");
    exit();
}