<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles.css">
    <title>Jumble Maker</title>
</head>
<body>
<?php

/**
 * Displays the error message for a specified field.
 *
 * @param string $fieldName
 * @param string $errorMsg
 */
function displayError($fieldName, $errorMsg) {
    $sanitizedInput = array(htmlspecialchars($fieldName), htmlspecialchars($errorMsg));
    ?>
    <div class="alert alert-error">
        <strong> ERROR </strong> :  <?php echo "$sanitizedInput[0]   : $sanitizedInput[1] "; ?>
    </div>
    <?php
}

/**
 * Displays the success message with jumbled words.
 *
 * @param array $processedWordArray
 * @return string
 */
function displaySuccess($processedWordArray) {
    $wordCount = 1;
    $returnString = "";
    $returnString .= "<ul> <br>";
    foreach ($processedWordArray as $word) {
        $returnString .= "<label class='word-label'>WORD $wordCount</label>";
        $returnString .= "<li class='select-menu-item'>";
        $returnString .= "<span class='jumbled-word'><h1>$word</h1></span>";
        $returnString .= "</li> <br>";
        ++$wordCount;
    }
    return $returnString .= "</ul> <br>";
}

/**
 * Validates and returns a word input by the user.
 *
 * If the input string $data is empty, contains a character that is not a letter, or is not between
 * 4 and 7 characters long, display an error message, increment the global error count, and return
 * the empty string. Otherwise, use the strtoupper() and str_shuffle() functions to make the string
 * all uppercase and randomly shuffle the characters. Then return the jumbled set of letters.
 *
 * @param string $data
 * @param string $fieldName
 * @return string
 */
function validateWord($data, $fieldName) {
    global $errorCount;

    // Make sure that $data is not empty.
    if (empty($data)) {
        displayError($fieldName, "\"$fieldName\"  is a required field.");
        ++$errorCount;
        return "";
    }

    // Use preg_match function to match any non-alphabetical character in $data.
    if (preg_match('/[^A-Za-z]/', $data)) {
        displayError($fieldName, "\"$fieldName\" must contain only letters.");
        ++$errorCount;
        return "";
    }

    // Use if to check if $data exceeds or doesn't meet the required number of alphabetical characters.
    if (strlen($data) < 4 || strlen($data) > 7) {
        displayError($fieldName, " \"$fieldName\" must be between 4 and 7 characters long.");
        ++$errorCount;
        return "";
    }

    // If all verifications are passed, shuffle and return the data.
    return str_shuffle(strtoupper($data));
}

// This will ensure that this PHP script cannot be accessed directly and redirects the client to our form if a GET request was received.
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    displayError("Invalid Request", "Something went wrong");
    sleep(3);
    header('Location: JumbleMaker.html');
    echo "<div class='alert alert-info'>Please fill out the form.</div>\n";
    exit;
} else {
    // If method was POST, we can start processing form submission by first defining global variables that we will use to execute primary logic.
    // Define array to store validated input.
    $errorCount = 0;
    $words = array();

    $words[] = validateWord($_POST['Word1'], "Word 1");
    $words[] = validateWord($_POST['Word2'], "Word 2");
    $words[] = validateWord($_POST['Word3'], "Word 3");
    $words[] = validateWord($_POST['Word4'], "Word 4");

    // Global error count will be incremented if any of the requirements weren't met.
    // We then perform conditional checking here to decide whether to display the jumbled words or not.
    // If not, we display and specify which word didn't meet the requirements.
    if ($errorCount > 0) {
        echo "<div class='alert alert-warning'> Please use the \"Back\" button to re-enter the data. </div> <br>";
    } elseif ($errorCount == 0) {
        echo displaySuccess($words);
        echo "<div class='alert alert-success'>  Words processed successfully. </div> <br>";
    } else {
        echo "<div class='alert alert-warning'>  Please try again later. </div> <br>";
    }
}

?>
</body>
</html>

