<?php
    
require '../src/oop.php';
require '../src/mdb_connection.php';
$mdb = mdb_connect();
session_start();
if (!isset($_SESSION['object'])){

    if(!isset($_COOKIE["user"])) {

        header ("Location: index.html");
        exit;

    } else {

        $id = $_COOKIE["user"];
        $current_user = new User("$id");
        
    }
} else {

    $current_user = $_SESSION["object"];
}
session_destroy();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="/php_chatter/public/resources/css/home.css">
</head>
<body>
    
</body>
</html>
