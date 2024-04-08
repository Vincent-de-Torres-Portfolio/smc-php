<?php
session_start();

$errorMessage = [];

/**
 * Validates and sanitizes input data.
 *
 * @param string $input The input data to be validated and sanitized.
 * @param string $fieldName The name of the field for error messages.
 * @return string The validated and sanitized input or an empty string if validation fails.
 */
function validateAndSanitizeInput($input, $fieldName) {
    global $errorMessage;

    if (empty($input)) {
        $errorMessage[] = "$fieldName is required";
        return '';
    }

    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);

    if ($fieldName == 'email' && !filter_var($input, FILTER_VALIDATE_EMAIL)) {
        $errorMessage[] = "Invalid email format";
        return '';
    }else{
        return $input;
    }
}

/**
 * Writes changes to the participants master list CSV file.
 *
 * @param array $data The data to be written to the CSV file.
 * @return bool True if changes were successfully written, false otherwise.
 */

function writeChanges($data) {
    try {
        $participantsMasterList = 'assets/data/participantsMasterList.csv';

        if (!file_exists($participantsMasterList)) {
            touch($participantsMasterList);
        }

        $file = fopen($participantsMasterList, 'a');
        fputcsv($file, $data);
        fclose($file);

        return true;
    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }
}

/**
 * Displays success message and redirects to index.php.
 *
 * @param string $playerName The name of the player for whom changes were saved.
 */
function displaySuccess($playerName) {
    $_SESSION['playerName'] = $playerName;
    echo "<div class='alert alert-success'> Words processed successfully. </div> <br>";
    header("Location: inc/success.php");
    exit();
}

/**
 * Displays error message and redirects to index.php with form data stored in session.
 *
 * @param array $errorMsg The error message to be displayed.
 */
function displayError() {
    global $errorMsg;
    $sanitizedInput = htmlspecialchars($errorMsg);
    echo "<div class='alert alert-error'><strong> ERROR </strong>: $sanitizedInput[0] : $sanitizedInput[1]</div>";
}

// Validate and sanitize form inputs
$teamName = validateAndSanitizeInput($_POST['teamName'], 'Team Name');
$playerName = validateAndSanitizeInput($_POST['playerName'], 'Player Name');
$ageGroup = validateAndSanitizeInput($_POST['ageGroup'], 'Age Group');
$averageScore = validateAndSanitizeInput($_POST['averageScore'], 'Average Score');
$playerEmail = validateAndSanitizeInput($_POST['playerEmail'], 'Email');

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $data = [$teamName, $playerName, $ageGroup, $averageScore, $playerEmail];

    if (writeChanges($data)) {
        displaySuccess($playerName);
    } else {
        $_SESSION['formData'] = [
            'teamName' => $teamName,
            'playerName' => $playerName,
            'ageGroup' => $ageGroup,
            'averageScore' => $averageScore,
            'playerEmail' => $playerEmail,
            'errorMessage' => 'Unable to write changes.'
        ];

        displayError($_SESSION['formData']);
    }

} else {
    header("Location: inc/error.php");
    exit();
}
