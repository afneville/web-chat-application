<?php

function do_the_login($username, $password) {
    
    $error = "Username or Password incorrect";
    $query = "SELECT id, salt, password FROM user WHERE username = '$username'";
    $mdb = $GLOBALS["mdb"];
    $result = $mdb->query($query);
    if ($result->num_rows > 0) {

        $record = $result->fetch_assoc();
        $hash = hash('sha256', $password.$record["salt"]);

        if ($hash == $record["password"]) {

            $error = "";
            session_start();
            $id = $record["id"];
            setcookie("user", $id);
            $current_user = new User("$id");
            $_SESSION["object"] = $current_user;
            $result->close();
        
        }

    }
    return $error;

}
?>
