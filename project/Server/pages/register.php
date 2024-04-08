<!-- register.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>
<body>
<h2>Register</h2>
<form action="../includes/RegistrationHandler.php" method="post">
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    First Name: <input type="text" name="firstname" required><br>
    Last Name: <input type="text" name="lastname" required><br>
    Email: <input type="email" name="email" required><br>
    Access Code: <input type="text" name="access_code" required><br>
    <!-- Add other fields as needed -->

    <input type="submit" value="Register">
</form>
</body>
</html>
