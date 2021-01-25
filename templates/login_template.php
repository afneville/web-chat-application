<div id="loginbox">
<h1>Login: </h1>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">

<span class ="error"><?php echo "$error"; ?></span><br>
<input type="text" name="username" placeholder="Username"><br>
<input type="text" name="password" placeholder="Password"><br>
<input type="submit" value="login">
<br>
<br>
<a href="sign_up.php">sign up</a>


</form>
</div>
