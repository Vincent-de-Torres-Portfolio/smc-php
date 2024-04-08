<?php
// Start the session
session_start();

// Include header file
include_once "includes/view/header.php";

// Initialize view content
$viewContent = "";

// Check if 'id' is set in the URL
if (isset($_GET['id'])) {
    // Extract 'id' from the URL
    $view_id = $_GET['id'];

    // Store 'id' in the session
    $_SESSION["applicant_id"] = $view_id;

    // Redirect to view.php with the specified 'id'
    header("Location: view.php?id=$view_id");
    exit();
} else {
    // Include template_form.php if 'id' is not set
    include_once "includes/view/template_form.php";
}

// Output the view content
echo $viewContent;

// Include footer file
include_once "includes/view/footer.php";
