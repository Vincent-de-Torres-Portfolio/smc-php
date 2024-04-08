# DirectoryManager Class

The DirectoryManager class provides methods for managing user directories in a database. It allows adding, modifying, and renaming directories, as well as adding files to directories.

## Methods

### addDirectory($userId, $parentDirectoryId, $directoryName)

Adds a new directory for the specified user. If the user does not have a home directory, the directory will be added as the home directory. The `$parentDirectoryId` parameter should be `null` or `1` to represent the root directory.

### modifyDirectory($directoryId, $newName)

Modifies the name of the directory with the specified ID.

### renameDirectory($userId, $directoryName, $newName)

Renames the directory with the specified name for the given user.

### addFileToDirectory($userId, $directoryId, $fileName)

Adds a file to the specified directory for the given user.

### initializeDefaultLibraries($userId)

Initializes default libraries (e.g., Music, Photos) for the user. If the user does not have a home directory, it creates one and initializes other libraries inside it.

## Private Methods

### checkHomeDirectoryExists($userId)

Checks if the user already has a home directory.

### getUsernameById($userId)

Fetches the username by user ID.

### getUserRootDirectoryId($userId)

Fetches the root directory ID of the user.

## Usage Example

```php
// Create a database connection
$db = new Database();

// Instantiate the DirectoryManager class
$directoryManager = new DirectoryManager($db);

// Initialize default libraries for a user
$directoryManager->initializeDefaultLibraries($userId);

// Add a new directory
$directoryManager->addDirectory($userId, $parentDirectoryId, $directoryName);

// Modify a directory
$directoryManager->modifyDirectory($directoryId, $newName);

// Rename a directory
$directoryManager->renameDirectory($userId, $directoryName, $newName);

// Add a file to a directory
$directoryManager->addFileToDirectory($userId, $directoryId, $fileName);
```


| Method                        | Description                                                                                                                                                   |
|-------------------------------|---------------------------------------------------------------------------------------------------------------------------------------------------------------|
| addDirectory($userId, $parentDirectoryId, $directoryName) | Adds a new directory for the specified user. If the user does not have a home directory, the directory will be added as the home directory. The `$parentDirectoryId` parameter should be `null` or `1` to represent the root directory. |
| modifyDirectory($directoryId, $newName)                    | Modifies the name of the directory with the specified ID.                                                                                                     |
| renameDirectory($userId, $directoryName, $newName)          | Renames the directory with the specified name for the given user.                                                                                              |
| addFileToDirectory($userId, $directoryId, $fileName)        | Adds a file to the specified directory for the given user.                                                                                                    |
| initializeDefaultLibraries($userId)                         | Initializes default libraries (e.g., Music, Photos) for the user. If the user does not have a home directory, it creates one and initializes other libraries inside it.                    |

| Private Method                | Description                                                                                                                   |
|-------------------------------|-------------------------------------------------------------------------------------------------------------------------------|
| checkHomeDirectoryExists($userId) | Checks if the user already has a home directory.                                                                             |
| getUsernameById($userId)        | Fetches the username by user ID.                                                                                            |
| getUserRootDirectoryId($userId) | Fetches the root directory ID of the user.                                                                                  |
