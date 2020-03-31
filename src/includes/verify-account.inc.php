<?php

if (isset($_POST["verify-account-submit"])) {
	
	$selector = $_POST["selector"];
	$validator = $_POST["validator"];
	
	require 'dbh.inc.php';
	
	$sql = "SELECT * FROM VerifyAccount WHERE VerificationSelector = ?";
	
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		echo "There was an error!";
		exit();
	} else {
		mysqli_stmt_bind_param($stmt, "s", $selector);
		mysqli_stmt_execute($stmt);
		
		$result = mysqli_stmt_get_result($stmt);
		if (!$row = mysqli_fetch_assoc($result)) {
			echo "You need to resubmit your reset request.";
			exit();
		} else {
			$tokenBin = hex2bin($validator);
			$tokenCheck = password_verify($tokenBin, $row["VerificationToken"]);
			
			if ($tokenCheck === false) {
				echo "You need to resubmit your reset request";
			} else if ($tokenCheck === true) {
				$tokenEmail = $row['AccountVerificationEmail'];
				
				$sql = "SELECT * FROM userstwo WHERE emailUsers = ?;";
				$stmt = mysqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt, $sql)) {
					echo "There was an error!";
					exit();
				} else {
					mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
					mysqli_stmt_execute($stmt);
					$result = mysqli_stmt_get_result($stmt);
					if (!$row = mysqli_fetch_assoc($result)) {
						echo "There was an error!";
						exit();
					} else {
						$sql = "UPDATE userstwo SET verified = '1' WHERE emailUsers = ?";
						$stmt = mysqli_stmt_init($conn);
						if (!mysqli_stmt_prepare($stmt, $sql)) {
							echo "There was an error!";
							exit();
						} else {
							mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
							mysqli_stmt_execute($stmt);
							
							$sql = "DELETE FROM VerifyAccount WHERE AccountVerificationEmail=?";
							$stmt = mysqli_stmt_init($conn);
							if (!mysqli_stmt_prepare($stmt, $sql)) {
								echo "There was an error!";
								exit();
							} else {
								mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
								mysqli_stmt_execute($stmt);
								header("Location: ../index.php?youraccounthasbeenverified");
							}
						}
					}
				}	
			}
		}
	}
} else {
	header("Location: ../index.php");
}