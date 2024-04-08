<?php
include "components/FormInput.php";
include "components/InputButton.php"
?>
<main class="container">

<form id="applicantForm" action="includes/control/FormHandler.php" method="POST">
    <?php
    echo generateInput("Interviewer's Name", "interviewer-name", "interviewer_name");
    ?>

    <!-- Date of Interview -->
    <label class="form-label" for="date-of-interview">Date of Interview:</label>
    <input class="form-input" type="date" id="date-of-interview" name="date_of_interview" required>

    <hr>
    <!-- Candidate's Details -->
    <?php
    $candidateOptions = [
        ['value' => '1', 'label' => '1'],
        ['value' => '2', 'label' => '2'],
        ['value' => '3', 'label' => '3'],
        ['value' => '4', 'label' => '4'],
        ['value' => '5', 'label' => '5'],
    ];

    echo generateInput("Candidate's Name", 'candidate-name', 'candidate_name');
    echo generateInput("Position", 'position', 'interviewer_position');
    echo generateRadioGroup('Communication Abilities', 'communication-abilities', 'communication_abilities', $candidateOptions);
    echo generateRadioGroup('Computer Skills', 'computer-skills', 'computer_skills', $candidateOptions);
    echo generateRadioGroup('Business Knowledge', 'business-knowledge', 'business_knowledge', $candidateOptions);


    ?>
    <textarea placeholder="Comments" rows="7" name="comments" class="textarea form-textarea" id="textarea-input"></textarea>
    <input type="submit" class="button submit-button">
</form>


</main>
