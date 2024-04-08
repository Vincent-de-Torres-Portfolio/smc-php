<?php

namespace Classes\Utility\FileMetadataUtility;
include_once "../../../config/config.php";
include_once "../../../config/database.php";
$db=getDbConnection();
class FileMetadataUtility
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function addFileMetadata($userId, $directoryId, $fileId, $mediaType, $fileClassification, $filePath)
    {
        $stmt = $this->db->prepare("INSERT INTO vdetorre_project.de_torres_vincent_user_files (user_id, directory_id, file_id, media_type, file_classification, file_path) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$userId, $directoryId, $fileId, $mediaType, $fileClassification, $filePath]);
    }

    public function updateFileMetadata($fileId, $mediaType, $fileClassification, $filePath)
    {
        $stmt = $this->db->prepare("UPDATE vdetorre_project.de_torres_vincent_user_files SET media_type = ?, file_classification = ?, file_path = ?, last_modified = CURRENT_TIMESTAMP() WHERE file_id = ?");
        $stmt->execute([$mediaType, $fileClassification, $filePath, $fileId]);
    }

    public function deleteFileMetadata($fileId)
    {
        $stmt = $this->db->prepare("DELETE FROM vdetorre_project.de_torres_vincent_user_files WHERE file_id = ?");
        $stmt->execute([$fileId]);
    }

    public function getFilesOrDirsByPath($userId, $filePath, $mediaType)
    {
        $stmt = $this->db->prepare("SELECT * FROM vdetorre_project.de_torres_vincent_user_files WHERE user_id = ? AND file_path = ? AND media_type = ?");
        $stmt->execute([$userId, $filePath, $mediaType]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertInitialDirectories($userId, $username, $userRootDir)
    {
        $subdirectories = ['Home', 'Music', 'Photos', 'Recents', 'Trash', 'Uploads', 'Videos'];

        foreach ($subdirectories as $subdirectory) {
            $directoryId = md5($userId . '_' . $username . '_' . $subdirectory); // You might want to use a unique identifier for each directory
            $mediaType = 'dir'; // Directories are considered as 'dir'
            $fileClassification = 'others'; // You can adjust this based on your classification logic
            $filePath = $userRootDir . '/' . $subdirectory;

            $this->addFileMetadata($userId, $directoryId, $directoryId, $mediaType, $fileClassification, $filePath);
        }
    }

    public function closeConnection()
    {
        $this->db = null;
    }
}