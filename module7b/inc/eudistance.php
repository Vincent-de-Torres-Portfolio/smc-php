<?php
/**
 * Distance Calculation Script
 *
 * This PHP script calculates the distance between selected European cities
 * in kilometers and converts it to miles. It provides a form for users to input
 * start and end cities, processes the data, and redirects to a results page.
 *
 **/

// Start the session
session_start();

// Function to sanitize and validate input
function sanitizeAndValidateInput($input) {
    $cleanedInput = trim($input);
    $cleanedInput = strip_tags($cleanedInput);
    $cleanedInput = htmlspecialchars($cleanedInput, ENT_QUOTES, 'UTF-8');
    return $cleanedInput;
}

/**
 * Associative array of European cities and distances in kilometers.
 * Each city is associated with distances to other cities.
 *
 * @var array $Distance
 */

$Distance = array(
    "Berlin" => array(
        "Berlin" => 0,
        "Moscow" => 1607.99,
        "Paris" => 876.96,
        "Prague" => 280.34,
        "Rome" => 1181.67
    ),
    "Moscow" => array(
        "Berlin" => 1607.99,
        "Moscow" => 0,
        "Paris" => 2484.92,
        "Prague" => 1664.04,
        "Rome" => 2374.26
    ),
    "Paris" => array(
        "Berlin" => 876.96,
        "Moscow" => 641.31,
        "Paris" => 0,
        "Prague" => 885.38,
        "Rome" => 1105.76
    ),
    "Prague" => array(
        "Berlin" => 280.34,
        "Moscow" => 1664.04,
        "Paris" => 885.38,
        "Prague" => 0,
        "Rome" => 922
    ),
    "Rome" => array(
        "Berlin" => 1181.67,
        "Moscow" => 2374.26,
        "Paris" => 1105.76,
        "Prague" => 922,
        "Rome" => 0
    )
);

$kmToMiles = 0.62;

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get selected start and end cities from the form
    $startCity = sanitizeAndValidateInput($_POST['startCity']);
    $endCity = sanitizeAndValidateInput($_POST['endCity']);

    // Check if the selected cities exist in the Distance array
    if (isset($Distance[$startCity]) && isset($Distance[$endCity])) {
        // Calculate the distance between the selected cities in kilometers
        $distanceInKm = $Distance[$startCity][$endCity];

        // Convert the distance to miles
        $distanceInMiles = $distanceInKm * $kmToMiles;

        // Store values in session variables
        $_SESSION['startCity'] = $startCity;
        $_SESSION['endCity'] = $endCity;
        $_SESSION['distanceInKm'] = $distanceInKm;
        $_SESSION['distanceInMiles'] = $distanceInMiles;

        // Redirect to result.php
        header("Location: results.php");
        exit();
    } else {
        // Display an error message if the selected cities are not found in the array
        echo "<p class='error-text'>Invalid cities selected. Please choose valid cities.</p>";

    }
}else{
    header("Location: ../index.php");
}
