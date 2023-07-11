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
    $ctc = $_POST['ctc'];
    $location = $_POST['location'];
    $wt = $_POST['working_tenure'];
    $position = $_POST['position'];
    $prev_exp = $_POST['prev_exp'];

    // echo '3';
    // echo $roll_number.'</br>';
    // echo $company.'</br>';
    // echo $role.'</br>';
    // echo $ctc.'</br>';
    // echo $location.'</br>';
    // echo $wt.'</br>';
    // echo $position.'</br>';

    $sql = "UPDATE alumni_current_details SET 
            company = ". ($company ? "'$company'" : "company") .",
            role_= ". ($role ? "'$role'" : "role_") .",
            ctc = ". ($ctc ? "'$ctc'" : "ctc") .",
            position = ". ($position ? "'$position'" : "position") .",
            working_tenure = ". ($wt ? "'$wt'" : "working_tenure") .",
            previous_experience = ". ($prev_exp ? "'$prev_exp'" : "previous_experience") .",
            place_of_work = ". ($location ? "'$location'" : "place_of_work") ."
            WHERE roll_number = '$roll_number'";

    $result = $conn->query($sql);

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
