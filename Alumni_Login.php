<?php
session_start();

// Retrieve form data
$_SESSION['logged_in'] = true;
$email = $_POST['email'];
$password = $_POST['password'];

// Database connection credentials
$servername = "localhost"; // change to your database server name
$username = "root"; // change to your database username
$password_db = "password"; // change to your database password
$dbname = "TPC"; // change to your database name

// Create connection
$conn = new mysqli($servername, $username, $password_db, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Perform login authentication
$sql = "SELECT * FROM alumni_login WHERE email = '$email'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$hashpassword = $row['password'];
$verify = password_verify($password, $hashpassword);

$roll_number = $row["roll_number"];
$_SESSION['user_id'] = $roll_number; // $user_id is the user ID associated with the logged-in user

if ($verify && $result->num_rows > 0){
    // Login successful
    echo "Login successful!";
    // Perform actions after successful login, such as redirecting to a new page
    header("Location: Alumni_Welcome.php"); // uncomment this line and change the file name to your desired success page
    exit;
} else {
    // Login failed
    echo "Invalid email or password";
}

$conn->close();
?>
