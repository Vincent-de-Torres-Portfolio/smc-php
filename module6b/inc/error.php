<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ooops!</title>
    <link href="../assets/css/styles.css" rel="stylesheet">
    <link rel="icon" type="image/svg+xml" href="/module06b/assets/favicon.svg">

</head>
<body>
<?php include ('inc_header.php')
?>
<main>
    <?php echo "
    <div class='alert alert-error'> Unable to process request, Try again later. "
        .  "</div> " ?>
<h1> Something went wrong!</h1>
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path d="M9.036 7.976a.75.75 0 0 0-1.06 1.06L10.939 12l-2.963 2.963a.75.75 0 1 0 1.06 1.06L12 13.06l2.963 2.964a.75.75 0 0 0 1.061-1.06L13.061 12l2.963-2.964a.75.75 0 1 0-1.06-1.06L12 10.939 9.036 7.976Z"></path><path d="M12 1c6.075 0 11 4.925 11 11s-4.925 11-11 11S1 18.075 1 12 5.925 1 12 1ZM2.5 12a9.5 9.5 0 0 0 9.5 9.5 9.5 9.5 0 0 0 9.5-9.5A9.5 9.5 0 0 0 12 2.5 9.5 9.5 0 0 0 2.5 12Z"></path></svg>

<hr>

<p> Our team is working on it. Please try again later.</p>

</main>
<?php include ('inc_footer.php')
?>

</body>
</html>