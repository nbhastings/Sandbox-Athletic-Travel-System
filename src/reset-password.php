<?php require "header.php"; ?>
<div class="login-card">
	<div class="desktop-login-logo-container"><div class="desktop-database-name">Milligan Athlete Travel Database</div><a href="index.php"><img id="mobilelogo" src="images/logo.png"></a></div>
	<p>An email will be sent to you with instructions on how to reset your password.</p>
	<form action="includes/reset-request.inc.php" method="post">
		<input type="text" name="email" placeholder="Enter your email address...">
		<a class="return" href="index.php">Back</a>
		<button id="reset-submit" type="submit" name="reset-request-submit">Submit</button>
	</form>
	<?php
		if (isset($_GET["reset"])) {
			if ($_GET["reset"] == "success") {
				echo '<p class="signupsuccess">Check your e-mail!</p>';
			}
		}
	?>
</div>
<?php require "footer.php"; ?>