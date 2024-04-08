<?php
session_start();

echo "WELCOME ". $_SESSION["user"] . " !";
echo "";
echo $_SESSION["token"];

?>
<a href="UserManagement/UserManagementHandlers/LogInFormHandler.php?logout" > LOGOUT </a>
