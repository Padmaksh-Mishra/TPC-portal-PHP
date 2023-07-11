<?php
require 'config.php';
session_start();

$roll_number = $_SESSION['roll_number'];
echo $roll_number;

if(isset($_GET['company_id'], $_GET['role'])) {
    $company_id = (int) $_GET['company_id'];
    $role = $_GET['role'];

    // Check if the student has already applied to this job
    $sql = "SELECT * FROM student_application WHERE company_id = $company_id AND roll_number = '$roll_number' AND role = '$role'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('You have already applied to this job.');</script>";
    } else {
        // Insert the application into the database
        $sql = "INSERT INTO student_application (company_id, roll_number, role) VALUES ($company_id, '$roll_number', '$role')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Applied Successfully');</script>";
        } else {
            echo "Error submitting application: " . mysqli_error($conn);
        }
    }

    // Close the connection
    mysqli_close($conn);
    
    echo "<script>window.location='student_check_companies.php'</script>";
} else {
    echo "Invalid parameters";
}
exit();
?>
