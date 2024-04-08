<?php
// Start the session
session_start();

// Include the header file
include_once "includes/view/header.php";

// Check if data fetch was successful and fetched data is stored in the session
if (isset($_GET['fetch']) && $_GET['fetch'] === 'success' && isset($_SESSION['fetched_data'])) {
    // Retrieve fetched data from the session
    $fetchedData = $_SESSION['fetched_data'];

    // Destructure and display the fetched data
    extract($fetchedData);

    // Display applicant information
    ?>
    <h2>Applicant Information</h2>
    <p><strong>Name:</strong> <?= htmlspecialchars($applicant_name) ?></p>
    <a href="view.php?id=<?php echo htmlspecialchars($applicant_id) ?>"> <?php
        $currentURL = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        echo $currentURL;
        ?> </a>
    <p><strong>Position:</strong> <?= htmlspecialchars($position) ?></p>
    <p><strong>Date of Interview:</strong> <?= htmlspecialchars($date_of_interview) ?></p>
    <p><strong>Ranking for Communication:</strong> <?= htmlspecialchars($ranking_communication) ?></p>
    <p><strong>Ranking for Computer Skills:</strong> <?= htmlspecialchars($ranking_computer_skills) ?></p>
    <p><strong>Ranking for Business Knowledge:</strong> <?= htmlspecialchars($ranking_business_knowledge) ?></p>
    <p><strong>Interviewer Comments:</strong> <?= htmlspecialchars($interviewer_comments) ?></p>

    <hr>
    <a href="index.php"> Add Applicant </a>

    <?php
    // Unset the fetched data session variable
    unset($_SESSION['fetched_data']);
} elseif (isset($_GET["id"])) {
    // Redirect to FormHandler.php for processing with the specified 'id'
    header("Location:includes/control/FormHandler.php?id=" . $_GET["id"]);
} else {
    // Display message when no applicant information is available
    echo '<p>No applicant information available.</p>';
    // Redirect to the index.php page
    header("Location:index.php");
}

// Include the footer file
include_once "includes/view/footer.php";
?>
