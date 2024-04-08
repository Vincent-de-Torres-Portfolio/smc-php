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
            <h1 class="title-large-text"> MySQL &mdash; Country Demographics</h1>
            <?php
            if (isset($_GET['viewScript'])) {
                echo '<a href="index.php" class="caption-text">Hide SQL Script</a>';
                echo readFileContents("demographics.sql");
            } else {
                echo '<a href="?viewScript" class="caption-text">View SQL Script</a>';
            }
            ?>

        </div>
        <div class="terminal">
            <?php
            for ($index = 1; $index <= 4; $index++) {
                $fileName = "./select" . $index . ".txt";
                echo readFileContents($fileName);
                $num = $index + 1;
            }
            ?>
        </div>



    </div>

</main>
</html>
