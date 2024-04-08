<?php
namespace Classes\DirectoryManager;
use PDO;
class DirectoryManager {
    private $db;
    private $userId;
    private $userFiles;
    private $filteredFilesJson;
    private $allDirectories; // Instance variable for all directories
    private $allFiles; // Instance variable for all files

    public function __construct($db, $userId) {
        $this->db = $db;
        $this->userId = $userId;
        $this->allDirectories = [];
        $this->allFiles = $this->getAllFiles($userId);
    }

    public function getAllDirectories($userId) {

        // Fetch all directories for the specified user
        $sql = "SELECT * FROM de_torres_vincent_directories WHERE user_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId]);
        $directories = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->allDirectories = array_slice($directories, 0, 100);

        return $directories;
    }
    public function getAllFiles($userId) {
        // Fetch all directories for the specified user
        $sql = "SELECT * FROM de_torres_vincent_user_files WHERE user_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId]);
        $files = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->allFiles = array_slice($files, 0, 100);

        return $files;
    }


    public function fetchAndFilterUserFiles() {
        $sql = "SELECT * FROM vdetorre_project.de_torres_vincent_user_files WHERE user_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$this->userId]);
        $userFiles = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Filter and retrieve the 'file_classification' column for each file
        $filteredFiles = array_map(function ($file) {
            return $file['file_classification'];
        }, $userFiles);

        // Convert the filtered result to JSON
        $this->filteredFilesJson = json_encode($filteredFiles);

        // Store the user files data as an instance variable for potential future use
        $this->userFiles = $userFiles;

        return $filteredFiles;
    }

    // Getter method for user files data
    public function getUserFiles() {
        return $this->userFiles;
    }

    // Getter method for filtered files JSON
    public function getFilteredFilesJson() {
        return $this->filteredFilesJson;
    }




    public static function parseDirectoryData($directoryData) {
        $parsedData = [];

        foreach ($directoryData as $directory) {
            if (empty($directory['parent_directory_id'])) {

                // This is the user's home directory



                $parsedData['UserId'] = $directory['user_id'];
                $parsedData['ParentId'] = $directory['id'];
                $parsedData['Home'] = $directory['directory_name'];
                $parsedData['AbsoluteRootPath'] = "/DATA/{$parsedData['Home']}";
            }
        }

        return $parsedData;
    }


    public function addDirectory($userId, $parentDirectoryId, $directoryName) {
//        $homeDirectoryId = $this->getHomeDirectoryId($userId);
         $stmt = $this->db->prepare("INSERT INTO de_torres_vincent_directories (user_id, parent_directory_id, directory_name, directory_path) VALUES (?, ?, ?, ?)");
            $directoryPath = $this->generateDirectoryPath($userId, $directoryName,$parentDirectoryId);
            $stmt->execute([$userId, $parentDirectoryId, $directoryName, $directoryPath]);

    }

    public function getHomeDirectoryId($userId) {
        $stmt = $this->db->prepare("SELECT id FROM de_torres_vincent_directories WHERE user_id = ? AND parent_directory_id IS NULL");
        $stmt->execute([$userId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['id'] : null;
    }

//    public function getDirectoryContents($userId, $parentDirectoryId) {

    public function modifyDirectory($directoryId, $newName) {
        if ($directoryId !== null && $directoryId !== 1) {
            $stmt = $this->db->prepare("UPDATE de_torres_vincent_directories SET directory_name = ? WHERE id = ?");
            $stmt->execute([$newName, $directoryId]);
        }
    }

    public function renameDirectory($userId, $directoryName, $newName) {
        $stmt = $this->db->prepare("UPDATE de_torres_vincent_directories SET directory_name = ? WHERE user_id = ? AND directory_name = ?");
        $stmt->execute([$newName, $userId, $directoryName]);
    }

    public function addFileToDirectory($userId, $directoryId, $fileName) {
        // Logic to add file to directory
    }

    public function initializeDefaultLibraries($userId) {
        // Query the username of the user
        $username = $this->getUsernameById($userId);

        // Construct the default null/root directory name
        $defaultDirectoryName = str_pad($userId, 6, '0', STR_PAD_LEFT) . '_' . $username;

        // Check if the user already has a home directory
        $homeDirectoryExists = $this->checkHomeDirectoryExists($userId);

        // If the user doesn't have a home directory, create it
        if (!$homeDirectoryExists) {
            $this->addDirectory($userId, null, $defaultDirectoryName);
        }

        // Initialize other libraries
        $libraries = ['Music', 'Photos', 'Recents', 'Trash', 'Uploads', 'Videos',"Home"];
        $rootDirectoryId = $this->getUserRootDirectoryId($userId);

        foreach ($libraries as $library) {
            $this->addDirectory($userId, $rootDirectoryId, $library);
        }
    }


    public function groupByClassification($files) {
        // Initialize an associative array to group files by classification
        $groupedFiles = [
            'others' => [],
            'photo' => [],
            'audio' => [],
            'video' => []
            // Add more classifications as needed
        ];

        // Group files by classification
        foreach ($files as $file) {
            $classification = $file['file_classification'];
            $groupedFiles[$classification][] = $file;
        }

        return $groupedFiles;
    }

    public function parseFilesByType($files, $type) {
        // Get all unique file classifications from the input array
        $uniqueClassifications = array_unique(array_column($files, 'file_classification'));

        // Initialize an associative array to group files by classification
        $groupedFiles = [];

        // Group files by classification
        foreach ($uniqueClassifications as $classification) {
            $groupedFiles[$classification] = array_values(array_filter(
                $files,
                function ($file) use ($classification) {
                    return $file['file_classification'] === $classification;
                }
            ));
        }

        // Return the specific type or all files if type is 'all'
        return ($type === 'all') ? $groupedFiles : $groupedFiles[$type];
    }


    // Variation of filterType to return a minimal array with Name, Last Accessed, and Path
    public function minimalArray() {
        $minimalArray = array_map(function ($file) {
            // Use pathinfo to extract only the filename with extension
            $pathInfo = pathinfo($file['file_path']);
            $filename = $pathInfo['basename'];

            return [
                'Name' => $filename,
                'LastAccessed' => $file['last_accessed'],
                'Path' => $file['file_path']
            ];
        }, $this->allFiles);

        return $minimalArray;
    }

    private function checkHomeDirectoryExists($userId) {
        // Query to check if the user already has a home directory
        $sql = "SELECT COUNT(*) AS count FROM de_torres_vincent_directories WHERE user_id = ? AND parent_directory_id IS NULL";

        // Prepare and execute the query
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId]);

        // Fetch the result
        $result = $stmt->fetch();

        // Return true if the count is greater than 0, indicating the home directory exists
        return ($result && $result['count'] > 0);
    }

    // Getter method for all directories
    public function getAllDirectoriesArray() {
        return $this->allDirectories;
    }

    // Getter method for all files
    public function getAllFilesArray() {
        return $this->allFiles;
    }



    private function getUsernameById($userId) {
        // Query to fetch the username by user ID
        $sql = "SELECT username FROM de_torres_vincent_users WHERE id = ?";

        // Prepare and execute the query
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId]);

        // Fetch the username
        $result = $stmt->fetch();

        // Return the username
        return $result ? $result['username'] : null;
    }

    private function getUserRootDirectoryId($userId) {
        // Query to fetch the root directory ID of the user
        $sql = "SELECT id FROM de_torres_vincent_directories WHERE user_id = ? AND parent_directory_id IS NULL";

        // Prepare and execute the query
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId]);

        // Fetch the root directory ID
        $result = $stmt->fetch();

        // Return the root directory ID
        return $result ? $result['id'] : null;
    }

    private function generateDirectoryPath($userId, $directoryName, $parentDirectoryId = null) {
        if ($parentDirectoryId !== null) {
            $sql = "SELECT directory_path FROM de_torres_vincent_directories WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$parentDirectoryId]);
            $parentDirectoryPath = $stmt->fetchColumn();
            return $parentDirectoryPath . '/' . $directoryName;
        } else {
            return  'DATA/' . $directoryName;
        }
    }


}

