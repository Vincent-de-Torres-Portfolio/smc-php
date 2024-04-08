<?php
session_start();

    include_once "Configure/Config.php";
    include_once "Includes/database.php";
    include_once "src/API/Authentication.php";

    include_once "src/Views/UI/IconInput/IconInput.php";
    include_once "src/API/Authentication.php";

$db = getDbConnection();


    $_SESSION['DB_OBJECT']=$db;

    include_once "public/templates/header.php";

    /*
     * Redirect users directly to Lib if token is set and validated
     */

    if (isset($_SESSION['TOKEN']) && $AuthObject->validateToken($_SESSION['TOKEN'])) {
        // If the token is valid, redirect to the libraries page
        header('Location: public/templates/pages/libraries.php');
        exit;
    }

$action = isset($_GET['action']) ? $_GET['action'] : 'login';

    switch ($action) {
        case 'login':
            include_once 'public/templates/pages/login.php';
            unset($_GET);
            break;
        case 'logout':
            require 'public/templates/pages/logout.php';
            unset($_GET);
            break;
        case 'oobe':
            require 'public/templates/pages/oobe.php';
            unset($_GET);
            break;
        case 'register':
            require 'public/templates/pages/register.php';
            unset($_GET);
            break;
        case 'reset':
            require 'public/templates/pages/reset.php';
            unset($_GET);
            break;
        case 'upload':
            require 'public/templates/pages/upload.php';
            unset($_GET);
            break;

        default:
            echo 'Page not found';
            break;
    }
