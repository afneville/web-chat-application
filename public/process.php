<?php

require '../src/oop.php';
require '../src/mdb_connection.php';
require '../src/chat_room_backend.php';
require '../src/tab_backend.php';

$mdb = mdb_connect();

session_start();
$current_user = new User($_SESSION["id"]);

if (isset($_POST["send"])) {

    $data = explode("###", $_POST["send"]);
    $timestamp = date("Y-m-d H:i:s");
    $current_user->send_message($data[0], $data[1], $timestamp);
    $current_user->set_last_online($data[0], $timestamp);

}
if (isset($_POST["fetch"])) {

    $chat_room_id = $_POST["fetch"];
    $chat_room = new Chat($chat_room_id);
    $last_online = $current_user->get_last_online($chat_room_id);
    $messages = $chat_room->get_messages($last_online);
    render_chat($messages);
    while ($last_online == date("Y-m-d H:i:s")) {}
    $timestamp = date("Y-m-d H:i:s");
    $current_user->set_last_online($chat_room_id, $timestamp);

}

if (isset($_POST["create"])) {

    $data = explode("###", $_POST["create"]);
    $chat_room_id = $current_user->create_chat_room($data[0], $data[1]);
    $chat_room = new Chat($chat_room_id);
    render_room($chat_room);
    echo "###";
    render_tab($chat_room);


}

if (isset($_POST["join"])) {

    $data = explode("###", $_POST["join"]);
    $success = $current_user->join_chat_room($data[0], $data[1]);
    if ($success) {

        $chat_room = new Chat($data[0]);
        render_room($chat_room);
        echo "###";
        render_tab($chat_room);
        
    } else {

        echo "0";
    }

}
?>
