<?php

/**
 * Filename: CitiesOptions.php
 * This script generates HTML options for a dropdown menu containing European cities.
 * The cities are retrieved from a two-dimensional associative array storing mileage between European capitals.
 */

// Include the file containing the associative array with mileage data
require_once('eudistance.php');

// Output the default option for the dropdown menu
echo "<option value=\"\" disabled selected>Select City</option>";

// Loop through the array keys (cities) and generate HTML options for each city
foreach (array_keys($Distance) as $city) {
    echo "<option value=\"$city\">$city</option>";
}


