<?php

require "../src/oop.php";
require "../src/mdb_connection.php";
require "../src/login_backend.php";
$mdb = mdb_connect();
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $password = $_POST["password"];
    $error = do_the_login("$username", "$password");
    if ($error == "") {
        
        header ("Location: home.php");
        exit;

    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="resources/css/stylesheet.css">
</head>

<body>
<?php 
require "../templates/login_template.php";
require "../templates/top_bar.php";
?>
</body>
</html
