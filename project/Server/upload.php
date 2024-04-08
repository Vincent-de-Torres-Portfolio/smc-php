<?php

session_start();
if(!(isset($_SESSION['auth_token']))) {
header("Location:index.php?page=logout");
exit();
}?>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<title>Nexus | Upload Form</title>
<main class="page_content">
    <div class="container">
        <div class="upload_queue">

            <table id="displayTable">
                <!-- Table headers go here -->
            </table>
        </div>

        <form id="fileUploadForm" enctype="multipart/form-data">
            <input type="file" name="file[]" id="file" multiple>



            <input type="text" name="modifiedFileName" id="modifiedFileName" placeholder="Modify file name">


            <input type="submit" value="Upload">
        </form>

    </div>
</main>

<script src="static/js/script.js" defer></script>
