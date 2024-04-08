 <?php
    $css = ["reset", "typography", "forms", "styles"];
    foreach ($css as $file) {
        echo "<link href='static/css/{$file}.css' rel='stylesheet'>";
    }

    if(isset($_SESSION['auth_token'])){
        echo " 
    <a class='caption-text' href='upload.php'>Upload</a>
    ";
    }
