<div class="left">
<div class="tab_area">
<?php
$current_user = $GLOBALS["current_user"];
$chat_rooms = $current_user->get_chat_rooms();
for ($i = 0; $i < count($chat_rooms); $i++) {

    render_tab($chat_rooms[$i]);

}
    
?>
</div>
<div class="chat_menu">
    <input class="room" type="text" placeholder="chat id / new name"><br>
    <input class="room" type="text" placeholder="pin"><br>
    <button class="room" onclick="join_chat_room()">Join</button>
    <button class="room" onclick="create_chat_room()">Create</button>
</div>
</div>
