<!-- registration.php -->
<?php
/**
 * registration.php
 *
 * This file serves as the registration page for the NX application.
 * It includes the necessary components and generates the registration form.
 */

// Include necessary files
require_once "../templates/components/index.php";
require_once "../templates/header.php";

// Generate header with title and custom CSS
generateHeader('NX | REGISTER', 'user_management.css');
?>


<body>
<main class="grid grid-two-col fade-in">
    <div class="logo-wrapper">
        <img class="logo-display slide-in-left fade-in" src="../../assets/icons/logo.svg" alt="Logo">
    </div>


    <div class="container register-container">

        <form action="../../../includes/RegistrationHandler.php" method="post">
<!--            <h3 class="title-small-text">USER REGISTRATION </h3>-->


            <?php
            // Generate SVG input containers for name, email, username, and passwords
            generateSvgInputContainer('Full Name', 'name.svg');
            generateSvgInputContainer('Email', 'email.svg', typeName: 'email');
            generateSvgInputContainer('Username', 'username.svg');
            generateSvgInputContainer('Password', 'password.svg', typeName: 'password');
            generateSvgInputContainer('Verify Password', 'copy.svg', typeName: 'password');
            ?>
            <input type="submit" class="btn submit-button" value="Register">

            <p class="caption-text" style="color: #ccc; margin-bottom: 10px;padding: 5px;">
                By signing up, you agree to the Terms of Service and Privacy Policy, including Cookie Use.
            </p>

        </form>
        <a class="caption-text" href="login.php">&nbsp;&nbsp;&nbsp; Already have an account? Sign In </a>




    </div>

</main>

<?php include '../templates/footer.php'; ?>
</body>
</html>
