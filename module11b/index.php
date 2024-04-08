<?php
require_once 'autoload.php';

//// Include the required classes and utilities
//require_once 'Classes\Member.php';
//require_once 'Classes\Movie.php';
//require_once 'Classes\Cart.php';
//require_once 'Classes\Ticket\Ticket.php';
//require_once 'Classes\Ticket\ChildTicket.php';
//require_once 'Classes\Ticket\StudentTicket.php';
//require_once 'Classes\Ticket\SeniorTicket.php';
//require_once 'Classes\Ticket\GeneralTicket.php';
//require_once 'Utility\Utility.php';
//require_once 'Utility\CartUtility.php';
//require_once 'Utility\TicketUtility.php';
//require_once 'Utility\MovieUtility.php';
//require_once 'UI\MovieCard.php';
//require_once 'UI\CartSummary.php';

use UI\MovieCard;
use UI\CartSummary;
use Utility\GeneralUtility\GeneralUtility;
use Utility\MovieUtility;
use Utility\TicketUtility;
use Utility\CartUtility;
use Classes\Member;
use Classes\Cart;
use Classes\Movie;
use Classes\Ticket\ChildTicket;
use Classes\Ticket\StudentTicket;
use Classes\Ticket\GeneralTicket;
use Classes\Ticket\SeniorTicket;

// Include config file
require_once 'config.php';

function findMovieByID($movies, $movieID) {
    foreach ($movies as $movie) {
        if ($movie->getMovieId() === $movieID) {
            return $movie;
        }
    }
    // Return null if no movie with the given ID is found
    return null;
}

function createTicketByType($movie, $member, $ticketType) {
    switch ($ticketType) {
        case 'CHILD':
            return new ChildTicket($movie, $member);
        case 'STUDENT':
            return new StudentTicket($movie, $member);
        case 'GENERAL':
            return new GeneralTicket($movie, $member);
        case 'SENIOR':
            return new SeniorTicket($movie, $member);
        default:
            // Handle invalid ticket type
            return null;
    }
}



// Initialize session variables if not already set
    // Initialize member object
    $member = new Member($memberData["name"], $memberData["email"], $memberData["birthdate"], $memberData["memberId"]);
//    print_r($member);
    // Initialize cart object
    $cart = new Cart("ZdbozD", $member);
//    print_r($cart);
    // Initialize movie objects
    $movies = [];

    foreach ($moviesData as $movie) {
            $movieObject= new Movie($movie["movieId"], $movie["title"], $movie["genre"], $movie["cost"], $movie["poster"], $movie["schedules"]);
        if ($movieObject){
//            print_r($movieObject);
            $movies[]=$movieObject;
        }else{
            echo "Error";
        }
    }




    // Store session variables
    $_SESSION["member"] = $member->getName();
    $_SESSION["member_object"] = $member;
    $_SESSION["member_id"] = $member->getMemberId();
    $_SESSION["cart"] = $cart;
    $_SESSION["movies"] = $movies;
    $_SESSION["tickets_in_cart"]=array();



// Include header
include_once "includes/header.php";
?>

<main id="app-main">
    <div class="container">
        <h1 class="title-medium-text">
            Welcome Back <?php echo $_SESSION["member"]; ?>!
        </h1>
        <p class="caption-text">
            <strong>ID: </strong><?php echo $_SESSION["member_id"]; ?>
        </p>
    </div>
    <div class="grid grid-2">
        <div class="card" id="cart">
            <?php
            if (isset($_GET['action']) && $_GET['action'] == "addToCart") {
//                print_r($_GET);

                $action = $_GET['action'] ?? null;
                $movie_id = $_GET['movie_id'] ?? null;
                $ticket_type = $_GET['ticket_type'] ?? null;
                $quantity = $_GET['quantity'] ?? null;
                $movie_to_add=findMovieByID($movies,$movie_id);
//                var_dump($movie_to_add);
                $ticket_to_add=createTicketByType($movie_to_add,$member,$ticket_type);
                $_SESSION["tickets_in_cart"][]=$ticket_to_add;

            }
            foreach ($_SESSION["tickets_in_cart"] as $ticket) {
CartUtility::addTicketToCart($cart,$ticket);
$cart->getCartSummary();
            }
            echo $cart->getCartSummary();

            ?>
        </div>
        <div class="movie-grid" id="store-front">
            <?php foreach ($_SESSION["movies"] as $movie) :
                $movieID = $movie->getMovieId();
                $movieTitle = $movie->getTitle();
                $movieCost = $movie->getCost();
                $movieGenre = $movie->getGenre();
                $movieSchedules = $movie->getSchedules();
                $movieSchedule = $movieSchedules[0]["movieSchedule"];
                $theaterNumber = $movieSchedules[0]["theaterNumber"];
                $poster = $movie->getPoster();
                echo MovieCard::generateMovieCard($movieTitle, $movieID, $movieGenre, $poster, $movieSchedule, $movieCost);
            endforeach; ?>
        </div>
    </div>
</main>

<?php include_once "includes/footer.php"; ?>
