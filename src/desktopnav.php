	<div class="nav-bar-spacer"></div>
	<div id="desktopnav">
		<?php if (isset($_SESSION['userId'])) {
			echo '<form action="includes/logout.inc.php" method="post"><button type="submit" name="logout-submit">Logout</button></form>';
		} else {
			echo '<a href="index.php"><li>Login</li></a>';
		}?>
		<?php if (basename($_SERVER['SCRIPT_NAME']) == 'change-password.php') {
			echo '<a href="change-password.php" class="active">Change Password</a>';
		} else {
			echo '<a href="change-password.php" class="">Change Password</a>';
		}?>
		<?php if (basename($_SERVER['SCRIPT_NAME']) == 'index.php') {
			echo '<a href="index.php" class="active">Home</a>';
		} else {
			echo '<a href="index.php" class="">Home</a>';
		}?>
	</div>
	<div class="desktop-logo">
		<a href="index.php"><img id="desktoplogo" src="images/logo.png"></a>
	</div>