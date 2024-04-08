<?php
session_start();

// Function to sanitize input
function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

// Function to generate a random string
function generateRandomString($length = 5) {
    return substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, $length);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate input
    $fullname = sanitizeInput($_POST['fullname']);
    $email = sanitizeInput($_POST['email']);
    $username = sanitizeInput($_POST['username']);
    $password = sanitizeInput($_POST['password']);
    $verifyPassword = sanitizeInput($_POST['verify-password']);

    // Add additional validation checks if needed

    // Check if passwords match
    if ($password !== $verifyPassword) {
        header('Location: register.php?error=password_mismatch');
        exit();
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Generate a random string for password reset
    $resetCode = generateRandomString();

    // Save reset code to session
    $_SESSION['reset_code'] = $resetCode;

    // Write user data to CSV file (or your preferred storage)
    $userData = [$fullname, $email, $username, $hashedPassword, $resetCode];
    $csvFileName = 'user_data.csv';

    if (!file_exists($csvFileName)) {
        $csvHeader = ['Full Name', 'Email', 'Username', 'Password', 'Reset Code'];
        file_put_contents($csvFileName, implode(',', $csvHeader) . PHP_EOL);
    }

    file_put_contents($csvFileName, implode(',', $userData) . PHP_EOL, FILE_APPEND);

    //Store full name in temp cookie

    $_COOKIE('name', $fullname);

    // Redirect to success page or login page
    header('Location: user_added.php');
    exit();
} else {
    // Redirect to index.php if accessed directly without form submission
    header('Location: login.php');
    exit();
}
