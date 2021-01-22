<!DOCTYPE html>
<?php

require "../src/oop.php";
require "../src/mdb_connection.php";
require "../src/sign_up_backend.php";

$username = $password = $username_error = $password_error = "";
$success = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $password = $_POST["password"];
    $mdb = mdb_connect();
    $success = do_the_sign_up("$username", "$password");
    if ($success) {

        header("Location: home.php");
        exit;
    }
}


?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="resources/css/stylesheet.css">
</head>

<body>
<?php 
require "../templates/top_bar.php";
require "../templates/sign_up_template.php";
?>
</body>
</html>
