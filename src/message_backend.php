<?php

function render_message($message){

    echo "<p class=\"message_info\">".$message->get_owner()." ".$message->get_time_stamp()."</p>";
    echo "<p class=\"message_text\">".$message->get_text()."</p>";
    
}


?>
