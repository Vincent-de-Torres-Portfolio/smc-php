<?php
include_once "../vendor/autoloader.php";
use Models\User;
use Models\SessionToken;
use Models\Sanitizer;
use Models\Database;
function startSession() {
    session_start();
}

function setSessionVariables($user) {
    $_SESSION['user_id'] = $user->getId();
    $_SESSION['username'] = $user->getUsername();
    $_SESSION['user_directories'] = $user->getLibraryDirectories();
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function destroySession() {
    session_unset();
    session_destroy();
}

// Check if login form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
    $user = new User();

    // Assuming your login method takes username and password
    if ($user->login($_POST['username'], $_POST['password'])) {
        // Start session and set session variables on successful login
        startSession();
        setSessionVariables($user);

        // Redirect or perform other actions after successful login
        header('Location: ../dashboard.php');
        exit();
    } else {
        // Handle login failure, show error message or redirect to login page
        echo "Login failed!";
    }
}

// Check if the user is logged in
if (isLoggedIn()) {
    // User is logged in, perform actions or display content accordingly
    echo "User is logged in!";
} else {
    // User is not logged in, display login form or redirect to login page
    echo "User is not logged in!";
}

// Logout functionality
if (isset($_GET['logout'])) {
    destroySession();
    // Redirect to login page or any other page after logout
    header('Location: login.php');
    exit();
}

