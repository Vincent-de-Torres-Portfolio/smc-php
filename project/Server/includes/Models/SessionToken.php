<?php

namespace Models;

/** SessionToken class represents a utility for managing session tokens in a database.
 *
 * Attributes:
 * - $conn: The database connection.
 * - $sessionToken: The generated session token.
 *
 * Methods:
 * - __construct($databaseConnection): Constructor that initializes the database connection and generates a session token.
 * - generateToken($length = 32): Generates a random session token of the specified length.
 * - getSessionToken(): Retrieves the current session token.
 * - addSessionToken($userId): Adds a session token to the database for the specified user ID.
 * - isValidSessionToken($userId): Checks if a session token is valid for the specified user ID.
 * - revokeSessionToken($userId): Revokes a session token for the specified user ID by setting its status to 'expired'.
 * - renewSessionToken($userId): Renews the expiration time of a session token for the specified user ID.
 */


include_once "Database.php";
use Models\Database;


class SessionToken
{
    private $conn;
    private $sessionToken;

    public function __construct($databaseConnection=null) {
        if ($databaseConnection === null) {
            $databaseConfig = new Database();
            $this->conn = $databaseConfig->getDbConnection();
        } else {
            $this->conn = $databaseConnection;
        }
            $this->sessionToken = $this->generateToken();
    }

    public function getSessionToken(){
        return $this->sessionToken;
    }

    private function generateToken($length = 32)
    {
        // Generate a random token of the specified length
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $token = '';
        for ($i = 0; $i < $length; $i++) {
            $token .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $token;
    }


    public function addSessionToken($userId)
    {
        $sessionToken = $this->getSessionToken();

        // Set expiration time to 8 hours from the current time
        $expiration = date('Y-m-d H:i:s', strtotime('+8 hours'));

        $status = 'active';

        // Sanitize user input if needed
        $userId = mysqli_real_escape_string($this->conn, $userId);

        $sql = "INSERT INTO de_torres_vincent_session_tokens (user_id, session_token, expiration, status) 
                VALUES ('$userId', '$sessionToken', '$expiration', '$status')";

        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            echo "Session token added successfully!";
        } else {
            echo "Failed to add session token: " . mysqli_error($this->conn);
        }
    }

    public function isValidSessionToken($userId)
    {
        $sessionToken = $this->getSessionToken();

        $currentDateTime = date('Y-m-d H:i:s');

        // Sanitize user input if needed
        $userId = mysqli_real_escape_string($this->conn, $userId);
        $sessionToken = mysqli_real_escape_string($this->conn, $sessionToken);

        $sql = "SELECT * FROM de_torres_vincent_session_tokens 
                WHERE user_id = '$userId' 
                AND session_token = '$sessionToken' 
                AND expiration > '$currentDateTime' 
                AND status = 'active'";

        $result = mysqli_query($this->conn, $sql);

//        return ($result && mysqli_num_rows($result) > 0);
        return $result->num_rows > 0;

    }

    public function revokeSessionToken($userId)
    {
        $sessionToken = $this->getSessionToken();

        // Sanitize user input if needed
        $userId = mysqli_real_escape_string($this->conn, $userId);
        $sessionToken = mysqli_real_escape_string($this->conn, $sessionToken);

        $sql = "UPDATE de_torres_vincent_session_tokens 
                SET status = 'expired' 
                WHERE user_id = '$userId' 
                AND session_token = '$sessionToken'";

        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            echo "Session token revoked successfully!";
        } else {
            echo "Failed to revoke session token: " . mysqli_error($this->conn);
        }
    }

    public function renewSessionToken($userId)
    {
        $sessionToken = $this->getSessionToken();

        // Set expiration time to 8 hours from the current time
        $expiration = date('Y-m-d H:i:s', strtotime('+8 hours'));

        // Sanitize user input if needed
        $userId = mysqli_real_escape_string($this->conn, $userId);
        $sessionToken = mysqli_real_escape_string($this->conn, $sessionToken);

        $sql = "UPDATE de_torres_vincent_session_tokens 
                SET expiration = '$expiration' 
                WHERE user_id = '$userId' 
                AND session_token = '$sessionToken'";

        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            echo "Session token renewed successfully!";
        } else {
            echo "Failed to renew session token: " . mysqli_error($this->conn);
        }
    }
}

//$db = getDbConnection();
//$token = new SessionToken($db);
//$token->addSessionToken(10);
//$token->isValidSessionToken(10);
//$token->revokeSessionToken(10);

