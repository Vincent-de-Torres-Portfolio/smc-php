<?php
require_once 'helper/Sanitize.php';
require_once 'ui/NavItem.php';

/**
 * This file generates a side navigation bar with icons.
 * It uses the NAV_ITEMS constant from the CONSTANTS.PHP file, which is an associative array where the key is the label of the navigation section
 * and the value is another associative array with menu items and their corresponding icon paths.
 */

$navItems = NAV_ITEMS;

/**
 * Generates a side navigation bar with icons.
 *
 * @param array $navItems An associative array where the key is the label of the navigation section
 *                        and the value is another associative array with menu items and their corresponding icon paths.
 * @return string The HTML string of the side navigation bar.
 * @throws InvalidArgumentException If a menu item or icon path is not a string.
 * @throws RuntimeException If an icon file does not exist.
 */

function generateSideNav($navItems)
{
    $navHtml = '<nav class="side-nav">';
    foreach ($navItems as $label => $menuItems) {
        $navHtml .= '<ul class="side-menu">';
        foreach ($menuItems as $menuItem => $iconPath) {
            // Create a new NavItem object
            $navItem = new NavItem($menuItem, $iconPath, $label);

            // Add the HTML of the NavItem object to the navigation HTML
            $navHtml .= $navItem->render();
        }
        $navHtml .= '</ul>';
    }
    $navHtml .= '</nav>';

    return $navHtml;
}

// Render the html to pass in to generate side nav 
// [ 'Recent' => ['Recent', 'icons/nav/recent.svg', '#Recent'], 'Images' => ['Images', 'icons/nav/photo.svg', '#Images'], 'Videos' => ['Videos', 'icons/nav/video.svg', '#Videos'], 'Browse' => ['Browse', 'icons/nav/browse.svg', '#Browse'], ], 'Secondary' => [ 'Pinned' => ['Pinned', 'icons/nav/pin.svg', '#Pinned'], 'A-Z' => ['A-Z', 'icons/nav/sort-name.svg', '#AZ'], 'Date' => ['Date', 'icons/nav/sort-date.svg', '#Date'], 'Categories' => ['Categories', 'icons/nav/sort-cat.svg', '#Categories'], ], 'Utilities' => [ 'Upload' => ['Upload', 'icons/nav/up.svg', '#Upload'], 'Download' => ['Download', 'icons/nav/download.svg', '#Download'], ], 'User' => [ 'Logout' => ['Logout', 'icons/nav/logout.svg', '#Logout'], ], ]); define('LOG_FILE', 'logs/app.log'); define('HEADER_PATH', 'includes/components/header.php'); define('FOOTER_PATH', 'includes/components/footer.php'); define('SIDENAV_PATH', 'includes/components/sidenav.php');
// We need to destructure NAV_ITEMS itterate over each group destructure and echo the sidebar

