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
    $class10 = $_POST["class10"];
    $class12 = $_POST["class12"];
    $cpi = $_POST["cpi"];
    $back = $_POST["back"];
    $age = $_POST["age"];
    $specialization = $_POST["specialization"];
    $area_of_interest = $_POST["area_of_interest"];
    $batch_year = $_POST["batch_year"];
    $transcript_link = $_POST["transcript_link"];
    $resume_link = $_POST["resume_link"];

    // echo $_POST["class10"].'</br>';
    // echo $class10.'</br>';
    // echo $class12.'</br>';
    // echo $cpi.'</br>';
    // echo $back.'</br>';

    $sql = "UPDATE alumni_academic_profile SET 
            class10 = ". ($class10 ? "'$class10'" : "NULL") .",
            class12 = ". ($class12 ? "'$class12'" : "NULL") .",
            cpi = ". ($cpi ? "'$cpi'" : "NULL") .",
            back = ". ($back ? "'$back'" : "NULL") .",
            age = ". ($age ? "'$age'" : "NULL") .",
            specialization = ". ($specialization ? "'$specialization'" : "NULL") .",
            area_of_interest = ". ($area_of_interest ? "'$area_of_interest'" : "NULL") .",
            batch_year = ". ($batch_year ? "'$batch_year'" : "NULL") .",
            transcript_link = ". ($transcript_link ? "'$transcript_link'" : "NULL") .",
            resume_link = ". ($resume_link ? "'$resume_link'" : "NULL") ."
            WHERE roll_number = '$roll_number'";
    $result = $conn->query($sql);
    
    if ($result === TRUE) {
        echo '<script type="text/javascript">alert("Academic Details Updated Successfully.")</script>';
        echo '<script language="javascript">window.location = "http://localhost/MiniProject/Alumni/Alumni_Welcome.php";</script>';
    } else {
        echo "Error updating academic details: " . $conn->error;
    }
}

// Close database connection
$conn->close();
?>
