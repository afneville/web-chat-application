<div class="left">
<div class="tab_area">
<?php
$current_user = $GLOBALS["current_user"];
$chat_rooms = $current_user->get_chat_rooms();
for ($i = 0; $i < count($chat_rooms); $i++) {

    $name = $chat_rooms[$i]->get_name();
    echo "<button class=\"tablinks\" onclick=\"open_pane(event, '$i')\">$name</button>";

}
    
?>
</div>
<div class="chat_menu">
<button>Join</button>
<button>Create</button>
</div>
</div>