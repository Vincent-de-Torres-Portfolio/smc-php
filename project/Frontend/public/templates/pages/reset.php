<main>
    <div class="container login-container">
        <h3 class="title-small-text">FORGOT PASSWORD</h3>

        <form action="includes/reset.inc.php" method="post">
            <?php

            use Classes\UI\Input\IconInput\IconInputFactory;
            // Use the factory method to create IconInput instances
            $usernameInput = IconInputFactory::create([], "Username", "username.svg", "text");
            $emailInput = IconInputFactory::create([], "Email Address", "email.svg", "text");
            $resetCodeInput = IconInputFactory::create([], "Reset Code", "password.svg", "password");

            $usernameInput->generate();
            $emailInput->generate();
            $resetCodeInput->generate();

            ?>

            <input type="submit" class="btn submit-button" value="Reset Password">
        </form>

        <img src="public/assets/icons/logo.svg">

        <div>
            <a class="caption-text" href="index.php?action=login"> Login </a>
            &nbsp;
            <a class="caption-text" href="index.php?action=register"> Register Account</a>
        </div>
    </div>
</main>

<script>
    // Append the CSS stylesheet link element
    var link = document.createElement("link");
    link.rel = "stylesheet";
    link.type = "text/css";
    link.href = "public/css/custom/user_management.css";
    document.head.appendChild(link);

    // Change the title
    document.title = "Login";
</script>
