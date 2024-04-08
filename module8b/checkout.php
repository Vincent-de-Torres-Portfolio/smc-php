<?php
session_start();

// Clear the order information from the session
unset($_SESSION['order']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <h2>Checkout</h2>
        <p>Your order has been processed. Thank you for shopping with us!</p>
        <p><a href="mysessions.php">Return to Order Form</a></p>
    </div>
</body>

</html>
