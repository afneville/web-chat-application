<?php

$current_user = $GLOBALS["current_user"];
$chat_rooms = $current_user->get_chat_rooms();

for ($i = 0; $i < count($chat_rooms); $i++) {

    render_room($chat_rooms[$i]);

}
?>
