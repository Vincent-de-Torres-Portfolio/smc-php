<?php

/**
 * Application Entry Point
 *
 * PHP version 8.1
 *
 * This PHP script serves as the entry point of the application developed as part of the CS85 PHP course during the Intersession 2024.
 * The script is designed to facilitate the initiation of sessions, inclusion of essential files like the autoloader and templates,
 *  and proper routing of requests to their respective pages.
 *
  * The CS85 PHP course, undertaken during the Intersession 2024, focuses on equipping students with Introductory skills in PHP programming.
 * @package  Nexus
 *
 * @author   VINCENT DE TORRES <DE_TORRES_VINCENT_01@students.smc.edu>
 * @link    github.com/devinci-it
 */


session_start();

    require_once "vendor/autoloader.php";
    include_once "template/header.php";
    use Models\Database;
    use Models\User;
    use Models\Sanitizer;
    use Models\SessionToken;
    use Models\FileManager;

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
include_once "template/nav.php";

?>

<main class="page_content">
    <div class="container">

<?php

    $page = $_GET['page'] ?? '';

    switch ($page) {

        case 'login':
            include_once "pages/login.php";
            break;

        case 'register' || 'signup':
            include_once "pages/register.php";
            break;

        case 'logout':
            include_once "pages/logout.php";
            break;

        case 'upload':
            header( "Location:upload.php");
            break;

        default:
            include_once "pages/404.php";
            break;
}

?>

    </div>
</main>

<?php include_once "template/footer.php";
