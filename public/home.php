<?php
    
require '../src/oop.php';
require '../src/mdb_connection.php';

$mdb = mdb_connect();
session_start();
if (!isset($_SESSION['id'])){

    if(!isset($_COOKIE["user"])) {

        header ("Location: index.html");
        exit;

    } else {

        $id = $_COOKIE["user"];
        $current_user = new User("$id");
        
    }
} else {

    $current_user = new User($_SESSION["id"]);
    $_SESSION["id"] = $current_user->get_id();
}
//$current_user->create_chat_room("test_1", "");
//$current_user->send_message("1", "I logged in.");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="resources/css/home.css">

</head>
<body>
<?php

require "../templates/top_bar.php";
require "../templates/left_pane.php";
require "../templates/right_pane.php";

?>

<script src="resources/js/home.js"></script>
<script src="resources/js/ajax.js"></script>
</body>
</html>
