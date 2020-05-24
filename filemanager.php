<?php

    require 'includes/auth_check.php';

    require __DIR__.'/vendor/autoload.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/app.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <title>File manager</title>
</head>
<body>
    <?php include('includes/nav.php') ?>

    <div class="container">
        <h3>File Manager</h3>
    </div>
</body>
</html>