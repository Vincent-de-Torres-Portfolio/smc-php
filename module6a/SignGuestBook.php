<?php
session_start(); // Start the session or resume if it already exists

// Function to sanitize input data
function sanitizeInput($input) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

function showToast($type, $message) {
    echo '   <link href="css/toast.css" type="text/css" rel="stylesheet">';
    echo '<div class="toast ' . $type . '">';
    echo $message;
    echo '</div>';
}

// Check if the form is submitted using the POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate and process first name
    if (isset($_POST["firstName"]) && !empty($_POST["firstName"])) {
        $firstName = sanitizeInput($_POST["firstName"]);
    } else {
        // Store error message in session variable
        $_SESSION['error_message'] = 'First Name cannot be empty';
        header("Location: index.php?error=First_Name");
        exit();
    }

    // Validate and process last name
    if (isset($_POST["lastName"]) && !empty($_POST["lastName"])) {
        $lastName = sanitizeInput($_POST["lastName"]);
    } else {
        // Store error message in session variable
        $_SESSION['error_message'] = 'Last Name cannot be empty';
        header("Location: index.php?error=Last_Name");
        exit();
    }

    // Process the sanitized inputs as needed (e.g., saving to a database)
    $FirstName = addslashes($firstName);
    $LastName = addslashes($lastName);
    $GuestBook = fopen("guestbook.txt", "ab");
    $timestamp = date("Y-m-d H:i:s");

    if (is_writeable("guestbook.txt")) {
        if (fwrite($GuestBook, $LastName . ", " . $FirstName . ", " . $timestamp . "\n")) {
            // Display success toast
            showToast('success slide-out', 'Signature added successfully!');
            header("Location: index.php?success");
            exit();
        } else {
            // Display error toast
            showToast('error slide-out', 'Cannot add your name to the guest book.');
        }
        fclose($GuestBook);
    } else {
        // Display error toast
        showToast('error slide-out', 'Cannot write to the file.');
    }

    // You can add additional processing or redirect the user to another page after processing the data.
} else {
    showToast('warning', 'Access Invalid');
    sleep(3);
    header("Location: index.php?error=Access_Invalid");
    exit();
}
