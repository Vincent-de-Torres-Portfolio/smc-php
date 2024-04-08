<?php

namespace Classes\Utility;

class GeneralUtility
{

    // Static method to generate a nonce (a unique token)
    public static function generateNonce()
    {
        return bin2hex(random_bytes(16));
    }

    // Static method to generate a random ID
    public static function generateRandomId($length = 8)
    {
        return bin2hex(random_bytes($length / 2));
    }

    public static function hashStringWithSalt($string)
    {
        // Generate a random salt
        $salt = bin2hex(random_bytes(16));

        // Hash the password with salt using bcrypt
        $hashedString = password_hash($string . $salt, PASSWORD_DEFAULT);

        // Return the hashed string and the salt
        return [
            'hashedString' => $hashedString,
            'salt' => $salt
        ];
    }

}
