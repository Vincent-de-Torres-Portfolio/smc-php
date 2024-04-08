<?php

define('CSS_PATH', 'css/');
define('ICONS_PATH', '../../../frontend/assets/icons/');
define('FORMS_ICONS_PATH', '../../../frontend/assets/icons/forms/');
define('FAVICON','favicon.svg');
define('JS_PATH', 'js/');
define('IMG_PATH', 'assets/images/');

define('COMPONENTS_PATH', 'components/');

// Define paths for specific components
define('BUTTON_COMPONENT', COMPONENTS_PATH . 'Button.php');
define('INPUT_FIELD_COMPONENT', COMPONENTS_PATH . 'InputField.php');





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

define('CSS_FILES', [
    'reset.css',
    'typography.css',
    'toast.css',
    'form.css',
    'styles.css',
    'animations.css',

]);

//DIR PATHS
define("DIR_USER_AUTH_FORM_HANDLER_PATH","pages/UserManagement/UserManagementHandlers/");