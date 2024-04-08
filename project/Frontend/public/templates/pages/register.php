<main class="grid grid-two-col fade-in">
    <div class="logo-wrapper">
        <img class="logo-display slide-in-left fade-in" src="public/assets/icons/logo.svg" alt="Logo">
    </div>

    <div class="container register-container">
        <form action="Includes/RegisterHandler.php" method="post">
            <?php
            session_start();
            // Define attributes array
            use Classes\UI\Input\IconInput\IconInputFactory;

            // Define attributes array
            $attributesArray = array(
                array('placeholder' => 'First Name', 'icon' => 'name.svg', 'name' => 'firstname'),
                array('placeholder' => 'Last Name', 'icon' => 'name.svg', 'name' => 'lastname'),
                array('placeholder' => 'Email', 'icon' => 'email.svg', 'type' => 'email', 'name' => 'email'),
                array('placeholder' => 'Username', 'icon' => 'username.svg', 'name' => 'username'),
                array('placeholder' => 'Password', 'icon' => 'password.svg', 'type' => 'password', 'name' => 'password'),
                array('placeholder' => 'Verify Password', 'icon' => 'copy.svg', 'type' => 'password', 'name' => 'verify_password')
            );

            // Iterate through the attributes array and generate form inputs
            foreach ($attributesArray as $attributes) {
                $type = isset($attributes['type']) ? $attributes['type'] : 'text';
               $toRender= IconInputFactory::create([], $attributes["placeholder"], $attributes["icon"], $type)->generate();
            echo ($toRender);
            }
            ?>
            <input type="submit" class="btn submit-button" name="signup" value="Register">
            <p class="caption-text" style="color: #ccc; margin-bottom: 10px;padding: 5px;">
                By signing up, you agree to the Terms of Service and Privacy Policy, including Cookie Use.
            </p>
        </form>
        <a class="caption-text" href="?action=login">&nbsp;&nbsp;&nbsp; Already have an account? Sign In </a>
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
    document.title = "Sign Up";
</script>
