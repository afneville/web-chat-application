<?php

require '../src/oop.php';
require '../src/message_backend.php';
require '../src/mdb_connection.php';

$mdb = mdb_connect();

session_start();
$current_user = new User($_SESSION["id"]);

if (isset($_POST["send"])) {

    $data = explode(",", $_POST["send"]);
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


}

if (isset($_POST["join"])) {


}
?>
