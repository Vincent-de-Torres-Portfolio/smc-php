<?php

/**
 * User class represents a user in the application with various attributes and methods for user-related operations.
 *
 * Attributes:
 * - $db: Database connection object.
 * - $first_name: User's first name.
 * - $libraryDirectories: User's library directories.
 * - $last_name: User's last name.
 * - $user_name: User's username.
 * - $user_id: User's unique identifier.
 * - $email_address: User's email address.
 * - $display_photo: User's display photo.
 * - $password: Hashed user password.
 * - $reset_code: Hashed reset code.
 * - $home_directory: User's home directory.
 * - $abs_path: Absolute path in the server.
 * - $is_authenticated: Flag indicating whether the user is authenticated.
 * - $auth_token: Authentication token.
 * - $is_registered: Flag indicating whether the user is registered.
 * - $registration_date: Date of user registration.
 * - $last_active: Timestamp of the user's last activity.
 * - $userFiles: User's files metadata.
 * - $last_password_reset: Timestamp of the last password reset.
 * - $account_status: User account status (Active, Suspended, Inactive).
 *
 * Methods:
 * - __construct($db = null): Constructor that initializes the database connection.
 * - isLoggedIn(): Checks if the user is logged in.
 * - register($first_name, $last_name, $user_name, $email_address, $password): Registers a new user.
 * - isDuplicateAccount(): Checks for duplicate user accounts.
 * - insertUser(): Inserts a new user into the database.
 * - runOnboardingScript(): Executes the onboarding script after successful registration.
 * - createHomeDirectory(): Creates the user's home directory.
 * - createLibraryDirectories(): Creates default library directories for the user.
 * - addDefaultLibraryDirectories(): Adds default library directories to the database.
 * - copyDefaultDisplayPhoto(): Copies the default display photo to the user's root directory.
 * - login($username, $password): Logs in the user with the provided credentials.
 * - populateUserProperties($user): Populates user properties after successful login.
 * - generateSessionToken(): Generates a session token for the user.
 * - updateLastActive(): Updates the last active timestamp in the database.
 * - retrieveLibraryDirectories(): Retrieves user library directories from the database.
 * - getLibraryDirectories(): Gets the associative array of user's library directories.
 * - changeProfilePicture($newImagePath): Changes the user's profile picture.
 * - getId(): Gets the user's ID.
 * - getAllFiles(): Retrieves all files associated with the user.
 * - getFilesByFilter($filterType): Retrieves files based on a preset filter type.
 * - filterFilesByMediaType($mediaType): Filters files by media type.
 * - filterFilesByRecent(): Filters files by recent modifications.
 * - uploadFile($directory_id, $fileId, $mediaType, $fileClassification, $file): Uploads a file to the user's directory.
 * - insertFileMetadata($directory_id, $fileId, $mediaType, $fileClassification, $filePath): Inserts file metadata into the database.
 * - deleteFile($fileId): Deletes a file, moving it to the Trash directory.
 * - updateFileMetadata($fileId, $filePath, $fileClassification): Updates file metadata in the database.
 */

namespace Models;

use Models\Database;
use Models\SessionToken;
use Models\FileManager;
use Models\Sanitizer;
include_once "constants.php";
include_once "Database.php";
include_once "FileManager.php";
include_once ASSET_PATH."/../vendor/autoloader.php";


class User
{
    private $db;
    private $first_name;
    private $libraryDirectories = [];
    private $last_name;
    private $user_name;
    protected $user_id;
    private $email_address;
    private $display_photo;

    private $password;
    private $reset_code;

    private $home_directory;
    private $abs_path;

    private $is_authenticated;
    private $auth_token;
    private $is_registered;
    private $sessionToken;

    private $registration_date;
    private $last_active;
    private $userFiles;
    private $last_password_reset;
    private $account_status; //Active, Suspended, Inactive
    private $defaultPhotoPath;

    // constructor
    public function __construct( $db = null)
    {
        if ($db === null) {
            $databaseConfig = new Database();
            $this->db = $databaseConfig->getDbConnection();
        } else {
            $this->db = $db;
        }
        $this->defaultPhotoPath = ASSET_PATH . "user_icon.svg";
        $this->sessionToken = new SessionToken($db);
        $this->setHomeDirectory();




    }

    private function setHomeDirectory()
    {
        // Check if user_name is not null before setting home_directory
        if ($this->user_name !== null) {
            $this->home_directory = sprintf("%05d_%s", $this->user_id, strtoupper($this->user_name));
        } else {
            // Handle the case when $this->user_name is null
            // You might want to provide a default value or log a message.
        }
    }


    public function isLoggedIn(){
        return true;
//        return $this->sessionToken->isValidSessionToken($this->user_id);
    }
    public function logout()
    {
        $this->sessionToken->revokeSessionToken($this->user_id);

    }


    public function register($first_name, $last_name, $user_name, $email_address, $password)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->user_name = $user_name;
        $this->email_address = $email_address;
        $this->password = password_hash($password, PASSWORD_DEFAULT);

        if ($this->isDuplicateAccount()) {
            return false;
        }
        $this->insertUser();
        $this->login($user_name, $password);
        $this->runOnboardingScript();

        return true;
    }

    // Private method to check for duplicate account
    private function isDuplicateAccount()
    {
        $query = "SELECT id FROM vdetorre_project.de_torres_vincent_users WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $this->user_name);
        $stmt->execute();
        $stmt->store_result();

        return $stmt->num_rows > 0;
    }

    private function insertUser()
    {
        $query = "INSERT INTO vdetorre_project.de_torres_vincent_users (firstname, lastname, username, email, password) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sssss", $this->first_name, $this->last_name, $this->user_name, $this->email_address, $this->password);
        $stmt->execute();
    }

    private function runOnboardingScript()
    {
        $this->createHomeDirectory(__DIR__);
        $this->createLibraryDirectories();
        $this->copyDefaultDisplayPhoto();
        $this->addDefaultLibraryDirectories();
    }

    private function createHomeDirectory($base)
    {
        // Directory nomenclature: {user_id[left-padded(0)]}_{user_name[strtoupper]}
        $this->home_directory = sprintf("%05d_%s", $this->user_id, strtoupper($this->user_name));
        $media_path = $base."/../MEDIA/";
        mkdir($media_path . $this->home_directory);
    }

    private function createLibraryDirectories()
    {
        $library_directories = ["Photos", "Videos", "Audios", "Recents", "Trash", "Favorites"];
        $currentDir = dirname(__FILE__);
        // Construct the absolute path to the home directory
        $home_path = $currentDir . "/../MEDIA/" . $this->home_directory . "/";
        foreach ($library_directories as $directory) {
            mkdir($home_path . $directory);
        }
    }

    private function addDefaultLibraryDirectories()
    {
        // Assuming $this->user_id is set

        $library_directories = ["Photos", "Videos", "Audios", "Recents", "Trash", "Favorites","Uploads"];

        foreach ($library_directories as $directory) {
            // Generate a unique directory ID
            $directory_id = md5(uniqid($directory, true));

            // Specify the path to the directory (inside the home directory)
            $directory_path = "../MEDIA/" . $this->home_directory . "/" . $directory;

            // Insert the directory information into the user_directories table
            $query = "INSERT INTO vdetorre_project.de_torres_vincent_user_directories (user_id, directory_id, directory_name, date_added, last_modified, directory_path) 
                      VALUES (?, ?, ?, CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP(), ?)";
            $stmt = $this->db->prepare($query);

            $stmt->bind_param("isss", $this->user_id, $directory_id, $directory, $directory_path);
            $stmt->execute();
        }
    }

    private function copyDefaultDisplayPhoto()
    {
        $default_photo_path = ASSET_PATH."user_icon.svg";
        $user_root_path = STORE_MASTER ."/". $this->home_directory . "/";
        copy($default_photo_path, $user_root_path . "user_icon.svg");
    }

//    public function login($username, $password)
//    {
//        $query = "SELECT * FROM vdetorre_project.de_torres_vincent_users.sql WHERE username = ?";
//        $stmt = $this->db->prepare($query);
//        $stmt->bind_param("s", $username);
//        $stmt->execute();
//        $result = $stmt->get_result();
//
//        if ($result->num_rows === 1) {
//            $user = $result->fetch_assoc();
//
//            // Verify password
//            if (password_verify($password, $user['password'])) {
//                $this->populateUserProperties($user);
////                $this->generateSessionToken();
//                $this->updateLastActive();
//                $this->home_directory = $this->getHomeDirectory();
//                return true;
//            }
//        }
//
//        return false;
//    }
    public function login($username, $password)
    {
        $query = "SELECT * FROM vdetorre_project.de_torres_vincent_users WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            // Verify password
            if (password_verify($password, $user['password'])) {
                $this->populateUserProperties($user);
                $this->updateLastActive();
                $this->home_directory = $this->getHomeDirectory();
                return true;
            }
        }

        return false;
    }

    private function populateUserProperties($user)
    {
        $this->user_id = $user['id'];
        $this->first_name = $user['firstname'];
        $this->last_name = $user['lastname'];
        $this->user_name = $user['username'];
        $this->email_address = $user['email'];
        $this->is_authenticated = true;
        $this->libraryDirectories = $this->getLibraryDirectories();

    }

    private function generateSessionToken()
    {
        $sessionToken = new SessionToken($this->db);
        return $sessionToken->getSessionToken();
    }

    private function updateLastActive()
    {
        // Update the last active timestamp in the database
        $query = "UPDATE vdetorre_project.de_torres_vincent_users SET updated_at = CURRENT_TIMESTAMP() WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $this->user_id);
        $stmt->execute();
    }

    private function retrieveLibraryDirectories()
    {
        if (!$this->isLoggedIn()) {
            // User not logged in, handle accordingly
            return false;
        }

        $query = "SELECT directory_id, directory_name FROM vdetorre_project.de_torres_vincent_user_directories WHERE user_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $this->user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            // Store directory_id and directory_name as key-value pairs in the associative array
            $this->libraryDirectories[$row['directory_id']] = $row['directory_name'];
        }

        return true;
    }

    // Get the associative array of user's library directories
    public function getLibraryDirectories()
    {
        return $this->libraryDirectories;
    }


    public function changeProfilePicture($newImagePath)
    {
        // Assuming the user has logged in and $this->user_id is set

        // Specify the path where the new profile picture will be saved
        $user_root_path = "../MEDIA/" . $this->home_directory . "/";
        $newImageName = "new_profile_picture.jpg";

        // Save the new profile picture to the user's root directory
        if (copy($newImagePath, $user_root_path . $newImageName)) {
            // Update the display_photo property in the database
            $this->display_photo = $newImageName;
            // You might want to update the database here to store the new image name
            // Example query: "UPDATE vdetorre_project.de_torres_vincent_users SET display_photo = ? WHERE id = ?"
        }
    }

    public function getId()
    {
        return $this->user_id;
    }

    public function getAllFiles()
    {
        if (!$this->isLoggedIn()) {
            // User not logged in, handle accordingly
            return [];
        }

        // Retrieve all files associated with the user
        $query = "SELECT * FROM vdetorre_project.de_torres_vincent_user_files WHERE user_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $this->user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $this->userFiles = $result->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function getFilesByFilter($filterType)
    {
        if (!$this->isLoggedIn()) {
            // User not logged in, handle accordingly
            return [];
        }

        // Define filter types (you can customize these based on your application's needs)
        $validFilterTypes = ["Photos", "Audios", "Videos", "Recent"];

        // Validate the provided filter type
        if (!in_array($filterType, $validFilterTypes)) {
            // Invalid filter type, handle accordingly
            return [];
        }

        // Retrieve files based on the specified filter type
        switch ($filterType) {
            case "Photos":
                return $this->filterFilesByMediaType("photo");
            case "Audios":
                return $this->filterFilesByMediaType("audio");
            case "Videos":
                return $this->filterFilesByMediaType("video");
            case "Recent":
                return $this->filterFilesByRecent();
            default:
                return [];
        }
    }

    private function filterFilesByMediaType($mediaType)
    {
        return array_filter($this->userFiles, function ($file) use ($mediaType) {
            return $file['file_classification'] === $mediaType;
        });
    }

    private function filterFilesByRecent()
    {
        // Sort files by last modified timestamp in descending order
        usort($this->userFiles, function ($file1, $file2) {
            return strtotime($file2['last_modified']) - strtotime($file1['last_modified']);
        });

        return $this->userFiles;
    }


//    public function uploadFile($directory_id, $fileId, $mediaType, $fileClassification, $file)
//    {
//        if (!$this->isLoggedIn()) {
//            // User not logged in, handle accordingly
//            return false;
//        }
//
//        // Move the uploaded file to the user's directory
//        $userRootPath = "../MEDIA/" . $this->home_directory . "/";
//        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
//        $filePath = $userRootPath . $directory_id . "/" . $fileId . "." . $fileExtension;
//
//        if (move_uploaded_file($file['tmp_name'], $filePath)) {
//            // Insert file metadata into the user_files table
//            $this->insertFileMetadata($directory_id, $fileId, $mediaType, $fileClassification, $filePath);
//            return true;
//        }
//
//        return false;
//    }
//
//    private function insertFileMetadata($directory_id, $fileId, $mediaType, $fileClassification, $filePath)
//    {
//        $query = "INSERT INTO vdetorre_project.de_torres_vincent_user_files
//                  (user_id, directory_id, file_id, media_type, file_classification, date_added, last_modified, file_path)
//                  VALUES (?, ?, ?, ?, ?, CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP(), ?)";
//        $stmt = $this->db->prepare($query);
//        $stmt->bind_param("isssss", $this->user_id, $directory_id, $fileId, $mediaType, $fileClassification, $filePath);
//        $stmt->execute();
//    }
//
//    public function deleteFile($fileId)
//    {
//        if (!$this->isLoggedIn()) {
//            // User not logged in, handle accordingly
//            return false;
//        }
//
//        // Fetch file metadata to get the file path
//        $query = "SELECT file_path FROM vdetorre_project.de_torres_vincent_user_files WHERE user_id = ? AND file_id = ?";
//        $stmt = $this->db->prepare($query);
//        $stmt->bind_param("is", $this->user_id, $fileId);
//        $stmt->execute();
//        $result = $stmt->get_result();
//
//        if ($result->num_rows === 1) {
//            $file = $result->fetch_assoc();
//            $filePath = $file['file_path'];
//
//            // Move the file to the Trash directory (considering a 15-day graveyard period)
//            $trashDirectoryPath = "../MEDIA/" . $this->home_directory . "/Trash/";
//            $trashFilePath = $trashDirectoryPath . basename($filePath);
//
//            if (rename($filePath, $trashFilePath)) {
//                // Update the file metadata with the new file path and classification as 'deleted'
//                $this->updateFileMetadata($fileId, $trashFilePath, 'deleted');
//                return true;
//            }
//        }
//
//        return false;
//    }
//
//    private function updateFileMetadata($fileId, $filePath, $fileClassification)
//    {
//        $query = "UPDATE vdetorre_project.de_torres_vincent_user_files
//                  SET file_classification = ?, last_modified = CURRENT_TIMESTAMP(), file_path = ?
//                  WHERE user_id = ? AND file_id = ?";
//        $stmt = $this->db->prepare($query);
//        $stmt->bind_param("ssis", $fileClassification, $filePath, $this->user_id, $fileId);
//        $stmt->execute();
//    }

    public function setAuthToken($id,$token){
        $instanceId = $this->user_id;

        if ($id==$instanceId){
            $this->auth_token = $token;

        }else{
            return false;
        }

        return true;
    }

    public  function getAuthToken($id){
        $instanceId = $this->user_id;
        if ($id==$instanceId){
            return $instanceId;
        }else{
            return false;
        }
    }

    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    public function getFirstName()
    {
        return $this->first_name;
    }


    // Setter and getter for $libraryDirectories
    public function setLibraryDirectories($libraryDirectories)
    {
        $this->libraryDirectories = $libraryDirectories;
    }


    // Setter and getter for $last_name
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    public function getLastName()
    {
        return $this->last_name;
    }

    // Setter and getter for $user_name
    public function setUserName($user_name)
    {
        $this->user_name = $user_name;
    }

    public function getUserName()
    {
        return $this->user_name;
    }

    // Setter and getter for $user_id
    protected function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    // Setter and getter for $email_address
    public function setEmailAddress($email_address)
    {
        $this->email_address = $email_address;
    }

    public function getEmailAddress()
    {
        return $this->email_address;
    }

    // Setter and getter for $display_photo
    public function setDisplayPhoto($display_photo)
    {
        $this->display_photo = $display_photo;
    }

    public function getDisplayPhoto()
    {
        return $this->display_photo;
    }

//    public function getHomeDirectorybyId($id){
//        if (($this->user_id == $id) && ($this->isLoggedIn())){
//            return $this->home_directory;
//        }
//    }

    public function getHomeDirectory()
    {
        if (!$this->home_directory) {

        }

        return $this->home_directory;
    }



}








