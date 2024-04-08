<?php
include_once "../vendor/autoloader.php";
use Models\User;
use Models\SessionToken;
use Models\Sanitizer;
use Models\Database;

session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if files were uploaded
    if (!empty($_FILES['file']['name'][0])) {
        // Define the target directory
        $targetDirectory = '../static/test/';

        // Create the target directory if it doesn't exist
        if (!file_exists($targetDirectory) && !is_dir($targetDirectory)) {
            mkdir($targetDirectory, 0777, true);
        }

        // Process each uploaded file
        for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
            $fileName = $_FILES['file']['name'][$i];
            $tempFilePath = $_FILES['file']['tmp_name'][$i];
            $targetFilePath = $targetDirectory . sanitizeFileName($fileName);

            // Move the uploaded file to the target directory
            move_uploaded_file($tempFilePath, $targetFilePath);
        }

        // Display success message
        echo 'Files successfully uploaded!';
    } else {
        // No files were uploaded
        echo 'No files uploaded.';
    }
}

/**
 * Sanitize file name to prevent potential security issues.
 *
 * @param string $fileName The original file name.
 * @return string The sanitized file name.
 */
function sanitizeFileName($fileName)
{
    // Replace spaces with underscores
    $sanitizedFileName = str_replace(' ', '_', $fileName);

    // Remove any characters other than alphanumeric, underscore, and dot
    $sanitizedFileName = preg_replace('/[^a-zA-Z0-9_\.]/', '', $sanitizedFileName);

    return $sanitizedFileName;
}

