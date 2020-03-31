<?php require "header.php"; ?>
<?php
	$selector = $_GET["selector"];
	$validator = $_GET["validator"];
	
	if (empty($selector) || empty($validator)) {
		echo "Could not validate your request!";
	} else {
		if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {
			?>
			
			<form action="includes/verify-account.inc.php" method="post">
				<input type="hidden" name="selector" value="<?php echo $selector ?>">
				<input type="hidden" name="validator" value="<?php echo $validator ?>">
				<button type="submit" name="verify-account-submit">Verify Account</button>
			</form>
			
			<?php
		}
	}
	
?>
<?php require "footer.php"; ?>