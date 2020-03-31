<?php
	if (!isset($_SESSION['userId'])) {
		echo '<div id="forgotpasswordlink"><a href="reset-password.php">Forgot your password?</a></div>';
	}
?>