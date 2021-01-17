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
    function join_chat_room($chat_room_id, $pin) {
        
        $return_value = false;
        $query = "SELECT pin FROM chat_room WHERE id='$chat_room_id'";
        $mdb = $GLOBALS["mdb"];
        $result = $mdb->query($query);
        if ($result->num_rows > 0){

            $record = $result->fetch_assoc();
            if ($record["pin"] == $pin){

                $query = "INSERT INTO chat_user (user_id, chat_room_id) VALUES ('$this->id', '$chat_room_id')";
                $mdb->query($query);
                $return_value = true;
            }

        }
        return $return_value;
    }

}

class Chat {

    private $id;
    private $chat_room_name;
    private $messages = array();

    function __construct($id) {

        $this->id = $id;
        $mdb = $GLOBALS["mdb"];
        $query = "SELECT name FROM chat_room WHERE id='$this->id'";
        $result = $mdb->query($query);
        $record = $result->fetch_assoc();
        $this->chat_room_name = $record["name"];

    }
    function get_messages() {

        $query = "SELECT owner_id, time_stamp, message_text FROM message WHERE chat_room_id='$this->id'";
        $mdb = $GLOBALS["mdb"];
        $result = $mdb->query($query);
        if ($result->num_rows > 0 ) {

            while ($record = $result->fetch_assoc()) {

                $index = array();
                array_push($index, $record["owner_id"], $record["time_stamp"], $record["message_text"]);
                array_push($this->messages, $index);

            }
            
        }
        
    }
    function get_name() {

        return $this->name;
    }
    function get_members() {

        $query = "SELECT username FROM user WHERE id IN (SELECT user_id FROM chat_user WHERE chat_room_id='1')";
        $mdb = $GLOBALS["mdb"];
        $mdb->query($query);
    }

}

?>
