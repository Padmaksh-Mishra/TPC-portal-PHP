<?php
session_start(); // Start the session

// Configuration settings for database connection
$servername = "localhost"; // Update with your database servername
$username = "root"; // Update with your database username
$password = "password"; // Update with your database password
$dbname = "TPC"; // Update with your database name

// Create a connection to the database
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: Alumni_Login.html");
    exit;
}

// Get the user ID from session
$roll_number = $_SESSION['user_id'];

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $firstname = $_POST['first_name'];
    $lastname = $_POST['last_name'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $email = $_POST['email'];

    // Add other fields as needed

    // Check if password and confirm password match
    if ($password !== $confirm_password) {
        // Show error message
        echo "Error: Password and Confirm Password do not match!";
    } else {
        // Hash the password
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        // Update the alumni profile details in the database
        // Assuming you have a database connection already established
        // Only update fields that have changed
        $sql = "UPDATE alumni_login SET 
                password = ". ($password ? "'$hashed'" : 'password') .", 
                email = ". ($email ? "'$email'" : 'email') .", 
                first_name = ". ($firstname ? "'$firstname'" : 'first_name') .", 
                last_name =  ". ($lastname ? "'$lastname'" : 'last_name') ." 
                WHERE roll_number = '$roll_number'";
        $result = $conn->query($sql);
        
        if ($result) {
            // Success message
            echo '<script type="text/javascript">alert("Profile details updated successfully!")</script>';
            echo '<script language="javascript">window.location = "http://localhost/MiniProject/Alumni/Alumni_Welcome.php";</script>';

        } else {
            // Error message
            echo "Error: Failed to update profile details.";
        }
    }
}
?>
