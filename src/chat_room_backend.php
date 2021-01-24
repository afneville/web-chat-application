<?php

function render_message($message){

    echo "<p class=\"message_info\">".$message->get_owner()." ".$message->get_time_stamp()."</p>";
    echo "<p class=\"message_text\">".$message->get_text()."</p>";
    
}
function render_chat($messages) {

    
    for ($x = count($messages) -1; $x >= 0; $x--) {

        render_message($messages[$x]);

    }
}

function render_room($chat_room) {

    $current_room = $chat_room->get_id();
    echo "<div id=\"$current_room\" class=\"right\">";
    echo "<div class=\"messages\">";
    $messages = $chat_room->get_messages();
    render_chat($messages);
    echo "</div>";
    echo "<div class=\"new\">";
    echo "<input type=\"text\">";
    echo "<button onclick=\"send_message_ajax($current_room)\">send</button>";
    $pin = $chat_room->get_pin();
    echo "<button class=\"info\" onclick=\"alert('ID: $current_room PIN: $pin')\">:</button>";
    echo "</div>";
    echo "</div>";
}

?>
