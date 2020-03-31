<?php
if (isset($_POST['signup-submit'])) {
	
	require 'dbh.inc.php';
	
	$email = $_POST['mail'];
	$password = $_POST['pwd'];
	$passwordRepeat = $_POST['pwd-repeat'];
	$domain = explode("@", $email);
	$domain = $domain[(count($domain)-1)];
	$whitelist = array('milligan.edu');
	$selector = bin2hex(random_bytes(8));
	$token = random_bytes(32);
	$url = "http://localhost/Athletic%20Department%20Database/verify-account.php?selector=" . $selector . "&validator=" . bin2hex($token);
	
	if (in_array($domain, $whitelist)) {
		if (empty($email) || empty($password) || empty($passwordRepeat)){
			header("Location: ../signup.php?error=emptyfields&uid=".$username."&mail=".$email);
			exit();
		}
		else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			header("Location: ../signup.php?error=invalidemail");
			exit();
		}
		else if ($password !== $passwordRepeat) {
			header("Location: ../signup.php?error=passwordcheck&uid=".$username."&email=".$email);
			exit();		
		}
		else {
			$sql = "SELECT emailUsers FROM userstwo WHERE emailUsers=?";
			$stmt = mysqli_stmt_init($conn);
			if (!mysqli_stmt_prepare($stmt, $sql)) {
				header("Location: ../signup.php?error=sqlerror");
				exit();
			}
			else {
				mysqli_stmt_bind_param($stmt, "s", $email);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
				$resultCheck = mysqli_stmt_num_rows($stmt);
				if ($resultCheck > 0) {
					header("Location: ../signup.php?error=emailalreadyregistered");
					exit();
				}
				else {
					$sql = "INSERT INTO userstwo (emailUsers, pwdUsers, verified) VALUES (?, ?, '0')";
					$stmt = mysqli_stmt_init($conn);
					if (!mysqli_stmt_prepare($stmt, $sql)) {
						header("Location: ../signup.php?error=sqlerror");
						exit();
					}
					else {
						$hashedPwd = password_hash($password, PASSWORD_DEFAULT);
						mysqli_stmt_bind_param($stmt, "ss", $email, $hashedPwd);
						mysqli_stmt_execute($stmt);
					}
					$stmt = mysqli_stmt_init($conn);
					if (!mysqli_stmt_prepare($stmt, $sql)) {
						echo "There was an error!";
						exit();
					} 
					$sql = "INSERT INTO VerifyAccount (AccountVerificationEmail, VerificationSelector, VerificationToken) VALUES (?, ?, ?);";
					$stmt = mysqli_stmt_init($conn);
					if (!mysqli_stmt_prepare($stmt, $sql)) {
						echo "There was an error!";
					} else {
						$hashedToken = password_hash($token, PASSWORD_DEFAULT);
						mysqli_stmt_bind_param($stmt, "sss", $email, $selector, $hashedToken);
						mysqli_stmt_execute($stmt);
					}
					mysqli_stmt_close($stmt);
					mysqli_close($conn);
			
					$to = $email;
					$subject = 'Verify Your Account for the Milligan Travel Database';
					$message = '<p>Thank you for signing up for the Milligan Travel Database. Before you can login and access the database, you need to verify your account using the link below.</p>';
					$message .= '<p>Here is the link to verify your account: <br>';
					$message .= '<a href="' . $url . '">' . $url . '</a></p>';
					
					$headers = "From: Milligan Travel Database <milligantraveldatabase@gmail.com>\r\n";
					$headers .= "Reply-To: milligantraveldatabase@gmail.com\r\n";
					$headers .= "Content-type: text/html\r\n";
					
					mail($to, $subject, $message, $headers);
					
					header("Location: ../signup.php?signup=success");
					exit();
				}					
			}
		}
	}
	else {
		header("Location: ../signup.php?error?musthavemilliganemail");
		exit();
	}
} else {
	header("Location: ../signup.php?error");
	exit();
}