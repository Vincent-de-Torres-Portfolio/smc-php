<?php
/**
 * This file is responsible for displaying the registration form for the bowling tournament.
 * It retrieves any form data stored in the session and populates the fields if available.
 * When the form is submitted, it sends the data to the formHandler.php file for processing.
 */

session_start();

// Check if session data exists
if (isset($_SESSION['formData'])) {
    $formData = $_SESSION['formData'];
    unset($_SESSION['formData']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bowling Tournament Registration</title>
    <link rel="icon" type="image/svg+xml" href="assets/favicon.svg">
    <link href="assets/css/styles.css" rel="stylesheet">
</head>
<?php include ('inc/inc_header.php'); ?>
<body>
    <main class="card">
        <form method="POST" action="formHandler.php">
            <img class="logo" src="assets/logo.svg"/>
            <h1>Bowling Tournament Registration</h1>
            <hr/>

            <label for="team_name">Team Name:</label>
            <input type="text" name="teamName" required>

            <!-- Other existing fields... -->

            <label for="playerName">Player Name:</label>
            <input type="text" name="playerName" required>

            <fieldset>
                <label for="ageGroup">Age Group:</label>
                <select name="ageGroup" required>
                    <option value="under_18">Under 18</option>
                    <option value="18_25">18 - 25</option>
                    <option value="26_35">26 - 35</option>
                    <option value="36_45">36 - 45</option>
                    <option value="46_plus">46 and above</option>
                </select>

                <label for="averageScore">Average Score:</label>
                <input type="number" name="averageScore" required>
            </fieldset>

            <label for="playerEmail">Email:</label>
            <input type="email" name="playerEmail" required>

            <hr/>

            <button type="submit" name='Submit' value="Register" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16">
                    <path d="M2.5 1.75v11.5c0 .138.112.25.25.25h3.17a.75.75 0 0 1 0 1.5H2.75A1.75 1.75 0 0 1 1 13.25V1.75C1 .784 1.784 0 2.75 0h8.5C12.216 0 13 .784 13 1.75v7.736a.75.75 0 0 1-1.5 0V1.75a.25.25 0 0 0-.25-.25h-8.5a.25.25 0 0 0-.25.25Zm13.274 9.537v-.001l-4.557 4.45a.75.75 0 0 1-1.055-.008l-1.943-1.95a.75.75 0 0 1 1.062-1.058l1.419 1.425 4.026-3.932a.75.75 0 1 1 1.048 1.074ZM4.75 4h4.5a.75.75 0 0 1 0 1.5h-4.5a.75.75 0 0 1 0-1.5ZM4 7.75A.75.75 0 0 1 4.75 7h2a.75.75 0 0 1 0 1.5h-2A.75.75 0 0 1 4 7.75Z"></path>
                </svg>
                &nbsp;Register
            </button>

        </form>
    </main>

    <?php include ('inc/inc_footer.php'); ?>
</body>
</html>
