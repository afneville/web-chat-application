<?php

require "../src/message_backend.php";

$current_user = $GLOBALS["current_user"];
$chat_rooms = $current_user->get_chat_rooms();

for ($i = 0; $i < count($chat_rooms); $i++) {

    $current_room = $chat_rooms[$i]->get_id();
    echo "<div id=\"$current_room\" class=\"right\">";
    echo "<div class=\"messages\">";
    $messages = $chat_rooms[$i]->get_messages();
    for ($x = count($messages) -1; $x >= 0; $x--) {

        render_message($messages[$x]);

    }
    echo "</div>";
    echo "<div class=\"new\">";
    echo "<input type=\"text\">";
    echo "<button onclick=\"send_message_ajax($current_room)\">send</button>";
    echo "</div>";
    echo "</div>";

}
?>
