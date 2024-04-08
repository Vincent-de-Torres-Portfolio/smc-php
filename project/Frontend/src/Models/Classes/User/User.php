<?php

namespace Classes\User;
class User {
    private $db;

    // User properties
    public $id;
    public $firstname;
    public $lastname;
    public $username;
    public $email;
    public $password;
    public $contact_number;
    public $address;
    public $access_level;
    public $status;
    public $access_code;
    public $created_at;
    public $updated_at;

    public function __construct($db) {
        $this->db = $db;
    }

    public function register() {

        if ($this->userExists($this->username, $this->email)) {
            throw new Exception("User with this username or email already exists");
        }else{
            $passwordHash = password_hash($this->password, PASSWORD_BCRYPT);

            $sql = "INSERT INTO de_torres_vincent_users (firstname, lastname, username, email, password, contact_number, address, access_level, status, access_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($sql);

            $stmt->execute([$this->firstname, $this->lastname, $this->username, $this->email, $passwordHash, $this->contact_number, $this->address, $this->access_level, $this->status, $this->access_code]);

        }
    }

    private function userExists($username, $email) {
        $sql = "SELECT * FROM de_torres_vincent_users WHERE username = ? OR email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$username, $email]);
        return $stmt->fetch() !== false;
    }

    public function userSetup() {
        // Perform any additional setup tasks for the user
        // For example, create user directories, initialize user settings, etc.
        // This method can be extended based on application requirements

        // Ensure the username is valid for directory creation
        $usernameDir = strtoupper(preg_replace('/[^A-Za-z0-9]/', '_', $this->username));

        // Prepend the root directory with the user ID
        $userDirPath = "DATA/{$this->id}-{$usernameDir}";

        // Create the user directory if it doesn't exist
        if (!file_exists($userDirPath)) {
            mkdir($userDirPath, 0777, true); // Ensure the directory is writable

            // Initialize subdirectories
            $subdirectories = ['Photos', 'Music', 'Videos', 'Uploads', 'Trash', 'Recents', 'Home'];
            foreach ($subdirectories as $dir) {
                mkdir("{$userDirPath}/$dir", 0777, true); // Create subdirectories
                // Add a README.md file in each subdirectory
            }
            file_put_contents("{$userDirPath}/$dir/.config", '');



            // Additional setup tasks can be performed here
        }

        // Return any relevant data or success status
        return ['user_dir' => $userDirPath];
    }




}
