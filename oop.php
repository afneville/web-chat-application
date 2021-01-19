<?php

class User {
    
    private $id;

    function __construct($id) {

        $this->id = $id;
    }

    function get_username() {
        
        $mdb = $GLOBALS["mdb"];
        $query = "SELECT username FROM user WHERE id='$this->id'";
        $record = ($mdb->query($query))->fetch_assoc();
        return $record["username"];
        
    }

    function get_id() {
        
        return $this->id;
    }
    function get_chat_rooms() {

        $mdb = $GLOBALS["mdb"];
        $chat_rooms= array();
        $query = "SELECT chat_room_id FROM chat_user WHERE user_id='$this->id'";
        $result = $mdb->query($query);
        if ($result->num_rows > 0 ) {

            while ($record = $result->fetch_assoc()) {

                $current_id = $record["chat_room_id"];
                $index = new Chat($current_id);
                array_push($chat_rooms, $index);

            }

        }

        return $chat_rooms; 

    }

    function send_message($chat_room_id, $message_text) {

        $query = "INSERT INTO message (owner_id, chat_room_id, message_text) VALUES ('$this->id', '$chat_room_id', '$message_text')";
        $mdb = $GLOBALS["mdb"];
        $mdb->query($query);

    }

    function create_chat_room($chat_room_name, $pin) {

        $mdb = $GLOBALS["mdb"];
        $query = "INSERT INTO chat_room (name, pin) VALUES ('$chat_room_name', '$pin')";
        $mdb->query($query);
        $chat_room_id = $mdb->insert_id;
        $query = "INSERT INTO chat_user (user_id, chat_room_id, privileges) VALUES ('$this->id', '$chat_room_id', '3')";
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

    function __construct($id) {

        $this->id = $id;

    }
    function get_messages() {

        $mdb = $GLOBALS["mdb"];
        $messages = array();
        $query = "SELECT id FROM message WHERE chat_room_id='$this->id'";
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
        $query = "SELECT owner_id FROM message WHERE id='$this->id'";
        $record = ($mdb->query($query))->fetch_assoc();
        return $record["owner_id"];
    }

    function get_time_stamp() {

        $mdb = $GLOBALS["mdb"];
        $query = "SELECT time_stamp FROM message WHERE id='$this->id'";
        $record = ($mdb->query($query))->fetch_assoc();
        return $record["time_stamp"];

    }
}

?>
