<?php
/**
 * The Sanitize class provides methods to sanitize strings, email addresses, and URLs.
 *
 * It includes the following methods:
 * - sanitizeString: This method removes HTML tags and encodes special characters from a string.
 * - sanitizeEmail: This method validates and sanitizes an email address.
 * - sanitizeURL: This method validates and sanitizes a URL.
 * - sanitize: This method sanitizes input data based on its type. It calls the appropriate method based on the type of the input data.
 *
 * Example usage:
 * $sanitizedString = Sanitize::sanitize($inputString, 'string');
 * $sanitizedEmail = Sanitize::sanitize($inputEmail, 'email');
 * $sanitizedURL = Sanitize::sanitize($inputURL, 'url');
 */
class Sanitize
{
    /**
     * Sanitizes a string.
     *
     * @param string $input The input string.
     * @return string The sanitized string.
     */
    private static function sanitizeString($input)
    {
        // Remove HTML tags
        $sanitizedData = strip_tags($input);

        // Encode special characters
        $sanitizedData = htmlspecialchars($sanitizedData, ENT_QUOTES, 'UTF-8');

        // Add slashes to special characters
        $sanitizedData = addslashes($sanitizedData);

        return $sanitizedData;
    }

    /**
     * Sanitizes an email address.
     *
     * @param string $email The input email address.
     * @return string|false The sanitized email address, or false if the input is not a valid email address.
     */
    private static function sanitizeEmail($email)
    {
        // Validate and sanitize email
        $sanitizedEmail = filter_var($email, FILTER_SANITIZE_EMAIL);

        if (filter_var($sanitizedEmail, FILTER_VALIDATE_EMAIL)) {
            return $sanitizedEmail;
        } else {
            return false;
        }
    }

    /**
     * Sanitizes a URL.
     *
     * @param string $url The input URL.
     * @return string|false The sanitized URL, or false if the input is not a valid URL.
     */
    private static function sanitizeURL($url)
    {
        // Validate and sanitize URL
        $sanitizedURL = filter_var($url, FILTER_SANITIZE_URL);

        if (filter_var($sanitizedURL, FILTER_VALIDATE_URL)) {
            return $sanitizedURL;
        } else {
            return false;
        }
    }

    /**
     * Sanitizes input data.
     *
     * @param string $input The input data.
     * @param string $type The type of the input data. It can be 'string', 'email', or 'url'.
     * @return string|false The sanitized data, or false if the input is not valid.
     */
    public static function sanitize($input, $type)
    {
        $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');

        switch ($type) {
            case 'string':
                return self::sanitizeString($input);
            case 'email':
                return self::sanitizeEmail($input);
            case 'url':
                return self::sanitizeURL($input);
            default:
                return false;
        }
    }
}
