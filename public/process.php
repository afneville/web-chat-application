<?php
require '../src/oop.php';
require '../src/mdb_connection.php';

$mdb = mdb_connect();

session_start();
if (isset($_POST["send"])) {

    $data = explode(",", $_POST["send"]);
    echo var_dump($data);
    $current_user = new User($_SESSION["id"]);
    $current_user->send_message($data[0], $data[1]);
    echo "$id";
}
if (isset($_POST["fetch"])) {}


?>
