<?php

class User {
    
    private $username;
    private $id;
    private $chat_rooms = array();

    function __construct($id) {

        $this->id = $id;
        $query = "SELECT username FROM user WHERE id='$this->id'";
        $mdb = $GLOBALS["mdb"];
        $result = $mdb->query($query);
        $record = $result->fetch_assoc();
        $this->username = $record["username"];
        $query = "SELECT chat_room_id FROM chat_user WHERE user_id='$this->id'";
        $result = $mdb->query($query);
        if ($result->num_rows > 0 ) {

            while ($record = $result->fetch_assoc()) {

                $current_id = $record["chat_room_id"];
                $index = new Chat($current_id);
                array_push($this->chat_rooms, $index);

            }
        }


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
        $id = $mdb->insert_id;
        $query = "INSERT INTO chat_user (user_id, chat_room_id, priviliges) VALUES ('$this->id', '$id', '3')";
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

    function get_chat_rooms() {

        return $this->chat_rooms;
    }

}

class Chat {

    private $id;
    private $chat_room_name;
    private $messages = array();
    private $members = array();

    function __construct($id) {

        $this->id = $id;
        $mdb = $GLOBALS["mdb"];
        $query = "SELECT name FROM chat_room WHERE id='$this->id'";
        $result = $mdb->query($query);
        $record = $result->fetch_assoc();
        $this->chat_room_name = $record["name"];
        $query = "SELECT id FROM message WHERE chat_room_id='$this->id'";
        $result = $mdb->query($query);
        if ($result->num_rows > 0 ) {

            while ($record = $result->fetch_assoc()) {

                $index = new Message($record["id"]);
                array_push($this->messages, $index);

            }
            

        }
    }
    function get_messages() {

        return $this->messages;
        
    }
    function get_name() {

        return $this->chat_room_name;
    }
    function get_members() {

        $query = "SELECT username FROM user WHERE id IN (SELECT user_id FROM chat_user WHERE chat_room_id='$this->id')";
        $mdb = $GLOBALS["mdb"];
        $mdb->query($query);
    }

}
class Message {

    private $id;
    private $message_text;
    private $time_stamp;

    function __construct($id) {

        $this->id = $id;
        $mdb = $GLOBALS["mdb"];
        $query = "SELECT message_text, time_stamp FROM message WHERE id='$this->id'";
        $result = $mdb->query($query);
        $record = $result->fetch_assoc();
        $this->message_text = $record["message_text"];
        $this->time_stamp = $record["time_stamp"];

    }

    function get_text() {

        return $this->message_text;

    }
    function get_time_stamp() {

        return $this->time_stamp;

    }
}

?>
