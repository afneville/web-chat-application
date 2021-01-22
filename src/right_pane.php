<?php

$current_user = $GLOBALS["current_user"];
$chat_rooms = $current_user->get_chat_rooms();

for ($i = 0; $i < count($chat_rooms); $i++) {

    echo "<div id=\"$i\" class=\"right\">";
    echo "<div class=\"messages\">";
    //echo var_dump($chat_rooms[$i]->get_messages());
    $messages = $chat_rooms[$i]->get_messages();
    for ($x = 0; $x < count($messages); $x++) {

        $message = $messages[$x];
        echo "<p class=\"message_info\">".$message->get_owner()." ".$message->get_time_stamp()."</p>";
        echo "<p class=\"message_text\">".$message->get_text()."</p>";

    }
    echo "</div>";
    echo "<div class=\"new\">";
    echo "<input type=\"text\"></input>";
    echo "<button class=\"send\">send</button>";
    echo "</div>";
    echo "</div>";

}
?>
