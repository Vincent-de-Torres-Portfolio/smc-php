<?php
session_start();

// Validate and sanitize the session token
$tokenFromSession = isset($_SESSION['token']) ? htmlspecialchars($_SESSION['token']) : null;

try {
    require_once "CONSTANTS.php";
    require_once DIR_USER_AUTH_FORM_HANDLER_PATH . "AuthValidation.php";
    $validToken = isTokenValid($tokenFromSession);

    // Additional debug output
    echo "Validation process started.<br>";

    // Validate and sanitize the session token
    if ($tokenFromSession === null) {
        // If the token is not set in the session, log an error
        echo "ERROR: Session token is not set.<br>";
    } else {
        // If the token is set, proceed with validation
        echo "Session token: " . $tokenFromSession . "<br>";
        echo "Validation result: " . ($validToken ? "Valid" : "Invalid") . "<br>";
    }

} catch (Exception $e) {
    // Log the exception or take appropriate action
    echo "ERROR: Exception caught - " . $e->getMessage() . "<br>";
    echo "SERVER UNAVAILABLE";
}

// Check if the token is valid and exists in the session
if (isset($_SESSION['token']) && $validToken) {
    // Redirect to home.php if the token is valid
    header('Location: pages/home.php');
    exit();
} else {
    // Token is not valid or doesn't exist, redirect to login.php
    header('Location: pages/UserManagement/login.php');
    exit();
}

