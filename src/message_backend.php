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


?>
