<?php require "header.php"; ?>
	
<div id="signuppage">
	<div class="login-card">
		<div class="desktop-login-logo-container"><div class="desktop-database-name">Milligan Athlete Travel Database</div><a href="index.php"><img id="mobilelogo" src="images/logo.png"></a></div>
		<form class="form-signup" action="includes/signup.inc.php" method="post">
			<input type="text" name="mail" placeholder="Milligan E-mail...">
			<input type="password" name="pwd" placeholder="Password...">
			<input type="password" name="pwd-repeat" placeholder="Repeat Password...">
			<a class="return" href="index.php">Back</a>
			<button type="submit" name="signup-submit">Signup</button>
			
		</form>
	</div>
</div>

<?php require "forgotpasswordlink.php"; ?>

<?php require "footer.php"; ?>