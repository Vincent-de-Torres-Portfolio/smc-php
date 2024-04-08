<?php

$errorMessages = array();
$errorCount = 0;


/**
 * Display errors as an unordered list with styling.
 *
 * @param array $errors The array of error messages.
 * @return string HTML markup for displaying errors.
 */

function displayErrors($errors)
{
    if (empty($errors)) {
        return ''; // Return an empty string if there are no errors
    }

    $html = "<ul class='error-list'>";
    foreach ($errors as $error) {
        $html .= "<li class='slide-in'>$error</li>";
    }
    $html .= "</ul>";

    return $html;
}

/**
 * Display a success message.
 *
 * @param string $message The success message to be displayed.
 */
function displaySuccess($message)
{
    return "<div class='toast success'>$message</div>";
}

/**
 * Display a toast alert by echoing a div with the specified type and message.
 *
 * @param string $type The type of the alert (info, error, success).
 * @param string $message The message to be displayed in the alert.
 */
function showAlert($type, $message)
{
    // Echo the div with the specified type and message
    echo "<div class='toast $type'>$message</div>";
    // Include JavaScript to add the 'slide-out' class and remove the notification after 5 seconds
}

/**
 * Validates and cleans up input data for a form field.
 *
 * This function takes a string $data to be validated and a string $fieldName representing the name of the form field.
 * It performs basic validation, such as trimming the input and checking for emptiness.
 * The function uses the global variable $errorCount to track the number of validation errors,
 * and the global variable $errorMessages to track the error messages.
 *
 * @param string $data The input data to be validated.
 * @param string $fieldName The name of the form field being validated.
 * @return string $returnValue The cleaned and validated input data.
 */
function validateInput($data, $fieldName)
{
    global $errorCount, $errorMessages;

    // Trim leading and trailing whitespace
    $data = trim($data);

    // Filter the input to remove HTML tags and encode special characters
    $data = filter_var($data, FILTER_SANITIZE_STRING);

    if (empty($data)) {
        // Increment the error count
        $errorCount++;

        // Append error message to global array
        $errorMessages[] = "$fieldName is required.";

        return ""; // Return an empty string in case of an error
    } else {
        // Trim and strip slashes for non-empty data
        $returnValue = stripslashes($data);
        $returnValue = htmlspecialchars($returnValue); // Adding htmlspecialchars for additional security
    }

    // Return the cleaned data
    return $returnValue;
}

/**
 * Validates and returns an email address input by the user.
 *
 * If the input email $data is empty, appends an error message to the global array.
 * Otherwise, remove all illegal characters from the email. If the resulting string is not a valid email,
 * appends an error message to the global array. Otherwise, return the cleaned up email.
 *
 * @param string $data
 * @param string $fieldName
 * @return string $returnValue
 */
function validateEmail($data, $fieldName)
{
    global $errorCount, $errorMessages;

    // Trim leading and trailing whitespace
    $data = trim($data);

    if (empty($data)) {
        // Increment the error count
        $errorCount++;

        // Append error message to global array
        $errorMessages[] = "$fieldName is required.";
        $returnValue = "";
    } else {
        // Filter the email to remove illegal characters
        $returnValue = filter_var($data, FILTER_SANITIZE_EMAIL);

        if (empty($returnValue) || !filter_var($returnValue, FILTER_VALIDATE_EMAIL)) {
            // Increment the error count
            $errorCount++;

            // Append error message to global array
            $errorMessages[] = "Invalid $fieldName address.";
            $returnValue = "";
        }
    }

    return $returnValue;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Me</title>
    <link href="css/reset.css" type="text/css" rel="stylesheet">
    <link href="css/typography.css" type="text/css" rel="stylesheet">
    <link href="css/toast.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>

    <main>
        <?php
    /**
     * Display a draft message with the values of the validated input fields.
     *
     * @param string $senderFirstName
     * @param string $senderLastName
     * @param string $email
     * @param string $subject
     * @param string $message
     */
    function showDraft($senderFirstName, $senderLastName, $email, $subject, $message) {
        echo "<div class='draft-message'>";
        echo "<h3> Message</h3> <hr>";
        echo "<ul>";
        echo "<li><strong>First Name:</strong> $senderFirstName</li>";
        echo "<li><strong>Last Name:</strong> $senderLastName</li>";
        echo "<li><strong>Email:</strong> $email</li>";
        echo "<li><strong>Subject:</strong> $subject</li>";
        echo "<li><strong>Message:</strong> $message</li>";
        echo "</ul>";
        echo "</div>";
    }


        /**
         * Displays the contact form with sticky form functionality.
         *
         * This function generates and displays an HTML form with input fields for First Name, Last Name,
         * Email Address, Subject Line, and Message. The provided values for each field are used as initial
         * values to enable sticky form functionality.
         *
         * @param string $senderFirstName The value for the First Name field.
         * @param string $senderLastName The value for the Last Name field.
         * @param string $email The value for the Email Address field.
         * @param string $subject The value for the Subject Line field.
         */
        function displayForm($senderFirstName, $senderLastName, $email, $subject, $message)
        {
            include('inc/header.html');
        ?>
            <form name="contact" method="post" class="container">
                <div id="senderName">
                    <fieldset>
                        <label for="senderFirstName" class="label">First Name:</label>
                        <input placeholder="First Name" class="input-field" type="text" id="senderFirstName" name="senderFirstName" value="<?php echo htmlspecialchars($senderFirstName); ?>" />
                    </fieldset>

                    <fieldset>
                        <label for="senderLastName" class="label">Last Name:</label>
                        <input placeholder="Last Name" class="input-field" type="text" id="senderLastName" name="senderLastName" value="<?php echo htmlspecialchars($senderLastName); ?>" />
                    </fieldset>
                </div>

                <fieldset>
                    <label for="email" class="label">Email Address:</label>
                    <input placeholder="Email Address" class="input-field" type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" />
                </fieldset>

                <fieldset>
                    <label for="subject" class="label">Subject Line:</label>
                    <input placeholder="Subject Line" class="input-field" type="text" id="subject" name="subject" value="<?php echo htmlspecialchars($subject); ?>" />
                </fieldset>

                <fieldset>
                    <label for="message" class="label">Message:</label>
                    <textarea placeholder="How can we be of service today?" class="input-field" id="message" name="message" rows="15"><?php echo htmlspecialchars($message); ?></textarea>
                </fieldset>

                <fieldset>
                    <div class="form-buttons">
                        <input type="submit" name="Submit" class="submit-button" value="Submit" />
                        <input type="reset" class="clear-button" value="Clear" />
                    </div>
                </fieldset>
            </form>
        <?php
        }

        $ShowForm = true;
        $senderFirstName = "";
        $senderLastName = "";
        $email = "";
        $subject = "";
        $message = "";

        // Check if the form is submitted
        if (isset($_POST['Submit'])) {
            // Validate and sanitize input data
            $senderFirstName = validateInput($_POST['senderFirstName'], "First Name");
            $senderLastName = validateInput($_POST['senderLastName'], "Last Name");
            $email = validateEmail($_POST['email'], "Email");
            $subject = validateInput($_POST['subject'], "Subject");
            $message = validateInput($_POST['message'], "Message");

            // Check if there are any validation errors
            if ($errorCount == 0) {
                $ShowForm = false; // Set $ShowForm to false if there are no errors
                // Send email and display success or error message
                $Sender = $senderFirstName . ' ' . $senderLastName;
                $SenderAddress = "$Sender <$email>";
                $Headers = "From: $SenderAddress\nCC: $SenderAddress\n";
            
                // Simulate sending email (since no mail server is set up)
                $result = mail("recipient@example.com", $subject, $message, $Headers);
                $result = true; // Set $result to true to simulate successful email sending
            
                // Display draft/info message for successful validation
                showDraft($senderFirstName, $senderLastName, $email, $subject, $message);
                echo displaySuccess("All input fields are validated. Attempting to send the email.");
            
                if ($result) {
                    showAlert('success', "Your message has been sent. Thank you, $Sender.");
                } else {
                    showAlert('error', "There was an error sending your message, $Sender.");
                }
            }
        }

        // Display the form if $ShowForm is true
        if ($ShowForm) {
            // Display form with error messages if $ShowForm is true and there are errors
            if ($errorCount > 0) {
                // Display error messages
                displayForm($senderFirstName, $senderLastName, $email, $subject, $message);
                echo displayErrors($errorMessages);
            } else {
                // Display the initial form
                displayForm($senderFirstName, $senderLastName, $email, $subject, $message);
            }
        }
        ?>
            <?php include("inc/inc_footer.php"); ?>

    </main>
</body>

</html>
