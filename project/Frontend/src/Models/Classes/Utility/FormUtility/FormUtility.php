<?php

namespace Classes\Utility;

class FormUtility {
    public static function sanitizeInput($input) {
        // Remove leading and trailing whitespaces
        $input = trim($input);
        // Strip HTML and PHP tags
        $input = strip_tags($input);
        // Convert special characters to HTML entities
        $input = htmlspecialchars($input);
        return $input;
    }

    public static function validateEmail($email) {
        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }

    public static function validatePassword($password) {
        // Validate password strength (e.g., minimum length, contain uppercase, lowercase, and numbers)
        if (strlen($password) < 8) {
            return false;
        }
        // Add more validation rules as needed
        return true;
    }

    public static function sanitizeAndValidateInput($data, $type = 'string')
    {
        // Sanitize input data
        $sanitizedData = trim($data);
        $sanitizedData = stripslashes($sanitizedData);
        $sanitizedData = htmlspecialchars($sanitizedData);

        // Validate input based on type
        switch ($type) {
            case 'email':
                if (!filter_var($sanitizedData, FILTER_VALIDATE_EMAIL)) {
                    return false;
                }
                break;
            // Add more cases for other input types as needed
        }

        return true; // Return true if input passes validation
    }
}
