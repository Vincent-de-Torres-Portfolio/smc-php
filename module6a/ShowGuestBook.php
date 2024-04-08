<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guestbook</title>
    <link href="css/reset.css" type="text/css" rel="stylesheet">
    <link href="css/typography.css" type="text/css" rel="stylesheet">
    <link href="css/toast.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">

<style>
    a{
        text-decoration: none;
    }

    .container {
        width: 100vw; /* Full viewport width */
        height: 100vh;
        display: grid; /* Use grid display */
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); /* Responsive grid with auto columns */
        gap: 20px; /* Set the gap between elements */
        padding: 20px;
    }
    /* Signature Card Style */
    .signature-card {
        background-color: #f8f8f8;
        padding: 10px;
        /*box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);*/
        border: 1px solid #ccc;
        height: 70px;
        border-radius: 5px;
    }
    </style>
</head>

<body>

<div class="container">


<?php
// Read and display the contents of the guestbook.txt file
$guestBookContent = file("guestbook.txt", FILE_IGNORE_NEW_LINES);
if (!empty($guestBookContent)) {
    foreach ($guestBookContent as $signature) {
        // Split the line into first name, last name, and timestamp
        list($lastName, $firstName, $timestamp) = explode(", ", $signature);
        echo '<div class="signature-card">';
        echo '<h4 class="title-small-text">' . $firstName . ' ' . $lastName . '</h4>';
        echo '<p class="caption-text">'.  $timestamp . '</p>';
        echo '</div>';
    }
} else {
    echo '<p>No signatures in the guest book yet.</p>';
}
?>
</div>

<a href="index.php">
    <div class="submit-button">Sign Guestbook</div>

</a>
<hr>



<hr>
<footer>
    <h4 class="title-small-text">GUESTBOOK</h4>

</footer>
<?php
include ("inc/inc_footer.php")
?>
</body>

</html>
