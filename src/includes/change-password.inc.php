<?php

if (isset($_POST['change-password-submit'])) {
	
	$email = $_POST['userEmail'];
	$oldpassword = $_POST['oldpwd'];
	$password = $_POST['pwd'];
	$passwordRepeat = $_POST['pwd-repeat'];
	
	if (empty($oldpassword) || empty($password) || empty($passwordRepeat)) {
		header("Location: ../change-password.php?error=emptyfields");
		exit();
	} else if ($password !== $passwordRepeat) {
		header("Location: ../change-password.php?error=passwordsdidnotmatch");
		exit();
	}
	
	require 'dbh.inc.php';
	
	$sql = "SELECT * FROM userstwo WHERE emailUsers = ?";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("Location: ../change-password.php?error=sqlerror");
		exit();
	} else {
		mysqli_stmt_bind_param($stmt, "s", $email);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		if ($row = mysqli_fetch_assoc($result)) {
			$pwdCheck = password_verify($oldpassword, $row['pwdUsers']);
			if ($pwdCheck == false) {
				header("Location: ../index.php?error=wrongpassword");
				exit();
			} else if ($pwdCheck == true) {
				$sql = "UPDATE userstwo SET pwdUsers = ? WHERE emailUsers = ?";
				$stmt = mysqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt, $sql)) {
					echo "There was an error!";
					exit();
				} else {
					$newPwdHash = password_hash($password, PASSWORD_DEFAULT);
					mysqli_stmt_bind_param($stmt, "ss", $newPwdHash, $email);
					mysqli_stmt_execute($stmt);	
					header("Location: ../index.php?yourpasswordhasbeensuccessfullychanged");
				}
			}
		}
	}
} else {
	header("Location: ../change-password.php?error");
}