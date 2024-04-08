<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="./assets/favicon.svg" type="image/svg+xml">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/typography.css">
    <link rel="stylesheet" type="text/css" href="css/toast.css">
    <link rel="stylesheet" type="text/css" href="css/styles.css">

    <title>EU Cities Distance Calculator</title>
</head>

<body>

<?php include "./inc/inc_header.php";?>

<div class="section-container">
    <div class="container">

        <!-- Page Title -->
        <h1 class="title-large-text">Distance Calculator</h1>
        <hr class="xs">

        <!-- Instructions -->
        <p class="caption-text">Use this distance calculator to find the distance between two European capitals. Follow these steps:</p>

        <ol>
            <li><p class="caption-text">&nbsp;&bull;&nbsp;Select the starting city from the dropdown list.</p></li>
            <li><p class="caption-text">&nbsp;&bull;&nbsp;Select the destination city from the dropdown list.</p></li>
            <li><p class="caption-text">&nbsp;&bull;&nbsp;Click on the 'Calculate Distance' button.</p></li>
            <li><p class="caption-text">&nbsp;&bull;&nbsp;The calculator will display the distance between the selected cities.</p></li>
        </ol>

        <!-- Distance Calculator Form -->
        <form method="post" action="inc/eudistance.php">
            <label for="startCity">Start City:</label>
            <select id="startCity" name="startCity" required>
                <?php include 'inc/CitiesOptions.php'; ?>
            </select>

            <label for="endCity">End City:</label>
            <select id="endCity" name="endCity" required>
                <?php include 'inc/CitiesOptions.php'; ?>
            </select>

            <button type="submit" class="btn btn-primary">Calculate Distance</button>
        </form>
    </div>
</div>

<?php include './inc/inc_footer.php';?>

</body>

</html>

