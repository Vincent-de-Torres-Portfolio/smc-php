<?php
// Start the session
function showToast($type, $message) {
    echo '   <link href="css/toast.css" type="text/css" rel="stylesheet">';
    echo '<div class="toast ' . $type . '">';
    echo $message;
    echo '</div>';
}
// Check if error message is set in session
if (isset($_GET['success'])) {
    // Display success toast
    showToast('success', 'Signature added successfully!');
}
if(isset($_GET['error'])){
    showToast('error', 'Please fill out all required fields.');
}

require ('GuestBook.html');
include ('inc/inc_footer.php');
