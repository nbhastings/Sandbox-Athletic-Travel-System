<?php require "header.php"; ?>
<?php
	if (isset($_GET["newpwd"])) {
		if ($_GET["newpwd"] == "passwordupdated") {
			echo '<p class="signupsuccess">Your password has been reset!</p>';
		}
	}
	if (isset($_SESSION['userId'])) {
		require "database-display.php";
		echo '<div id="login-indication"><p>You\'re logged in, ', $_SESSION['userUid'], '!</p></div>', '<br>', '<div class="logout-button-form"><form action="includes/logout.inc.php" method="post">
		<button type="submit" name="logout-submit">Logout</button>
		</form></div>';
	}
	else {
		echo '<div class="login-card"><div class="desktop-login-logo-container"><div class="desktop-database-name">Milligan Athlete Travel Database</div><a href="index.php"><img id="mobilelogo" src="images/logo.png"></a></div><form action="includes/login2.inc.php" method="post">
		<input type="text" name="mailuid" placeholder="Milligan Email...">
		<input type="password" name="pwd" placeholder="Password...">
		<button type="submit" name="login-submit">Login</button>
		<a class="signup" href="signup.php">Signup</a>
		</form></div>';
	}
?>
<?php require "forgotpasswordlink.php"; ?>
<?php require "footer.php"; ?>