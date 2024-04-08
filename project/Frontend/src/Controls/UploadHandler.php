<?php
// Start session to access session variables
session_start();

// Check if user's home directory is set in session variable
if(isset($_SESSION['home_directory'])){
    // Define the destination directory where the files will be stored
    $destination = $_SESSION['home_directory'] . '/DATA/';

    // Check if the destination directory exists, if not, create it
    if(!file_exists($destination)){
        mkdir($destination, 0777, true); // Create directory recursively
    }

    // Check if files were uploaded
    if(isset($_FILES['files']['name'][0])){
        // Loop through each file
        foreach($_FILES['files']['name'] as $key => $name){
            $tmp_name = $_FILES['files']['tmp_name'][$key];
            $error = $_FILES['files']['error'][$key];

            // Check for errors
            if($error === UPLOAD_ERR_OK){
                // Move the file to the destination directory
                if(move_uploaded_file($tmp_name, $destination . $name)){
                    // File uploaded successfully
                    echo "File $name uploaded successfully.\n";

//
//                    $filename = $destination . $name;
//                    $filesize = filesize($filename); // Get file size in bytes
//                    $filetype = mime_content_type($filename); // Get file type

                } else {
                    // Error moving file
                    echo "Error uploading file $name.\n";
                }
            } else {
                // Error uploading file
                echo "Error uploading file $name.\n";
            }
        }
    } else {
        // No files uploaded
        echo "No files uploaded.\n";
    }
} else {
    // User's home directory not set in session variable
    echo "User's home directory not set.\n";
}
