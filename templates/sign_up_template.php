<div id="loginbox">
<h1>Sign up: </h1>
<p class="error">* required fields</p>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">

<input type="text" name="username" placeholder="Username"><span class="error"> * <?php echo $username_error;?></span></br>
<input type="text" name="password" placeholder="Password"><span class="error"> * <?php echo $password_error;?></span></br>
<input type="submit" value="sign up">

</form>
</div>
