<?php

/**
 * PHP Login Handler with Session Token stored in CSV
 *
 * This script handles the login logic with improved security features.
 * It checks the entered credentials against hashed values and uses session tokens.
 * Session information is stored in a CSV file.
 */

session_start(); // Start a session

// Include the file containing showMessage and other functions
require_once('../../templates/components/index.php');

// Hardcoded credentials (for proof of concept)
$validUsername = 'user';
$validPasswordHash = password_hash('default', PASSWORD_BCRYPT); // Use password_hash to securely hash the password

/**
 * Sanitize input data.
 *
 * @param string $data The input data to be sanitized.
 * @return string The sanitized data.
 */
function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

/**
 * Generate a session token.
 *
 * @return string The generated session token.
 */
function generateSessionToken() {
    return bin2hex(random_bytes(32)); // Use a secure random function to generate a token
}


/**
 * Destroy the session and redirect to the login page.
 */
function logout() {
    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to the login page
    header('Location: ../login.php?logout=1');
    exit();
}

/**
 * Write session information to CSV.
 *
 * @param string $username The username.
 * @param string $token The session token.
 * @param string $status The status.
 */
function writeSessionToCSV($username, $token, $status = 'active') {
    $data = [date('Y-m-d H:i:s'), date('Y-m-d H:i:s', strtotime('+1 hour')), $username, $token, $status];
    $filePath = '../SESSIONS.csv';

    // Check if the file exists, create it if not
    if (!file_exists($filePath)) {
        $file = fopen($filePath, 'w');
        // Add headers if creating a new file
        fputcsv($file, ['Start Time', 'End Time', 'Username', 'Token', 'Status']);
    } else {
        $file = fopen($filePath, 'a');
    }

    // Write session information to CSV
    fputcsv($file, $data);
    fclose($file);
}


// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize input
    $enteredUsername = sanitizeInput($_POST['username']);
    $enteredPassword = sanitizeInput($_POST['password']);

    // Validate input
    if ($enteredUsername === $validUsername && password_verify($enteredPassword, $validPasswordHash)) {
        // Successful login
        $sessionToken = generateSessionToken();
        $_SESSION['user'] = $enteredUsername;
        $_SESSION['token'] = $sessionToken;

        // Write session information to CSV
        writeSessionToCSV($enteredUsername, $sessionToken);

        header('Location: ../../home.php'); // Redirect to home.php on success
        exit();
    } else {
        // Invalid credentials, set error session variable and redirect back to login.php with sticky form
        $_SESSION['invalidCredential'] = true;
        header('Location: ../login.php?error=1&username=' . urlencode($enteredUsername));
        exit();
        // Invalid credentials, set error session variable and display error message
//        echo showMessage('error', 'Invalid Credentials');
    }
} elseif (isset($_GET['logout'])) {
    // Check if the logout parameter is present in the URL
    // Call the logout function
    logout();
} elseif (isset($_GET['expire']) && isset($_SESSION['token'])) {
    // Check if the expire parameter is present in the URL and a session token is set
    // Expire the session
    expireSession($_SESSION['token']);
    logout(); // Logout after expiring the session
} else {
    // Redirect to login.php if accessed directly without form submission, logout, or expire parameters
    header('Location: ../login.php');
    exit();
}
