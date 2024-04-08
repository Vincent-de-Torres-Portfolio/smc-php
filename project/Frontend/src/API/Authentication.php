<?php

namespace API;
include_once __DIR__ . "/../../../Configure/Config.php";
include_once __DIR__ . "/../../../Configure/Database.php";


/**
 * Class API\Authentication
 * Provides functionalities for user authentication, session management, and token handling.
 */
class Authentication
{
    private $db;

    /**
     * API\Authentication constructor.
     * @param $db - The database connection object
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Attempts to authenticate a user with provided credentials.
     * @param string $username - The username of the user
     * @param string $password - The password of the user
     * @return bool - True if authentication succeeds, false otherwise
     */
    public function login($username, $password)
    {
        // Query the database to find the user with the given username
        $query = "SELECT * FROM de_torres_vincent_users WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // If user not found or password does not match, return false
        if (!$user || !password_verify($password, $user['password'])) {
            return false;
        }

        // Generate a new session token
        $token = $this->generateToken();

        // Set the expiration datetime to current datetime plus 24 hours
        $expiration = date('Y-m-d H:i:s', strtotime('+24 hours'));

        // Update the session_token and expiration fields in the users table
        $updateQuery = "UPDATE de_torres_vincent_users SET session_token = ?, expiration = ? WHERE id = ?";
        $updateStmt = $this->db->prepare($updateQuery);
        $updateStmt->execute([$token, $expiration, $user['id']]);

        // Set session variables with user data
        $this->setSessionVariables($user);

        return true;
    }

    /**
     * Validates the provided session token.
     * @param string $token - The session token to validate
     * @return bool - True if the token is valid, false otherwise
     */
    public function validateToken($token)
    {
        // Query the database to find the user with the given session token
        $query = "SELECT * FROM de_torres_vincent_users WHERE session_token = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$token]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // If user not found or token is expired, return false
        if (!$user || strtotime($user['expiration']) < time()) {
            return false;
        }

        return true;
    }

    /**
     * Logs out the current user by destroying the session token and unsetting session variables.
     */
    public function logout()
    {
        // Implementation
    }

    /**
     * Checks if a user is currently logged in.
     * @return bool - True if user is logged in, false otherwise
     */
    public function isLoggedIn()
    {
        // Implementation
    }

    /**
     * Generates a random session token.
     * @return string - The generated session token
     */
    public function generateToken()
    {
        // Implementation
    }


    /**
     * Sets session variables with user data upon successful login.
     * @param $userData - An array containing user data
     */
    public function setSessionVariables($userData)
    {
        // Implementation
    }
}

