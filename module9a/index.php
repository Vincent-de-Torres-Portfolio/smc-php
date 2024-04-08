<?php
function readFileContents($filePath)
{
    if (file_exists($filePath)) {
        $fileContents = file_get_contents($filePath);
        if ($fileContents === false) {
            return "Error reading file contents.";
        }

        return '<pre style="white-space: pre; font-family: monospace;">' . htmlspecialchars($fileContents, ENT_QUOTES) . '</pre>';
    } else {
        return "File not found.";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MySQL</title>

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/typography.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<main>
    <div>
        <div>
            <h1 class="title-large-text"> MySQL &mdash; Baseball Teams</h1>
            <?php
            if (isset($_GET['viewScript'])) {
                echo '<a href="index.php" class="caption-text">Hide SQL Script</a>';
                echo readFileContents("baseballteams.sql");
            } else {
                echo '<a href="?viewScript" class="caption-text">View SQL Script</a>';
            }
            ?>

        </div>
        <div class="terminal">
            <?php
            echo readFileContents('./query.txt');
            echo readFileContents('./table.txt');
            ?>
        </div>



    </div>

</main>
</html>
