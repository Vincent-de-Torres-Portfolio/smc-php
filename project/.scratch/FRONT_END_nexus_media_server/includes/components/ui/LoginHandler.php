<?php

/**
 * PHP Login Handler for Proof of Concept
 *
 * This script handles the login logic for a proof-of-concept login system.
 * It checks the entered credentials against hardcoded values and redirects accordingly.
 * In case of unsuccessful login, it redirects back to the login page with an error and sticky form.
 */

// Hardcoded credentials (for proof of concept)
$validUsername = 'user';
$validPassword = 'default';

/**
 * Sanitize input data.
 *
 * @param string $data The input data to be sanitized.
 * @return string The sanitized data.
 */
function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize input
    $enteredUsername = sanitizeInput($_POST['username']);
    $enteredPassword = sanitizeInput($_POST['password']);

    // Validate input
    if ($enteredUsername === $validUsername && $enteredPassword === $validPassword) {
        // Successful login
        header('Location: ../index.php'); // Redirect to index.php on success
        exit();
    } else {
        // Invalid credentials, redirect back to login.php with sticky form
        header('Location: ../login.php?error=1&username=' . urlencode($enteredUsername));
        exit();
    }
} else {
    // Redirect to login.php if accessed directly without form submission
    header('Location: ../login.php');
    exit();
}
