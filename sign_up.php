<?php

  require 'mdb_connection.php';
  require 'oop.php';
  $mdb = mdb_connect();

  $username = $password = $username_error = $password_error = "";
  $success = true;

  function validate($data){
    
    $test = htmlspecialchars($data);
    $test = trim(stripslashes($test));
    if ($test != $data) {

      $data = "";

    }
    return $data;
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $Submission = $_POST["Submission"];

    $username = validate(htmlentities($_POST["username"]));
    $password = validate(htmlentities($_POST["password"]));
    if (strlen($username) == 0) {
    
      $username_error = "Invalid username";
      $success = false;
      
    }
    if (strlen($password) == 0) {

      $password_error = "Invalid password";
      $success = false;

    }

    if ($success) {


      $query = "SELECT id from user WHERE username = '$username'";
      $result = $mdb->query($query);
      if ($result->num_rows > 0) {
        
        $username_error = "username already taken";
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
        $current_user = new User("$username", "$id");
        $_SESSION['object'] = $current_user;
        header ("Location: home.php");
        exit;
    }
  }
  mdb_disconnect($mdb);

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="stylesheet.css">
</head>

<body>
        <div id="loginbox">
                <h1>Sign up: </h1>
                <p class="error">* required fields</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">

                        <input type="text" name="username" placeholder="Username"><span class="error"> * <?php echo $username_error;?></span></br>
                        <input type="text" name="password" placeholder="Password"><span class="error"> * <?php echo $password_error;?></span></br>
                        <input type="submit" value="sign up">

                </form>
        </div>
</body>
</html>
