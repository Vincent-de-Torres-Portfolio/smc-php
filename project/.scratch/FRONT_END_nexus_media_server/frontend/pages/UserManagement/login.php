<?php
require_once "../templates/header.php";

// Start a session
session_start();

// Check if the 'token' session variable is set
if (isset($_SESSION['token'])) {
    try {
        unset($_SESSION['invalidCredential']);
    } catch (Exception $e) {
        // Handle the exception if needed
    }
    header('Location: ../home.php'); // Redirect to home.php if 'token' is set
    exit();
}

// Include necessary files
require_once "../templates/components/index.php";

/**
 * login.php
 *
 * This file serves as the login page for the NX application.
 * It includes the necessary components and generates the login form.
 */
if (!defined('DIR_USER_AUTH_FORM_HANDLER_PATH')) {
    require_once '../../CONSTANTS.php';
    $baseHandlerPath = DIR_USER_AUTH_FORM_HANDLER_PATH;
}

// Check if the session variable 'invalidcredential' is set
if (isset($_SESSION['invalidCredential']) && $_SESSION['invalidCredential'] === true) {

    echo(showMessage('error', 'Invalid Credentials'));
    // Unset the session variable to avoid showing the error on subsequent visits
    unset($_SESSION['invalidCredential']);
}else{
    if (isset($_GET['logout'])){
        echo(showMessage('success', 'User Logged Out Successfully'));

    }else{
        echo(showMessage('info', 'Please Login'));

    }

}

// Generate header with title and custom CSS
generateHeader('NX | LOGIN', 'user_management.css');
?>

<body>

<main>
    <div class="container login-container">
        <h3 class="title-small-text">USER LOG IN</h3>

        <form method="post" action="UserManagementHandlers/LogInFormHandler.php">
            <?php
            // Generate SVG input containers for username and password
            generateSvgInputContainer('Username', 'username.svg', isError:  $_SESSION["invalidCredential"], stickyValue: $_GET['username']);
            generateSvgInputContainer('Password', 'password.svg', typeName: 'password', isError: $_SESSION["invalidCredential"]);
            ?>

            <input type="submit" class="btn submit-button" value="Login">
        </form>

        <img src="../../assets/icons/logo.svg">

        <div>
            <a class="caption-text" href="reset.php"> Forgot Password</a>
            &nbsp;
            <a class="caption-text" href="register.php"> Register Account</a>
        </div>
    </div>
</main>

</body>

<?php
// Include the footer
require_once "../templates/footer.php";
?>
