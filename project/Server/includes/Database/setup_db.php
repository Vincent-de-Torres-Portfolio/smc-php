<?php

$hostname = "localhost";
$username = "username";
$password = "password";
$database = "vdetorre_project";

// Function to establish a database connection
function getDbConnection($hostname, $username, $password, $database)
{
    $connection = @mysqli_connect($hostname, $username, $password, $database);

    if (!$connection) {
        throw new Exception("Failed to connect to database: " . mysqli_connect_error());
    }

    return $connection;
}

// Function to run SQL scripts
function runSqlScripts($hostname, $username, $password, $database)
{
    // Check if the .dbstatus file exists
    if (!file_exists('.dbstatus')) {
        // Run SQL scripts
        $sqlFiles = [
            'de_torres_vincent_session_tokens.sql',
            'de_torres_vincent_user_directories.sql',
            'de_torres_vincent_user_files.sql',
            'de_torres_vincent_users.sql'
        ];

        foreach ($sqlFiles as $file) {
            // Read the SQL script content
            $sql = file_get_contents($file);

            // Execute the SQL script
            $connection = getDbConnection($hostname, $username, $password, $database);
            if ($connection) {
                if (!mysqli_multi_query($connection, $sql)) {
                    throw new Exception("Error executing SQL query: " . mysqli_error($connection));
                }
                mysqli_close($connection);
            }
        }

        // Create .dbstatus file
        file_put_contents('.dbstatus', '');
    }
}

try {
    // Run SQL scripts
    runSqlScripts($hostname, $username, $password, $database);
    echo "Database setup completed successfully!";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

