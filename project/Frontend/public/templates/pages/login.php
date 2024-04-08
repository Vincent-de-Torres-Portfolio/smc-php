<main class="main-content" id="login-content">
    <div class="container">
        <main>
            <div class="container login-container">
                <img src="public/assets/icons/default_user_icon.svg" style="padding: 15px;max-width: 125px">
                <h3 class="title-small-text">USER LOG IN</h3>


                <form method="post" action="Includes/LoginHandler.php">
                    <?php
                    session_start();
                    use Classes\UI\Input\IconInput\IconInputFactory;
                    // Use the factory method to create IconInput instances
                    IconInputFactory::create([], "Username", "username.svg", "text")->generate();
                    IconInputFactory::create([], "Password", "password.svg", "password")->generate();

                    if ($_GET["error"]) {
                        ?>
                        <script>
                            const inputElements = document.querySelectorAll('input');
                            inputElements.forEach(function (input) {
                                input.classList.add('error');
                            });
                        </script>
                        <?php
                    }
                    ?>

                    <input type="submit" class="btn submit-button" value="Login" name="login">
                </form>


                <div>
                    <a class="caption-text" href="?action=reset"> Forgot Password</a>
                    &nbsp;
                    <a class="caption-text" href="?action=register"> Register Account</a>
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
    </div>
</main>
