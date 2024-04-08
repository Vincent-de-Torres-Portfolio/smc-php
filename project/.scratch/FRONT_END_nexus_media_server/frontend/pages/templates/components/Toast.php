<?php
if (!defined('ICONS_PATH')) {
    $iconMissing = true;
} else {
    $errorSVG = ICONS_PATH . 'fill-error.svg';
    $alertSVG = ICONS_PATH . 'fill-alert.svg';
    $infoSVG = ICONS_PATH . 'fill-info.svg';
    $successSVG = ICONS_PATH . 'fill-success.svg';
}

/**
 * Display alerts as an unordered list with styling.
 *
 * @param string $message The alert message to be displayed.
 * @param string $svgPath The path to the SVG icon.
 * @return string HTML markup for displaying alerts.
 */
function displayAlert($message, $svgPath)
{
    /**
     * Generates HTML markup for displaying alert messages.
     *
     * @param string $message The alert message to be displayed.
     * @param string $svgPath The path to the SVG icon.
     * @return string HTML markup for displaying alerts.
     */
    $toReturn = "<div class='toast-wrapper'>";
    $toReturn .= "<div class='toast alert'>$message";
    $toReturn .= "<img class='svg-icon' src='" . htmlspecialchars($svgPath, ENT_QUOTES, 'UTF-8') . "' alt='SVG Icon'></div></div>";
    return $toReturn;
}

/**
 * Display error message.
 *
 * @param string $message The error message to be displayed.
 * @param string $svgPath The path to the SVG icon for errors.
 * @return string HTML markup for displaying error message.
 */
function displayError($message, $svgPath)
{
    /**
     * Generates HTML markup for displaying error messages.
     *
     * @param string $message The error message to be displayed.
     * @param string $svgPath The path to the SVG icon for errors.
     * @return string HTML markup for displaying error messages.
     */
    $toReturn = "<div class='toast-wrapper'>";
    $toReturn .= "<div class='toast error'>$message";
    $toReturn .= "<img class='svg-icon' src='" . htmlspecialchars($svgPath, ENT_QUOTES, 'UTF-8') . "' alt='SVG Icon'></div></div>";
    return $toReturn;
}

/**
 * Display info message.
 *
 * @param string $message The info message to be displayed.
 * @return string HTML markup for displaying info message.
 */
function displayInfo($message,$svgPath)
{
    /**
     * Generates HTML markup for displaying info messages.
     *
     * @param string $message The info message to be displayed.
     * @return string HTML markup for displaying info messages.
     */
    $toReturn = "<div class='toast-wrapper'>";
    $toReturn .= "<div class='toast info'>$message";
    $toReturn .= "<img class='svg-icon' src='" . htmlspecialchars($svgPath, ENT_QUOTES, 'UTF-8') . "' alt='SVG Icon'></div></div>";
    return $toReturn;
}

/**
 * Display success message.
 *
 * @param string $message The success message to be displayed.
 * @return string HTML markup for displaying success message.
 */
function displaySuccess($message,$svgPath)
{
    /**
     * Generates HTML markup for displaying success messages.
     *
     * @param string $message The success message to be displayed.
     * @return string HTML markup for displaying success messages.
     */
    $toReturn = "<div class='toast-wrapper'>";
    $toReturn .= "<div class='toast success'>$message";
    $toReturn .= "<img class='svg-icon' src='" . htmlspecialchars($svgPath, ENT_QUOTES, 'UTF-8') . "' alt='SVG Icon'></div></div>";
    return $toReturn;}

/**
 * Display a toast message with the specified type.
 *
 * @param string $type The type of the alert (error, alert, info, success).
 * @param string $message The message to be displayed in the alert.
 */
function showMessage($type, $message)
{
    /**
     * Displays a toast message with the specified type.
     *
     * @param string $type The type of the alert (error, alert, info, success).
     * @param string $message The message to be displayed in the alert.
     */
    switch ($type) {
        case 'error':
            echo displayError($message, $GLOBALS['errorSVG']);
            break;
        case 'alert':
            echo displayAlert($message, $GLOBALS['alertSVG']);
            break;
        case 'info':
            echo displayInfo($message,$GLOBALS['infoSVG']);
            break;
        case 'success':
            echo displaySuccess($message,$GLOBALS['successSVG']);
            break;
        default:
            // Default to alert for unknown types
            echo displayAlert($message, $GLOBALS['alertSVG']);
            break;
    }
}

// Example usage:
// showMessage('error', 'This is an error message.');
// showMessage('alert', 'This is an alert message.');
// showMessage('info', 'This is an info message.');
// showMessage('success', 'This is a success message.');

