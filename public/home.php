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
//$current_user->create_chat_room("test_1", "");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="resources/css/home.css">
    <script>src="resources/js/gui.js"</script>

</head>
<body>
<?php

require "../src/top_bar.php";
require "../src/left_pane.php";
require "../src/right_pane.php";

?>
</body>
</html>
