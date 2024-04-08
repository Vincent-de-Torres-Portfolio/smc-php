<?php
namespace Classes\Utility;

use Classes\DirectoryManager\DirectoryManager;

class DirectoryUtility {
    private $directoryManager;
    private $rootId;


    public function __construct(DirectoryManager $directoryManager) {
        $this->directoryManager = $directoryManager;
        $this->rootId=null;
    }
    public function parseDirectories($userId,$db) {
        $directoryManager = new DirectoryManager($db);

        // Get the ID of the home directory (root)
        $rootDirectoryId = $directoryManager->getHomeDirectoryId($userId);
        $this->rootId =$rootDirectoryId;
        // Get all directories owned by the user
        $allDirectories = $directoryManager->getAllDirectories($userId);

        $rootDirectories = [];
        $libraries = [];

        // Parse directories
        foreach ($allDirectories as $directory) {
            if ($directory['parent_directory_id'] === null) {
                // Root directory
                $rootDirectories[] = [
                    'id' => $directory['id'],
                    'name' => $directory['directory_name'],
                    'path' => $directory['directory_path']
                ];
            } elseif ($directory['parent_directory_id'] === $rootDirectoryId) {
                // Libraries
                $libraries[] = [
                    'id' => $directory['id'],
                    'name' => $directory['directory_name'],
                    'path' => $directory['directory_path']
                ];
            }
        }

        return [
            'rootDirectories' => $rootDirectories,
            'libraries' => $libraries
        ];
    }

    public function getDirectoryAndFileList($userId,$type=null, $parent_dir = '') {
        // Retrieve directory data using DirectoryManager
        $directories = $this->directoryManager->getDirectoryContents($userId, $parent_dir);

        // Prepare array for frontend use
        $data = [
            'directories' => $directories,
//            'files' => $files
        ];

        return $data;
    }

    public function getBreadcrumb($directoryId)
    {
        $breadcrumb = [];

        // Start with the current directory
        $currentDir = $this->directoryManager->getDirectoryById($directoryId);

        // Loop until we reach the root directory (parent_directory_id is null)
        while ($currentDir['parent_directory_id'] !== null) {
            // Add the current directory to the breadcrumb
            $breadcrumb[] = $currentDir;

            // Get the parent directory for the next iteration
            $currentDir = $this->directoryManager->getDirectoryById($currentDir['parent_directory_id']);
        }

        // Add the root directory to the breadcrumb
        $breadcrumb[] = $currentDir;

        // Reverse the breadcrumb array to start from root and end with the current directory
        $breadcrumb = array_reverse($breadcrumb);

        return $breadcrumb;
    }
}


