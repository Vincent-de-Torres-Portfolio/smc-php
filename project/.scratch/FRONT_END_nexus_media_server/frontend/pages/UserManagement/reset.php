<?php
/**
 * resetpassword.php
 *
 * This file serves as the reset password page for the NX application.
 * It includes the necessary components and generates the reset password form.
 */

// Include necessary files
require_once "../templates/components/index.php";
require_once "../templates/header.php";

// Generate header with title and custom CSS
generateHeader('NX | RESET PASSWORD', 'user_management.css');
?>

<body>
<main>
    <div class="container login-container">
        <h3 class="title-small-text">FORGOT PASSWORD</h3>

        <form action="../../../includes/LoginHandler.php" method="post">
            <?php
            // Generate SVG input containers for username, email, and reset code
            generateSvgInputContainer('Username', 'username.svg');
            generateSvgInputContainer('Email', 'email.svg', typeName: 'email');
            generateSvgInputContainer('One-Time Reset Code', 'password.svg', typeName: 'password');
            ?>

            <input type="submit" class="btn submit-button" value="Reset Password">
        </form>

        <img src="../../assets/icons/logo.svg">


        <div>
            <a class="caption-text" href="login.php"> Login </a>
            &nbsp;
            <a class="caption-text" href="register.php"> Register Account</a>
        </div>
    </div>
</main>
</body>

<?php include
require_once "../templates/footer.php";

;?>

