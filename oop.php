<?php

class User {
    
    private $username;
    private $id;

    function __construct($username, $id) {

        $this->username = $username;
        $this->id = $id;

    }

    function get_username() {
        
        return $this->username;
        
    }

    function get_id() {
        
        return $this->id;
    }

    function send_message($chat_room_id, $message_text) {

        $query = "INSERT INTO message (owner_id, chat_room_id, message_text) VALUES ('$this->id', '$chat_room_id', '$message_text')";
        $mdb = $GLOBALS["mdb"];
        $mdb->query($query);

    }
    function create_chat_room($chat_room_name, $pin) {

        $query = "INSERT INTO chat_room (name, pin) VALUES ('$chat_room_name', '$pin')";
        $mdb = $GLOBALS["mdb"];
        $mdb->query($query);
        $id = $this->mdb->insert_id;
        $query = "INSERT INTO chat_user (user_id, chat_room_id, approved, chat_owner, chat_admin) VALUES ('$this->id', '$id', '1', '1', '1')";
        $mdb->query($query);
    } 

}

class Chat {

    private $id;
    private $name;

    function __construct($id) {

        $this->id = $id;
        

    }
}

?>
