<?php
session_start();
include_once "../config/config.php";

$connect = null;

/**
 * Connects to the MySQL database.
 */
function connectToDatabase() {
    global $connect;

    $connect = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

    if ($connect->connect_error) {
        die("Connection failed: " . $connect->connect_error);
    } else {
        echo "CONNECTED";
    }
}

function addApplicantRecord($name, $position, $dateOfInterview, $rankingCommunication, $rankingComputerSkills, $rankingBusinessKnowledge, $interviewerComments, $applicantId) {
    connectToDatabase();

    global $connect;

    try {
        $_SESSION["applicant_id"] = $applicantId;

        $sql = "INSERT IGNORE INTO applicants (applicant_id, name, position, date_of_interview, ranking_communication, ranking_computer_skills, ranking_business_knowledge, interviewer_comments) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $connect->prepare($sql);

        $stmt->bind_param("ssssssss", $applicantId, $name, $position, $dateOfInterview, $rankingCommunication, $rankingComputerSkills, $rankingBusinessKnowledge, $interviewerComments);

        $stmt->execute();

        if ($stmt->error) {
            throw new Exception("Execute failed: " . $stmt->error);
        }

        $stmt->close();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        if (isset($connect)) {
            $connect->close();
        }
        header("Location: ../../index.php?controller=view&id=" . $_SESSION["applicant_id"]);
        exit;
    }
}

function fetchApplicantData($applicantId) {
    connectToDatabase();

    global $connect;

    $applicantData = [];

    $sql = "SELECT * FROM applicants WHERE applicant_id = ?";

    $stmt = $connect->prepare($sql);
    $stmt->bind_param("s", $applicantId);

    if ($stmt->execute()) {
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $applicantData['applicant_id'] = $row['applicant_id'];
            $applicantData['applicant_name'] = $row['name'];
            $applicantData['position'] = $row['position'];
            $applicantData['date_of_interview'] = $row['date_of_interview'];
            $applicantData['ranking_communication'] = $row['ranking_communication'];
            $applicantData['ranking_computer_skills'] = $row['ranking_computer_skills'];
            $applicantData['ranking_business_knowledge'] = $row['ranking_business_knowledge'];
            $applicantData['interviewer_comments'] = $row['interviewer_comments'];

            $result->close();
        } else {
            $applicantData['error'] = "No records found for the given applicant_id.";
        }
    } else {
        $applicantData['error'] = "Error executing the query: " . $stmt->error;
    }

    $stmt->close();
    $connect->close();

    return $applicantData;
}
