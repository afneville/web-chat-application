<?php

require "../src/top_bar.php";
require "../src/oop.php";
require "../src/mdb_connection.php";
require "../src/login_backend.php";
$mdb = mdb_connect();
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $password = $_POST["password"];
    $error = do_the_login("$username", "$password");
    if ($error == "") {
        
        header ("Location: home.php");
        exit;

    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="/php_chatter/public/resources/css/stylesheet.css">
</head>

<body>
        <div id="loginbox">
                <h1>Login: </h1>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">

                        <span class ="error"><?php echo "$error"; ?></span><br>
                        <input type="text" name="username" placeholder="Username"><br>
                        <input type="text" name="password" placeholder="Password"><br>
                        <input type="submit" value="login">

                </form>
        </div>
</body>
</html
