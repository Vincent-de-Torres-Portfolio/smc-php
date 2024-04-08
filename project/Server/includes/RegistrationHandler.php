<?php

include_once "../vendor/autoloader.php";

use Models\User;
use Models\SessionToken;
use Models\Sanitizer;
use Models\Database;

session_start();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Instantiate the Sanitizer class
    $sanitizer = new Sanitizer();

    $first_name = $sanitizer->sanitizeInput($_POST['firstname']);
    $last_name = $sanitizer->sanitizeInput($_POST['lastname']);
    $user_name = $sanitizer->sanitizeInput($_POST['username']);
    $email_address = $sanitizer->sanitizeInput($_POST['email']);
    $password = password_hash($sanitizer->sanitizeInput($_POST['password']), PASSWORD_BCRYPT);

    // Create a User object
    $user = new User();


    if ($user->register($first_name, $last_name, $user_name, $email_address, $password)) {
        // Generate a dynamically generated access code
        $access_code = bin2hex(random_bytes(16));

        // Set the access code to the session
        $_SESSION['access_code'] = $access_code;

        // Redirect to oobe.php after successful registration
        header("Location: ../oobe.php");
        exit();
    }
} else {
    if (isset($conn)) {
        mysqli_close($conn);
    }
    header("Location: ../index.php?error=access_invalid");
    exit();
}