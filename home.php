<?php
    
require 'oop.php';
require 'mdb_connection.php';
$mdb = mdb_connect();
session_start();
$current_user = $_SESSION['object'];
$chat_rooms = $current_user->get_chat_rooms();
//var_dump($chat_rooms);
//$current_user->create_chat_room("test", "1234");
//$current_user->send_message("1", "I logged in");
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
    
<h1>Welcome to your home, <?php echo $current_user->get_username(); ?>.</h1>
<h2>Your id is: <?php echo $current_user->get_id(); ?></h2>
<h2>Your chats are: </h2>
<?php

for ($i = 0; $i < count($chat_rooms); $i++) {

    echo $chat_rooms[$i]->get_name()."</br>";

}
    
?>

<div>
<button class="chat_name" onclick="open_chat_room(event, '')"></button>
<button class="chat_name" onclick="open_chat_room(event, '')"></button>
<button class="chat_name" onclick="open_chat_room(event, '')"></button>
</div>

<div id='' class='chat_pane'></div>




</body>
</html>
