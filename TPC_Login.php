<?php
session_start();

// Retrieve form data
$_SESSION['logged_in'] = true;
$uname = $_POST['username'];
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

echo $password;
echo $uname;
// Perform login authentication
$sql = "SELECT * FROM TPC_login where id = '$uname' and password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0){
    // Login successful
    echo "Login successful!";
    // Perform actions after successful login, such as redirecting to a new page
    header("Location: Home.php"); // uncomment this line and change the file name to your desired success page
    exit;
} else {
    // Login failed
    echo "Invalid email or password";
}

$conn->close();
?>
