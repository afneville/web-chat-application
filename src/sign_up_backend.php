<?php

function validate($data){
    
    $test = htmlspecialchars($data);
    $test = trim(stripslashes($test));
    if ($test != $data) {

      $data = "";

    }
    return $data;
}

function do_the_sign_up($username, $password){

    $username = validate(htmlentities($username));
    $password = validate(htmlentities($password));
    $success = true;
    if (strlen($username) == 0) {
    
      $GLOBALS["username_error"] = "Invalid username";
      $success = false;
      
    }
    if (strlen($password) == 0) {

      $GLOBALS["password_error"] = "Invalid password";
      $success = false;

    }

    if ($success) {


      $query = "SELECT id from user WHERE username = '$username'";
      $mdb = $GLOBALS["mdb"];
      $result = $mdb->query($query);
      if ($result->num_rows > 0) {
        
        $GLOBALS["username_error"] = "username already taken";
        $success = false;
      } 
      $result->close();

    }


    if ($success) {

        session_start();
        $salt = rand();
        $hash = hash('sha256', $password.$salt);
        $query = "INSERT INTO user (username, password, salt) VALUES ('$username', '$hash', '$salt')";
        $mdb->query($query);
        $id = $mdb->insert_id;
        $_SESSION['id'] = $id;

    }

    return $success;
}

?>
