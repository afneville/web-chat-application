<?php

function render_tab($chat_room) {
    
    $name = $chat_room->get_name();
    $current_room = $chat_room->get_id();
    echo "<button class=\"tablinks\" onclick=\"open_pane('$current_room', event)\">$name</button>";

}


?>
