<?php
/**
 * header.php
 *
 * This file contains the HTML structure for the header section of your website.
 * It includes styles and functionality related to the header, such as the logo,
 * user icon, sidebar, and responsiveness.
 *
 * @param string $pageTitle The title of the web page.
 * @param string|null $customCssFilename (Optional) The filename of the custom CSS file.
 * @param string|null $faviconPath (Optional) The path to the favicon image.
 */
require_once '../../CONSTANTS.php';

function generateHeader($pageTitle, $customCssFilename = null, $faviconPath = null) {
$cssBasePath = "../../" . CSS_PATH;
$customCssPath = null;

// Construct the path for the custom CSS file
try {
    if (!empty($customCssFilename) && file_exists($cssBasePath . "custom/" . $customCssFilename)) {
        $customCssPath = $cssBasePath . "custom/" . $customCssFilename;
    }
} catch (Exception $e) {
    // Handle the error, e.g., log or display an error message
    error_log('Error constructing custom CSS path: ' . $e->getMessage());
}

// Use the provided favicon path or get it from CONSTANTS.php
try {
    $faviconPath = $faviconPath ?? ICONS_PATH . "favicon.svg";
} catch (Exception $e) {
    // Handle the error, e.g., log or display an error message
    error_log('Error getting favicon path: ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<!--    <link rel="stylesheet" href="--><?php //echo $cssBasePath; ?><!--reset.css">-->
<!--    <link rel="stylesheet" href="--><?php //echo $cssBasePath; ?><!--typography.css">-->
<!--    <link rel="stylesheet" href="--><?php //echo $cssBasePath; ?><!--form.css">-->
<!--    <link rel="stylesheet" href="--><?php //echo $cssBasePath; ?><!--styles.css">-->
<!--    --add animations.css-->
    <?php
        foreach (CSS_FILES as $cssFile) {
        echo '<link rel="stylesheet" href="' . $cssBasePath . $cssFile . '">' . PHP_EOL;
        }
    ?>
    <?php if ($customCssPath): ?>
        <link rel="stylesheet" href="<?php echo $customCssPath; ?>">
    <?php endif; ?>

    <!-- Link to favicon -->
    <?php if (!empty($faviconPath)): ?>
        <link rel="icon" href="<?php echo $faviconPath; ?>" type="image/svg+xml">
    <?php endif; ?>

    <title><?php echo $pageTitle; ?></title>

    <!-- Add additional meta tags, stylesheets, etc., as needed -->
</head>
<body class="fade-in">
<?php
}

// Example usage:

/**
 * Example 1: Providing custom CSS filename and favicon path.
 */
//$pageTitle = "Your Page Title";
//$customCssFilename = "custom-styles.css";
//$faviconPath = ICONS_PATH . "favicon.svg";
//generateHeader($pageTitle, $customCssFilename, $faviconPath);

/**
 * Example 2: Providing only the favicon path.
 */
//$pageTitle = "Another Page";
//generateHeader($pageTitle, null, ICONS_PATH . "another-favicon.ico");

/**
 * Example 3: Providing only the page title.
 */
//$pageTitle = "Simple Page";
//generateHeader($pageTitle);
///
?>
