<?php
include_once "config.php";

function getDbConnection() {
    // Database credentials
    $host = DB_HOST;
    $dbname = DB_NAME;
    $username = DB_USERNAME;
    $password = DB_PASSWORD;

    // Attempt to connect to the database
    try {
        $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        // Set the PDO error mode to exception
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        // Handle connection errors
        die("Connection failed: " . $e->getMessage());
    }
}

// Usage example:
$db = getDbConnection();
// Now you can use $db to execute queries or perform database operations
