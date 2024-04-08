<?php
// Filename: signguestbook.php

/*
 * Check if the "first_name" or "last_name" fields in the $_POST superglobal are empty.
 * If either of them is empty, output an error message.
 * Otherwise, proceed with inserting a record into the Guest Book database.
 */
if (empty($_POST['first_name']) || empty($_POST['last_name'])) {
    echo "<p>You must enter your first and last name! Click your browser's Back button to return to the Guest Book form.</p>";
} else {
    $user = "vdetorre";
    $password = "";
    $host = "localhost";

    // Establish a connection to the database server.
    $DBConnect = mysqli_connect($host, $user, $password);

    /*
     * If mysqli_connect returns FALSE, output an error message using mysqli_errno and mysqli_error.
     */

    if ($DBConnect === FALSE) {
        echo "<p>Unable to connect to the database server.</p>" . "<p>Error code " . mysqli_connect_errno() . ": " . mysqli_connect_error() . "</p>";
    } else {
        $DBName = "vdetorre_module10a"; // Database name

        // Select the database to work with.
        mysqli_select_db($DBConnect, $DBName);

        /*
         * If mysqli_select_db returns FALSE, attempt to create the database using mysqli_query.
         */

        if (!mysqli_select_db($DBConnect, $DBName)) {
            $SQLstring = "CREATE DATABASE $DBName";
            $QueryResult = mysqli_query($DBConnect, $SQLstring);

            /*
             * If mysqli_query returns FALSE for the CREATE DATABASE SQL statement, output an error message using
             * mysqli_errno and mysqli_error. Otherwise, output a success message.
             */

            if ($QueryResult === FALSE) {
                echo "<p>Unable to execute the query.</p>" . "<p>Error code " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>";
            } else {
                echo "<p>You are the first visitor!</p>";
            }
        }

        // Check if the "visitors" table exists.
        $TableName = "visitors";
        $SQLstring = "SHOW TABLES LIKE '$TableName'";
        $QueryResult = mysqli_query($DBConnect, $SQLstring);

        /*
         * If the number of rows in the mysqli_result object is zero for the SHOW TABLES SQL statement, create the
         * table $TableName using mysqli_query.
         */
        if (mysqli_num_rows($QueryResult) == 0) {
            $SQLstring = "CREATE TABLE $TableName (countID SMALLINT NOT NULL AUTO_INCREMENT PRIMARY KEY, last_name VARCHAR(40), first_name VARCHAR(40))";
            $QueryResult = mysqli_query($DBConnect, $SQLstring);

            /*
             * If mysqli_query returns FALSE for the CREATE TABLE SQL statement, output an error message using
             * mysqli_errno and mysqli_error.
             */
            if ($QueryResult === FALSE) {
                echo "<p>Unable to create the table.</p>" . "<p>Error code " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>";
            }
        }

        // Prepare the data to be inserted into the database.
        $LastName = stripslashes($_POST['last_name']);
        $FirstName = stripslashes($_POST['first_name']);

        // Insert the record into the "visitors" table.
        $SQLstring = "INSERT INTO $TableName VALUES (NULL, '$LastName', '$FirstName')";
        $QueryResult = mysqli_query($DBConnect, $SQLstring);

        /*
         * If mysqli_query returns FALSE for the INSERT SQL statement, output an error message using mysqli_errno
         * and mysqli_error. Otherwise, output a success message.
         */

        if ($QueryResult === FALSE) {
            echo "<p>Unable to execute the query.</p>" . "<p>Error code " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>";
        } else {
            echo "<h1>Thank you for signing our guest book!</h1>";
        }

        // Close the database connection.
        mysqli_close($DBConnect);
    }
}

