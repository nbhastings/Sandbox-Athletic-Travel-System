<?php require "header.php"; ?>
<div class="login-card">
<div class="desktop-login-logo-container">
</div>
	<form action="includes/change-password.inc.php" method="post">
		<input type="hidden" name="userEmail" value="<?php echo $_SESSION['userUid'] ?>">
		<input type="password" name="oldpwd" placeholder="Enter current password...">
		<input type="password" name="pwd" placeholder="Enter new password...">
		<input type="password" name="pwd-repeat" placeholder="Repeat new password...">
		<button type="submit" name="change-password-submit">Change Password</button>
	</form>
</div>
<?php require "footer.php"; ?>