<?php
/**
 * This script handles the product ordering process.
 * It allows users to select quantities for different products,
 * stores the order in a session, and provides a way to checkout.
 */

session_start();

// Define the list of available products
$products = array(
    'Product A',
    'Product B',
    'Product C',
    'Product D',
    'Product E',
    'Product F'
);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Initialize the order in the session if it doesn't exist
    if (!isset($_SESSION['order'])) {
        $_SESSION['order'] = array();
    }

    // Loop through each product
    foreach ($products as $index => $product) {
        // Get the quantity from the form submission, defaulting to 0 if not set
        $quantity = isset($_POST['quantity'][$index]) ? intval($_POST['quantity'][$index]) : 0;
        // Store the product and quantity in the session
        $_SESSION['order'][$index] = array('product' => $product, 'quantity' => $quantity);
    }

    // Redirect to the confirmation page
    header('Location: confirmation.php');
    exit();
}

// Handle checkout
if (isset($_GET['checkout'])) {
    // Clear the order from the session
    unset($_SESSION['order']);
    // Redirect to the confirmation page
    header('Location: confirmation.php');
    exit();
}
?>

<!-- HTML for the order form -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHOP | DEV.</title>
    <link rel="icon" type="image/svg+xml" href="assets/favicon.svg">
    <link href="css/reset.css" rel="stylesheet" type="text/css">
    <link href="css/typography.css" rel="stylesheet" type="text/css">
    <link href="css/toast.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">

</head>

<body>
<?php
    include "includes/header.php";
    // include "includes/sidebar.php";
    ?>
    <main>
   

    <form method="post" action="mysessions.php">
        <?php foreach ($products as $index => $product) : ?>
            <!-- Input field for each product's quantity -->
            <label for="quantity<?= $index ?>">Quantity for <?= $product ?>:</label>
            <input class= "form-input input-field" type="number" id="quantity<?= $index ?>" name="quantity[<?= $index ?>]" value="<?= isset($_SESSION['order'][$index]['quantity']) ? $_SESSION['order'][$index]['quantity'] : 0 ?>" min="0">
            <br>
        <?php endforeach; ?>

        <input class="btn submit-button" type="submit" value="Submit Order">
    </form>


            </main>

            <php? include "includes/footer.php";?>
</body>
</html>