<?php
/**
 * This script initializes the user directory for the logged-in user.
 */

// Include necessary files
include_once 'database.php';
include_once 'function.php';
include_once '..\Classes\Utility\FileMetadataUtility\FileMetadataUtility.php';
session_start();

// Establish database connection
$db = getDbConnection();

// Set session variables for testing purposes (replace with actual values in production)
$_SESSION['user_id'] = "000001";
$_SESSION['username'] = "vdetorres";

/**
 * Logs a message to a log file.
 *
 * @param string $message The message to be logged.
 */
function logMessage($message) {
    $logFilePath = 'log.txt';
    $logMessage = date('Y-m-d H:i:s') . " - IP: {$_SERVER['REMOTE_ADDR']} - $message\n";
    file_put_contents($logFilePath, $logMessage, FILE_APPEND);
}

// Check if the necessary session variables are set
if (isset($_SESSION['user_id'], $_SESSION['username'])) {
    // Define constant for APP_DATA_DIR
    define('APP_DATA_DIR', '../DATA');

    // Create user directory
    $username = $_SESSION['username'];
    $userId = $_SESSION['user_id'];
    $userDir = APP_DATA_DIR . '/' . $userId . '_' . $username;

    try {
        // Attempt to create the main user directory
        if (!file_exists($userDir)) {
            // Create the main user directory
            if (!mkdir($userDir, 0700, true)) {
                throw new Exception("Failed to create user directory.");
            }

            // Create subdirectories within the user directory
            $subdirectories = ['Home', 'Music', 'Photos', 'Recents', 'Trash', 'Uploads', 'Videos'];

            foreach ($subdirectories as $subdir) {
                mkdir($userDir . '/' . $subdir, 0755, true);
                // Insert record into the user directories table
                insertUserDirectory($db, $userId, $subdir, $username);
            }

            // Set file permissions for the user directory
            chmod($userDir, 0700);

            // Log success message
            logMessage("User directory setup completed successfully.");
        } else {
            // Log message if user directory already exists
            logMessage("User directory already exists.");
        }
    } catch (Exception $e) {
        // Log error message and handle exceptions
        logMessage("Error: " . $e->getMessage());
    }
} else {
    // Redirect to the registration page with an error message if session variables are not set
    header("Location: ../index.php?action=register&error=invalid_access");
    exit();
}
