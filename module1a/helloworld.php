<!--
Vincent de Torres
CS85 - PHP Programming
Module 1- Assignment1

Date: 8 January 2024
Filename: helloworld.php
-->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="icon" href="/images/favicon.svg" type="image/svg+xml">
    <title>De Torres |SMC_CS85 - Hello World </title>

    <style>
        body {
            font-size: 3rem;
            text-transform: uppercase;
            height: 100vh;
            overflow: hidden;
            width: 70vw;
            margin: 0 auto;
            letter-spacing: 2px;
            display: flex;
            font-weight: bolder;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            background: linear-gradient(to right, #4F5D95, #4f5b93);
        }
        h1 {
            color: #fff;
            font-size: 62px;
            font-family: sans-serif;
            font-weight: 700;
            line-height: 72px;
            margin: 0 0 24px;
            text-align: center;
            text-transform: uppercase;
            padding: 1rem;
            border-radius: 5px;
            width: 100vw;
        }
    </style>
</head>

<body>
<h1>
    <?php
    // hello-world.php
    echo 'Hello World!';
    ?>
</h1>
</body>

</html>
