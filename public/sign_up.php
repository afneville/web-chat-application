<!DOCTYPE html>
<?php

require "../src/top_bar.php";
require "../src/oop.php";
require "../src/mdb_connection.php";
require "../src/sign_up_backend.php";

$username = $password = $username_error = $password_error = "";
$success = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $password = $_POST["password"];
    $mdb = mdb_connect();
    $success = do_the_sign_up("$username", "$password");
    if ($success) {

        header("Location: home.php");
        exit;
    }
}


?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="/php_chatter/public/resources/css/stylesheet.css">
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
