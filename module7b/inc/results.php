<?php
// Start the session
session_start();

// Check if values are set in session and have valid formats
if (
    isset($_SESSION['startCity']) &&
    isset($_SESSION['endCity']) &&
    isset($_SESSION['distanceInKm']) &&
    isset($_SESSION['distanceInMiles']) &&
    is_numeric($_SESSION['distanceInKm']) &&
    is_numeric($_SESSION['distanceInMiles'])
) {
    // Format the variables to two decimal places
    $_SESSION['distanceInKm'] = number_format($_SESSION['distanceInKm'], 2);
    $_SESSION['distanceInMiles'] = number_format($_SESSION['distanceInMiles'], 2);
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <link rel="icon" href="../assets/favicon.svg" type="image/svg+xml">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../css/reset.css">
        <link rel="stylesheet" type="text/css" href="../css/typography.css">
        <link rel="stylesheet" type="text/css" href="../css/toast.css">
        <link rel="stylesheet" type="text/css" href="../css/styles.css">

        <title>EU Distance Calculator</title>
    </head>

    <body>
    <?php
    // Include the header
    include "inc_header.php";
    ?>


    <!-- Card grid section -->
    <div class="card-grid">

        <!-- Start Card -->
        <div class="card city">

        <div >
            <h2 class="caption-text">Start</h2>
            <p class="title-large-text"><?php echo $_SESSION['startCity']; ?></p>
        </div>

        <!-- End Card -->
        <div >
            <h2 class="caption-text">End</h2>
            <p class="title-large-text"><?php echo $_SESSION['endCity']; ?></p>
        </div>
        </div>
        <div class="card">

            <p class='caption-text'>The distance from <?php echo $_SESSION['startCity']; ?> to <?php echo $_SESSION['endCity']; ?> is: <?php echo $_SESSION['distanceInKm']; ?> km (or approximately <?php echo $_SESSION['distanceInMiles']; ?> miles).</p>
        </div>
        <!-- Distance in km Card -->
        <div class="card">
            <h2 class="caption-text">Distance in km</h2>
            <p class="title-large-text"><?php echo $_SESSION['distanceInKm']; ?> km</p>
        </div>

        <!-- Distance in mi Card -->
        <div class="card">
            <h2 class="caption-text"> Distance in mi</h2>
            <p class="title-large-text"><?php echo $_SESSION['distanceInMiles']; ?> miles</p>
        </div>

    </div>

    <?php
    // Clear session variables
    session_unset();
    session_destroy();

    // Include the footer
    include 'inc_footer.php';
    ?>
    </body>

    </html>

    <?php
} else {
    // Redirect to index.php if values are not set or have invalid formats
    header("Location: ../index.php");
    exit();
}
?>
