<?php
namespace Classes\FileManager;

class FileManager {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Uploads a file and stores metadata in the database
    public function uploadFile($userId, $filename, $destinationDirectory) {
        // Store metadata in the database
        $this->storeFileMetadata($userId, $filename, $destinationDirectory);
    }

    // Store file metadata in the database
    public function storeFileMetadata($userId, $filename, $directoryId) {
        $sql = "INSERT INTO de_torres_vincent_user_files (user_id, directory_id, file_id, media_type, file_classification, file_path) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $mediaType = $this->determineMediaType($filename);
        $fileClassification = $this->determineFileClassification($mediaType);
        $fileId = $this->generateFileId();
        $filePath = $directoryId . '/' . $filename;
        $stmt->execute([$userId, $directoryId, $fileId, $mediaType, $fileClassification, $filePath]);
    }

    // Determine the media type of the file based on its extension
    private function determineMediaType($filename) {
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        switch ($extension) {
            case 'mp3':
            case 'wav':
            case 'ogg':
                return 'audio';
            case 'jpg':
            case 'jpeg':
            case 'png':
                return 'photo';
            case 'mp4':
            case 'avi':
            case 'mov':
                return 'video';
            default:
                return 'others';
        }
    }

    // Determine the file classification based on its media type
    private function determineFileClassification($mediaType) {
        switch ($mediaType) {
            case 'audio':
                return 'audio';
            case 'photo':
                return 'photo';
            case 'video':
                return 'video';
            default:
                return 'others';
        }
    }

    // Generate a unique file ID
    private function generateFileId() {
        return uniqid();
    }

    // Download a file
    public function downloadFile($fileId, $userId, $destinationDirectory) {
        // Retrieve file metadata from the database
        $fileData = $this->getFileMetadata($fileId, $userId);

        // Return the file path
        return $fileData['file_path'];
    }

    // Retrieve file metadata from the database
    public function getFileMetadata($fileId, $userId) {
        $sql = "SELECT * FROM de_torres_vincent_user_files WHERE id = ? AND user_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$fileId, $userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function generateFileObject($userId, $filename, $directoryId) {
        // Determine media type and file classification
        $mediaType = $this->determineMediaType($filename);
        $fileClassification = $this->determineFileClassification($mediaType);

        // Generate a unique file ID
        $fileId = $this->generateFileId();

        // Construct the file object
        $fileObject = [
            'user_id' => $userId,
            'directory_id' => $directoryId,
            'file_id' => $fileId,
            'media_type' => $mediaType,
            'file_classification' => $fileClassification,
            'file_path' => $directoryId . '/' . $filename
        ];

        return $fileObject;
    }

    // Parse a file object into an array
    public function parseFileObjectToArray($fileObject) {
        $fileArray = [
            'user_id' => $fileObject['user_id'],
            'directory_id' => $fileObject['directory_id'],
            'file_id' => $fileObject['file_id'],
            'media_type' => $fileObject['media_type'],
            'file_classification' => $fileObject['file_classification'],
            'file_path' => $fileObject['file_path']
        ];

        return $fileArray;
    }

    public function getFileMetadataByType($user_id, $fileType)
    {

        $query = "SELECT * FROM de_torres_vincent_user_files WHERE user_id = ? AND file_classification = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("is", $user_id, $fileType);
        $stmt->execute();
        $result = $stmt->get_result();

        $metadata = array();
        while ($row = $result->fetch_assoc()) {
            $metadata[] = $row;
        }

        $stmt->close();

        return $metadata;
    }

}
