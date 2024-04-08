<?php
/**
 * This script demonstrates the usage of the Sanitize class to sanitize various types of input data.
 *
 * Sample input data includes a string with HTML tags, an email address with potential HTML tags,
 * a valid URL, an invalid URL with HTML tags, and a script tag.
 *
 * The Sanitize class provides methods to sanitize strings, email addresses, and URLs:
 * - sanitizeString: Removes HTML tags and encodes special characters from a string.
 * - sanitizeEmail: Validates and sanitizes an email address.
 * - sanitizeURL: Validates and sanitizes a URL.
 * - sanitize: Sanitizes input data based on its type, calling the appropriate method based on the type.
 *
 * Usage:
 * - The original and sanitized versions of each type of input data are displayed.
 * - Invalid email addresses and URLs are handled gracefully, returning an empty string.
 * - Script tags in the string input are removed, demonstrating the sanitization of potential security threats.
 */

require_once 'Sanitize.php';

// Sample input data
$inputString = htmlspecialchars("<p>Hello, <b>world</b>!</p>");
$inputEmail = htmlspecialchars("us<h1>er@ex/ample.com");
$inputURLInvalid = htmlspecialchars("https://www.ex<h1>ample.com");
$inputURL = htmlspecialchars("https://www.ex/ample.com");
$inputScript = htmlspecialchars("<script>alert('Hello');</script>");

// Sanitize string
$sanitizedString = Sanitize::sanitize($inputString, 'string');
echo "Original String: $inputString<br>";
echo "Sanitized String: $sanitizedString<br><br>";

// Sanitize email
$sanitizedEmail = Sanitize::sanitize($inputEmail, 'email');
echo "Original Email: $inputEmail<br>";
echo "Sanitized Email: " . ($sanitizedEmail !== '' ? $sanitizedEmail : 'Invalid Email') . "<br><br>";

// Sanitize URL
$sanitizedURL = Sanitize::sanitize($inputURL, 'url');
echo "Original URL: $inputURL<br>";
echo "Sanitized URL: " . ($sanitizedURL !== '' ? $sanitizedURL : 'Invalid URL') . "<br><br>";

// Sanitize invalid URL
$sanitizedInvalidURL = Sanitize::sanitize($inputURLInvalid, 'url');
echo "Original Invalid URL: $inputURLInvalid<br>";
echo "Sanitized Invalid URL: " . ($sanitizedInvalidURL !== '' ? $sanitizedInvalidURL : 'Invalid URL') . "<br><br>";

// Sanitize script
$sanitizedScript = Sanitize::sanitize($inputScript, 'string');
echo "Original Script: $inputScript<br>";
echo "Sanitized Script: " . ($sanitizedScript !== '' ? $sanitizedScript : 'Empty String (Script removed)') . "<br><br>";
?>
