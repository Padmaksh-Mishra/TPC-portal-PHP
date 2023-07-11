<?php
// Get email and token from form data
session_start();

$email = $_POST['email'];
$token = $_POST['token'];

// Connect to the database (replace with your own database credentials)
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "TPC";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the verification token and verification status from the database
$sql = "SELECT * FROM alumni_login WHERE email = '$email'";
$result = $conn->query($sql);
// Check if email exists in the database
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $verificationToken = $row['verification_token'];
    $verify = password_verify($token, $verificationToken);
    $verificationStatus = $row['verified'];
    // $hashedtoken = password_hash($token, PASSWORD_DEFAULT);
    // echo "</br>";
    // echo $verificationToken;
    // echo "</br>";
    // echo $verificationStatus;
    // echo "</br>";
    // echo $hashedtoken;
    // echo "</br>";
    // echo $token;
    // echo "</br>";
    // echo $verify;
    // echo "</br>";
    // Check if the verification token matches
    if ($verify){
        // Update the verification status to 1
        $updateSql = "UPDATE alumni_login SET verified = 1 WHERE email='$email'";
        if ($conn->query($updateSql) === TRUE) {
            echo '<script type="text/javascript">alert("Verification Succesful. You can login now.")</script>';
            echo '<script language="javascript">window.location = "http://localhost/MiniProject/Alumni_Login.html";</script>';
        } else {
            echo "Error updating verification status: " . $conn->error; // Error message
        }
    } else {
        echo "Incorrect token. Please try again."; // Incorrect token message
    }
} else {
    echo "Email not found. Please try again."; // Email not found message
}

$conn->close();
?>
