<?php
  require 'mdb_connection.php';
  require 'oop.php';
  $mdb = mdb_connect();

  $username = $password = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = htmlentities($_POST["username"]);
    $password = htmlentities($_POST["password"]);
    $query = "SELECT id, salt, password FROM user WHERE username = '$username'";
    $result = $mdb->query($query);
    if ($result->num_rows > 0) {

        $record = $result->fetch_assoc();
        $hash = hash('sha256', $password.$record["salt"]);

        if ($hash == $record["password"]) {

            session_start();
            $id = $record["id"];
            $current_user = new User("$id");
            $_SESSION["object"] = $current_user;
            header ("Location: home.php");
            exit;

        }

    }
    $result->close();
    $error = "Username or Password incorrect";
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
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">

                        <span class ="error"><?php echo "$error"; ?></span><br>
                        <input type="text" name="username" placeholder="Username"><br>
                        <input type="text" name="password" placeholder="Password"><br>
                        <input type="submit" value="login">

                </form>
        </div>
</body>
</html
