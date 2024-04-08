<?php
session_start();

// Function to sanitize input
function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

//// Check if user is logged in and has a reset code in session
//if (!isset($_SESSION['user_logged_in']) || !isset($_SESSION['reset_code'])) {
//    header('Location: login.php');
//    exit();
//}

// Get username from cookie
$username = isset($_COOKIE['username']) ? $_COOKIE['username'] : '';

// Get reset code from session
$resetCode = $_SESSION['reset_code'];

// Function to set a cookie
function setCookieWithExpiry($name, $value, $expiry) {
    setcookie($name, $value, $expiry, '/');
}

// Set username cookie for 1 day
setCookieWithExpiry('username', $username, time() + 24 * 3600);

// Clear the reset code from session
unset($_SESSION['reset_code']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome User</title>
    <!-- Add your styles or include external stylesheets here -->
    <style>
        body {
            background-color: #24292f;
            color: #ccc;
            font-size: 16px;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
            justify-content: space-between;
            align-content: space-between;
            padding-top: 50px;
        }

        .container {
            text-align: center;
        }

        .welcome-message {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .instruction-message {
            margin-bottom: 20px;
        }

        .btn {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="welcome-message">
        Welcome, <?php echo $_COOKIE('name') ?>!
    </div>
    <div class="instruction-message">
        Thank you for registering. Please save the one-time reset code below:
        <br>
        <strong><?php echo $resetCode; ?></strong>
    </div>
    <button class="btn" onclick="printAndSave()">Print and Save Login</button>
</div>

<script>
    function printAndSave() {
        // Open the print dialog
        window.print();
    }
</script>
</body>
</html>
