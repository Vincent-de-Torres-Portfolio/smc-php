<?php
/**
 * This script starts a new session, defines base paths for CSS and icons, and checks if page_title and custom_css are set in the GET parameters.
 * If they are, it sanitizes them with htmlspecialchars() to prevent XSS attacks and assigns them to variables.
 * If they're not set, it assigns default values.
 * It then starts the HTML document, sets the character set, viewport, and favicon, sets the page title, includes the base CSS files, and if custom_css is set, includes it as well.
 */

// Start a new session
session_start();

// Define base paths for CSS and icons
$cssBasePath = "public/css/";
$iconsBasePath = "public/assets/images/icons/";

// Check if page_title and custom_css are set in the GET parameters
if (isset($_GET["page_title"], $_GET["custom_css"])) {
    $title = htmlspecialchars($_GET["page_title"]);
    $custom_css = htmlspecialchars($_GET["custom_css"]);
} else {
    $title = "NEXUS";
    $custom_css = "";
}

// Define an array of base CSS files
$baseCssFiles = ['reset', 'typography', 'forms', 'buttons', 'toast', 'styles'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Set the character set, viewport, and favicon -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="text/xml" href="<?php echo $iconsBasePath . "favicon.svg"; ?>">

    <!-- Set the page title -->
    <title> <?php echo $title; ?> </title>

    <!-- Include the base CSS files -->
    <?php foreach ($baseCssFiles as $cssFile) : ?>
        <link rel="stylesheet" href="<?php echo $cssBasePath . $cssFile . '.css'; ?>">
    <?php endforeach; ?>

    <!-- If custom_css is set, include it -->
    <?php if (!empty($custom_css)) : ?>
        <link rel="stylesheet" href="<?php echo $cssBasePath . "custom/" . $custom_css; ?>">
    <?php endif; ?>
</head>
<body>