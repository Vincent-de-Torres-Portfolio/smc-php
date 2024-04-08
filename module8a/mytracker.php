<?php

/**
 * Function to increment the view count using cookies.
 *
 * This function checks if a view count cookie exists and is numeric.
 * If not, or if it reaches 20, it resets the view count to 1.
 * Otherwise, it increments the view count and updates the cookie.
 *
 * @return int The updated view count.
 */
function incrementViewCount() {
    try {
        // Check if the viewCount cookie exists, is set to a numeric value, or has reached 20
        if (!isset($_COOKIE["viewCount"]) || !(is_numeric($_COOKIE["viewCount"])) || $_COOKIE["viewCount"] == 20) {
            // Reset the view count to 1
            setcookie("viewCount", 1, time() + 60 * 60 * 24 * 365);
            return 1;
        } else {
            // Increment the view count and update the cookie
            setcookie("viewCount", ++$_COOKIE["viewCount"]);
            return $_COOKIE["viewCount"];
        }
    } catch (Exception $e) {
        // Log or handle the exception as needed
        // If an exception occurs, set the value to 1
        setcookie("viewCount", 1, time() + 60 * 60 * 24 * 365);
        return 1;
    }
}

// Call the function to get the updated view count
$viewCount = incrementViewCount();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cookies</title>
    <link rel="icon" type="image/svg+xml" href="assets/favicon.svg">
    <link href="css/reset.css" rel="stylesheet" type="text/css">
    <link href="css/typography.css" rel="stylesheet" type="text/css">
    <link href="css/styles.css" rel="stylesheet">
    <link href="css/toast.css" rel="stylesheet">
</head>

<body>

<?php
// Include the header file
include("inc/inc_header.php");
?>

<main>

    <div class="grid-container">
        <div>
            <div class="title-large-text">
                <?php echo $viewCount; ?>
            </div>
            <p class="caption-text">COOKIE TRACKER</p>
        </div>

        <?php
        // Display cookie images based on the view count
        for ($i = 0; $i < $viewCount; $i++) {
            echo "<img class='cookie-img' src='assets/cookie.svg' alt='Cookie'>";
        }
        ?>

    </div>

    <?php
    // Display toast messages based on the view count
    if ($viewCount === 5) {
        echo "<div class='toast info'>Congratulations! 
              <p class='caption-text'>You've nibbled on this page 5 times. Time for a cookie party!</p></div>";
    } elseif ($viewCount === 10) {
        echo "<div class='toast info'>Double-digits achieved! 
              <p class='caption-text'>You've devoured this page 10 times. Cookies for the win!</p></div>";

    } elseif ($viewCount === 15) {
        echo "<div class='toast info'>15 views! You're like a cookie connoisseur. 
              <p class='caption-text'>Wowza! Keep munching!</p></div>";

    } elseif ($viewCount === 20) {
        // Reset the view count and display a message for 20 views
        setcookie("viewCount", "", time() - 3600);
        echo "<div class='toast info'>Sugar Overload Alert! You've viewed this page 20 times. 
              <p class='caption-text'>Time to dispose of those cookie crumbs and start fresh!</p></div>";
    }
    ?>

</main>

<?php
// Include the footer file
include("inc/inc_footer.php");
?>

</body>

</html>
