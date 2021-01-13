<?php

    session_start();
    $name = $_SESSION["name"];
    $id = $_SESSION["id"];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
    <h1>Welcome to your home, <?php echo "$name" ?>.</h1>
    <h2>Your id is: <?php echo "$id"?></h2>
</body>
</html>