<?php
/**
 * This file defines constants for the application.
 *
 * Each constant represents a section of the navigation menu (e.g., 'Main', 'Secondary', 'Utilities', 'User').
 * The value of each constant is an associative array where the keys are the names of the navigation items and the values are the paths to their corresponding icons.
 */

define( 'NAV_ITEMS' , [
    'Main' => [
        'Recent' => ['Recent', 'icons/nav/recent.svg', '#Recent'],
        'Images' => ['Images', 'icons/nav/photo.svg', '#Images'],
        'Videos' => ['Videos', 'icons/nav/video.svg', '#Videos'],
        'Browse' => ['Browse', 'icons/nav/browse.svg', '#Browse'],
    ],
    'Secondary' => [
        'Pinned' => ['Pinned', 'icons/nav/pin.svg', '#Pinned'],
        'A-Z' => ['A-Z', 'icons/nav/sort-name.svg', '#AZ'],
        'Date' => ['Date', 'icons/nav/sort-date.svg', '#Date'],
        'Categories' => ['Categories', 'icons/nav/sort-cat.svg', '#Categories'],
    ],
    'Utilities' => [
        'Upload' => ['Upload', 'icons/nav/up.svg', '#Upload'],
        'Download' => ['Download', 'icons/nav/download.svg', '#Download'],
    ],
    'User' => [
        'Logout' => ['Logout', 'icons/nav/logout.svg', '#Logout'],
    ],
]);

define('LOG_FILE', 'logs/app.log');

define('HEADER_PATH', 'includes/components/header.php');
define('FOOTER_PATH', 'includes/components/footer.php');
define('SIDENAV_PATH', 'includes/components/sidenav.php');
