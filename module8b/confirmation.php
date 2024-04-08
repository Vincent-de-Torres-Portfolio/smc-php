<?php
session_start();

// Check if order data is available in the session
if (!isset($_SESSION['order'])) {
    header('Location: mysessions.php');
    exit();
}

// Handle checkout
if (isset($_GET['checkout'])) {
    unset($_SESSION['order']);
    header('Location: checkout.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
</head>
<body>
    <h1>Order Confirmation</h1>

    <?php if (isset($_SESSION['order'])) : ?>
        <h2>Order Summary</h2>
        <ul>
            <?php foreach ($_SESSION['order'] as $item) : ?>
                <li><?= $item['product'] ?>: <?= $item['quantity'] ?></li>
            <?php endforeach; ?>
        </ul>
        <a href="confirmation.php?checkout">Check Out</a>
    <?php endif; ?>
</body>
</html>
