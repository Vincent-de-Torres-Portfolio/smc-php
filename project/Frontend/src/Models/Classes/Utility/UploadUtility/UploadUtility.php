<?php

namespace Classes\Utility\UploadUtility;

class UploadUtility {
    private $authToken;
    private $userId;
    private $username;
    private $homedir;
    private $default_upload_dir;

    public function __construct($authToken, $userId, $username) {
        $this->authToken = $authToken;
        $this->userId = $userId;
        $this->username = $username;
        $this->homedir = $this->getUserHomeDirectory();
        $this->default_upload_dir = $this->homedir . '/Uploads';
        logMessage("UploadUtility instance created. Homedir: {$this->homedir}, Default Upload Directory: {$this->default_upload_dir}");
    }

    public function writeToFilesystem($file, $destinationPath = null) {
        // If destinationPath is not specified, use the default upload directory
        if ($destinationPath === null) {
            $destinationPath = $this->default_upload_dir;
        }

        logMessage("Writing file {$file['name']} to filesystem at destination: $destinationPath");

        // Ensure the destination directory exists
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
            logMessage("Destination directory created: $destinationPath");
        }

        // Generate a unique filename or use the original filename
        $uniqueFilename = $this->generateUniqueFilename($destinationPath, $file['name']);

        // Move the uploaded file to the destination directory
        move_uploaded_file($file['tmp_name'], $destinationPath . '/' . $uniqueFilename);

        logMessage("File {$file['name']} written to filesystem at: $destinationPath/$uniqueFilename");

        return $destinationPath . '/' . $uniqueFilename;
    }

    public function insertToFileMetaData($db, $filePath, $fileType, $fileClassification) {
        // Perform the database insertion using PDO or your preferred database library
        // This is a simplified example, and you should use prepared statements to prevent SQL injection
        $stmt = $db->prepare("INSERT INTO de_torres_vincent_user_files (user_id, file_path, media_type, file_classification) VALUES (?, ?, ?, ?)");
        $stmt->execute([$this->userId, $filePath, $fileType, $fileClassification]);
        logMessage("File metadata inserted into database for user ID: {$this->userId}");
    }

    private function getUserHomeDirectory() {
        // Create a user-specific home directory path
        $userHomeDir = "DATA/" . str_pad($this->userId, 6, '0', STR_PAD_LEFT) . "_" . $this->username;

        return $userHomeDir;
    }

    private function generateUniqueFilename($destinationPath, $originalFilename) {
        // Implement logic to generate a unique filename, for example, appending a timestamp
        $timestamp = time();
        $extension = pathinfo($originalFilename, PATHINFO_EXTENSION);

        return "file_" . $timestamp . "." . $extension;
    }
}
