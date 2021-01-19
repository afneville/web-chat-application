<?php
    
require 'oop.php';
require 'mdb_connection.php';
$mdb = mdb_connect();
session_start();
$current_user = $_SESSION['object'];
//$current_user->create_chat_room("test5", "");
//$current_user->create_chat_room("test6", "");
//$current_user->create_chat_room("test7", "");
//$current_user->create_chat_room("test8", "");
//var_dump($chat_rooms);
//$current_user->create_chat_room("test", "1234");
$current_user->send_message("5", "I logged in");
//$current_user->send_message("2", "hello?");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="stylesheet.css">
    <script src="gui.js"></script>
</head>
<body>
    
<div class="tab">
<?php

$chat_rooms = $current_user->get_chat_rooms();
for ($i = 0; $i < count($chat_rooms); $i++) {

    $name = $chat_rooms[$i]->get_name();
    echo "<button class=\"tablinks\" onclick=\"open_pane(event, '$i')\">$name</button>";

}
    
?>
</div>
<?php

for ($i = 0; $i < count($chat_rooms); $i++) {

    $name = $chat_rooms[$i]->get_name();
    echo "<div id=\"$i\" class=\"tabcontent\">";
    echo var_dump($chat_rooms[$i]->get_messages());

}
?>

</body>
</html>
