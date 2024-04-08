<?php
/**
 * header.php
 *
 * This file contains the HTML structure for the header section of your website.
 * It includes styles and functionality related to the header, such as the logo,
 * user icon, sidebar, and responsiveness.
 */
?>
<?php
/**
 * header.php
 *
 * This file contains the HTML structure for the header section of your website.
 * It includes styles and functionality related to the header, such as the logo,
 * user icon, sidebar, and responsiveness.
 */

require_once 'constants.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>reset.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>typography.css">

    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>form.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>styles.css">

    <!-- Link to favicon -->
    <link rel="icon" href="<?php echo ICONS_PATH; ?>favicon.svg" type="image/svg+xml">

    <!-- Add additional meta tags, stylesheets, etc., as needed -->
</head>
<body>

<section class="header-section">
    <div class="container">
        <div class="nexus-header-item">
            <a href="#" class="nexus-header-link">
                <h3 class="title-medium-text">
                    nexus
                </h3>
            </a>
        </div>
        <!-- <div class="nexus-header-item nexus-header-item--full">
            <input type="search" class="nexus-form-control nexus-header-input" placeholder="Search media..." />
        </div>
        <div class="nexus-header-item">
            <button class="nexus-btn nexus-btn-search">Search</button>
        </div> -->
        <div class="nexus-header-item nexus-header-item-mr-0">
            <a href="#" class="nexus-header-link">
                <img class="nexus-avatar" src="<?php echo ICONS_PATH; ?>default_user_icon.svg" alt="User Avatar" height="20" width="20" />
                <p class="caption-text">vdetorre</p>
            </a>
        </div>
    </div>
</section>
