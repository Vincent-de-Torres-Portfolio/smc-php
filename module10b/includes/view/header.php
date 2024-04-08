<?php
    session_start();

    if ($_SESSION["page_title"]){
        $title= $_SESSION["page_title"];
    }else{
        $title = "HIREd";
    }
    $cssBasePath="css/";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php echo $title?> </title>
        <link rel="stylesheet" href="<?php echo $cssBasePath; ?>reset.css">
        <link rel="stylesheet" href="<?php echo $cssBasePath; ?>typography.css">
        <link rel="stylesheet" href="<?php echo $cssBasePath; ?>forms.css">
        <link rel="stylesheet" href="<?php echo $cssBasePath; ?>styles.css">
    <link rel="stylesheet" href="<?php echo $cssBasePath; ?>buttons.css">


</head>

<section class="header-section">

    <div class="container">
        <div class="nexus-header-item nexus-header-item--full">
<h1 class="title-medium-text">
    hired!
</h1>            <form action="view.php" method="get">
                <input placeholder="Applicant ID" class="input form-input" type="text" id="applicant_id" name="id" required>
                <input type="submit" class="btn input-button" value="Search">
            </form>
        </div>

</section>