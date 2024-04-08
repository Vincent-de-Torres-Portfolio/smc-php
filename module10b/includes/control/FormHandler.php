<?php
session_start();

require_once "DatabaseController.php"; // Assuming this is the file containing your database functions

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize and validate form data
    $name = htmlspecialchars($_POST['candidate_name']);
    $position = htmlspecialchars($_POST['interviewer_position']);
    $dateOfInterview = htmlspecialchars($_POST['date_of_interview']);
    $rankingCommunication = htmlspecialchars($_POST['communication_abilities']);
    $rankingComputerSkills = htmlspecialchars($_POST['computer_skills']);
    $rankingBusinessKnowledge = htmlspecialchars($_POST['business_knowledge']);
    $interviewerComments = htmlspecialchars($_POST['comments']);
    // Check if any validation errors occurred
    if (in_array(false, [$name, $position, $dateOfInterview, $rankingCommunication, $rankingComputerSkills, $rankingBusinessKnowledge, $interviewerComments], true)) {
        echo "Validation failed. Please check your inputs.";
    } else {
        $applicantId = generateRandomId();
        $_SESSION["applicant_id"] = $applicantId;
        addApplicantRecord($name, $position, $dateOfInterview, $rankingCommunication, $rankingComputerSkills, $rankingBusinessKnowledge, $interviewerComments,$applicantId);

    }
}elseif (isset($_GET['id'])) {
    $applicantId = htmlspecialchars($_GET['id']);
    $fetchedData = fetchApplicantData($applicantId);
    if ($fetchedData) {
        // Set the fetched data in a session variable
        $_SESSION['fetched_data'] = $fetchedData;

        // Redirect back to the view.php page with fetch=success
        header("Location: ../../view.php?id=$applicantId&fetch=success");
        exit();
    } else {
        // Handle non-POST requests
        echo "Invalid request method.";
//    header("Location:../../index.php");
    }
}

/**
 * Generates a random alphanumeric ID.
 *
 * @param int $length The length of the generated ID.
 * @return string The random ID.
 */
function generateRandomId($length = 8) {
    return substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length);
}