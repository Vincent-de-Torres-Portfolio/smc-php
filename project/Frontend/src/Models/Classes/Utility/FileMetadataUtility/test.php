<?php
include_once \Classes\Utility\FileMetadataUtility\FileMetadataUtility::

define('ROOT_DIR_PATH', 'test');

// Get the database connection
$db=getDbConnection();
print_r($db);
// Instantiate the FileMetadataUtility class
$fileMetadataUtility = new FileMetadataUtility($db);
try {
    // Test addFileMetadata method
    $fileMetadataUtility->addFileMetadata(1, 'dir123', 'file123', 'image/jpeg', 'photo', 'path/to/file123.jpg');
    echo "addFileMetadata method test passed.\n";

    // Test updateFileMetadata method
    $fileMetadataUtility->updateFileMetadata('file123', 'image/png', 'photo', 'path/to/updated/file123.png');
    echo "updateFileMetadata method test passed.\n";

    // Test deleteFileMetadata method
    $fileMetadataUtility->deleteFileMetadata('file123');
    echo "deleteFileMetadata method test passed.\n";

    // Test getFilesOrDirsByPath method
    $files = $fileMetadataUtility->getFilesOrDirsByPath(1, 'path/to', 'image/jpeg');
    if (!empty($files)) {
        echo "getFilesOrDirsByPath method test passed.\n";
    } else {
        throw new Exception("getFilesOrDirsByPath method test failed.");
    }

    // Test insertInitialDirectories method
    $fileMetadataUtility->insertInitialDirectories(1, 'username', ROOT_DIR_PATH);
    echo "insertInitialDirectories method test passed.\n";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
} finally {
    // Close the database connection
    $fileMetadataUtility->closeConnection();
}