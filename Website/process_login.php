<?php

require 'config.php';
session_start();


// Get email and password from the login form
$email = $_POST['email'];
$password = $_POST['password'];

// Query to check if email exists in the database
$sql = "SELECT * FROM student_login WHERE email='$email'";
$result = mysqli_query($conn, $sql);

// Check if email exists
if (mysqli_num_rows($result) == 1) {
	// Email exists, check if password is correct
	$row = mysqli_fetch_assoc($result);
	if (password_verify($password, $row['password'])) {
		// Password is correct, check if email is verified
		if ($row['verified'] == 1) {
			// Email is verified, set session variables and redirect to dashboard
			$_SESSION['logged_in'] = 1;
			$_SESSION['roll_number'] = $row['roll_number'];
			header("Location: student_dashboard.php");
			exit();
		} else {
			// Email is not verified, display error message
			echo "<script>alert('Please verify your email before logging in.')</script>";
			echo "<script>window.location='student_login.html'</script>";
			exit();
		}
	} else {
		// Password is incorrect, display error message
		echo "<script>alert('Invalid email or password.')</script>";
		echo "<script>window.location='student_login.html'</script>";
		exit();
	}
} else {
	// Email does not exist, display error message
	echo "<script>alert('Invalid email or password.')</script>";
	echo "<script>window.location = 'student_login.html'</script>";
	exit();
}
?>
