<?php
session_start();

// Database connection details
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "TPC";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: Alumni_Welcome.php");
    exit;
}

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $roll_number = $_SESSION['user_id'];
    $company = $_POST['company'];
    $role = $_POST['role'];
    $package = $_POST['package'];
    $location = $_POST['location'];
    $offcampus = $_POST['offcampus'];

    $sql = "UPDATE alumni_graduation_placement SET 
            company = ". ($company ? "'$company'" : "company") .",
            role_ = ". ($role ? "'$role'" : "role_") .",
            package = ". ($package ? "'$package'" : "package") .",
            place_of_work = ". ($location ? "'$location'" : "place_of_work") .",
            off_campus = ". ($offcampus ? "'$offcampus'" : "off_campus") ."
            WHERE roll_number = '$roll_number'";

    $result = $conn->query($sql);
    // if (!$result) {
    //     echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    // }
    echo '5';
    if ($result === TRUE) {
        echo '<script type="text/javascript">alert("Placement Details Updated Successfully.")</script>';
        echo '<script language="javascript">window.location = "http://localhost/MiniProject/Alumni/Alumni_Welcome.php";</script>';
    } else {
        echo "Error updating details: " . $conn->error;
    }
}

// Close database connection
$conn->close();
?>
