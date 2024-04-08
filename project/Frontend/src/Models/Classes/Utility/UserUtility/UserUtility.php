<?php

namespace Classes\Utility;

use Classes\Database\Database;

class UserUtility {
    // Static method for user registration
    public static function registerUser($fullName, $email, $username, $password) {
        // Instantiate Database class
        $db = new Database();

        // Call insertUser method
        return $db->insertUser($fullName, $email, $username, $password, $salt);
    }

    // Static method for deactivating a user account
//    public static function deactivateUser($userId) {
//        // Set the password to "INACTIVE"
//        $inactivePassword = 'INACTIVE';
//
//        // Instantiate Database class
//        $db = new Database();
//
//        // Update user's password to "INACTIVE"
//        return $db->updatePassword($userId, $inactivePassword);
//    }
}
