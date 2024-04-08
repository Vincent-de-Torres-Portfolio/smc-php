<?php
// register_process.php
namespace Classes;

class Sanitizer
{
    public static function sanitizeInput($input)
    {
        return htmlspecialchars(trim($input));
    }
} // Removed the semicolon here

require_once "database.php";

$conn = getDbConnection();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = Sanitizer::sanitizeInput($_POST['username']);
    $password = password_hash(Sanitizer::sanitizeInput($_POST['password']), PASSWORD_BCRYPT);
    $firstname = Sanitizer::sanitizeInput($_POST['firstname']);
    $lastname = Sanitizer::sanitizeInput($_POST['lastname']);
    $email = Sanitizer::sanitizeInput($_POST['email']);
    $access_code = Sanitizer::sanitizeInput($_POST['access_code']); // Adjust as needed

    // Add other fields as needed

    $sql = "INSERT INTO vdetorre_project.de_torres_vincent_users (username, password, firstname, lastname, email, access_code) 
            VALUES ('$username', '$password', '$firstname', '$lastname', '$email', '$access_code')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location:index.php?new_user");
        //SetToken Variables Needed
    } else {
        echo "Registration failed: " . mysqli_error($conn);
    }
} else {

    if (isset($conn)) {
        mysqli_close($conn);
    }

    header("Location:../index.php?error=access_invalid");
    exit();
}
