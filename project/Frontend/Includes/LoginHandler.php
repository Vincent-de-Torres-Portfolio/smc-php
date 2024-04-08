<?php

require 'database.php';
include_once 'function.php';
$db=getDbConnection();

if ($_SERVER["REQUEST_METHOD"]="POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        header("Location: ../index.php?error=emptyfields");
        exit();
    } else {

        $sql = "SELECT * FROM de_torres_vincent_users WHERE username=? OR email=?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$username, $username]);
        if ($row = $stmt->fetch()) {

            $passwordCheck = password_verify($password, $row['password']);
            if ($passwordCheck == false) {
                $_SESSION["login_error"]=true;
                header("Location: ../index.php?error=wrongpassword");
                exit();
            } else if ($passwordCheck == true) {
                session_start();
                $sessionInfo = generateSessionToken();
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['session_token'] = $sessionInfo['token'];
                if (isset($_SESSION['user_id']) && isset($_SESSION['username']) && isset($_SESSION['session_token'])) {
                    addSessionToken($db, $_SESSION['user_id'], $_SESSION['session_token'], $sessionInfo['expiration']);
                } else {
                    // Handle the case where not all session variables are set
                    echo "Error: Unable to set all session variables.";
                }
                if (isset($_SESSION["login_error"])){
                    unset($_SESSION["login_error"]);
                }

//                header("Location: ../index.php?login=success&action=home");
//                header("Location: ../index.php?action=home");
                exit();
            } else {
                header("Location: ../index.php?error=wrongpassword");
                $_SESSION["login_error"]=true;
                exit();
            }
        } else {
            header("Location: ../index.php?error=nouser");
            $_SESSION["login_error"]=true;
            exit();
        }
    }
}
