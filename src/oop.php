<?php

class User {
    
    private $id;
    private $mdb;

    function __construct($id) {

        $this->id = $id;
        $this->mdb = $GLOBALS["mdb"];
    }

    function get_username() {
        
        $query = "SELECT username FROM user WHERE id='$this->id'";
        $record = ($this->mdb->query($query))->fetch_assoc();
        return $record["username"];
        
    }

    function get_id() {
        
        return $this->id;
    }
    function get_chat_rooms() {

        $chat_rooms= array();
        $query = "SELECT chat_room_id FROM chat_user WHERE user_id='$this->id'";
        $result = $this->mdb->query($query);
        if ($result->num_rows > 0 ) {

            while ($record = $result->fetch_assoc()) {

                $current_id = $record["chat_room_id"];
                $index = new Chat($current_id);
                array_push($chat_rooms, $index);

            }

        }

        return $chat_rooms; 

    }

    function send_message($chat_room_id, $message_text, $timestamp) {

        $query = "INSERT INTO message (owner_id, chat_room_id, message_text, time_stamp) VALUES ('$this->id', '$chat_room_id', '$message_text', '$timestamp')";
        $this->mdb->query($query);

    }

    function create_chat_room($chat_room_name, $pin) {

        $query = "INSERT INTO chat_room (name, pin) VALUES ('$chat_room_name', '$pin')";
        $this->mdb->query($query);
        $chat_room_id = $this->mdb->insert_id;
        $query = "INSERT INTO chat_user (user_id, chat_room_id, privileges) VALUES ('$this->id', '$chat_room_id', '3')";
        $this->mdb->query($query);
        return $chat_room_id;

    } 

    function join_chat_room($chat_room_id, $pin) {
        
        $return_value = false;
        $query = "SELECT pin FROM chat_room WHERE id='$chat_room_id'";
        $result = $this->mdb->query($query);
        if ($result->num_rows > 0){

            $record = $result->fetch_assoc();
            if ($record["pin"] == $pin){

                $query = "INSERT INTO chat_user (user_id, chat_room_id) VALUES ('$this->id', '$chat_room_id')";
                $this->mdb->query($query);
                $return_value = true;
            }

        }

        return $return_value;

    }
    function set_last_online($chat_room_id, $timestamp) {

        $query = "UPDATE chat_user SET last_online='$timestamp' WHERE user_id='$this->id' AND chat_room_id='$chat_room_id'";
        $this->mdb->query($query);

    }
    function get_last_online($chat_room_id) {

        $query = "SELECT last_online FROM chat_user WHERE user_id='$this->id' AND chat_room_id='$chat_room_id'";
        $record = ($this->mdb->query($query))->fetch_assoc();
        return $record["last_online"];

    }

}

class Chat {

    private $id;

    function __construct($id) {

        $this->id = $id;

    }
    function get_messages($timestamp = null) {

        $mdb = $GLOBALS["mdb"];
        $messages = array();
        if ($timestamp == null){
            
            $query = "SELECT id FROM message WHERE chat_room_id='$this->id' ORDER BY time_stamp DESC LIMIT 100";

        } else {

            $query = "SELECT id FROM message WHERE chat_room_id='$this->id' AND time_stamp>='$timestamp' ORDER BY time_stamp DESC";

        }
        $result = $mdb->query($query);
        if ($result->num_rows > 0) {

            while ($record = $result->fetch_assoc()) {

                $index = new Message($record["id"]);
                array_push($messages, $index);

            }

        }
        return $messages;
        
    }

    function get_name() {

        $mdb = $GLOBALS["mdb"];
        $query = "SELECT name FROM chat_room WHERE id='$this->id'";
        $record = ($mdb->query($query))->fetch_assoc();
        return $record["name"];

    }

    function get_id() {

        return $this->id;
    
    }

    function get_pin() {

        $mdb = $GLOBALS["mdb"];
        $query = "SELECT pin FROM chat_room WHERE id='$this->id'";
        $record = ($mdb->query($query))->fetch_assoc();
        return $record["pin"];

    }

    function get_members() {

        $mdb = $GLOBALS["mdb"];
        $query = "SELECT id FROM user WHERE id IN (SELECT user_id FROM chat_user WHERE chat_room_id='$this->id')";
        $members = array();
        $result = $mdb->query($query);
        while ($record = $result->fetch_assoc()) {

            $index = new User($record["id"]);
            array_push($members, $index);

        }
        return $members;
    }

}
class Message {

    private $id;

    function __construct($id) {

        $this->id = $id;

    }

    function get_text() {

        $mdb = $GLOBALS["mdb"];
        $query = "SELECT message_text FROM message WHERE id='$this->id'";
        $record = ($mdb->query($query))->fetch_assoc();
        return $record["message_text"];

    }

    function get_owner() {

        $mdb = $GLOBALS["mdb"];
        $query = "SELECT username FROM user WHERE id IN (SELECT owner_id FROM message WHERE id='$this->id')";
        $record = ($mdb->query($query))->fetch_assoc();
        return $record["username"];
    }

    function get_time_stamp() {

        $mdb = $GLOBALS["mdb"];
        $query = "SELECT time_stamp FROM message WHERE id='$this->id'";
        $record = ($mdb->query($query))->fetch_assoc();
        return $record["time_stamp"];

    }
}

?>
