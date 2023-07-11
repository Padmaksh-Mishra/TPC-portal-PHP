<?php
    require 'config.php';
    session_start();
    $roll_no = $_SESSION['roll_number'];
    echo $roll_no;
    // Get the form data
    $class10 = $_POST['class10'];
    $class12 = $_POST['class12'];
    $cpi = $_POST['cpi'];
    $age = $_POST['age'];
    $specialization = $_POST['specialization'];
    $area_of_interest = $_POST['area_of_interest'];
    $batch_year = $_POST['batch_year'];
    $back = $_POST['back'];
    $trans_link = $_POST['transcript_link'];
    $res_link = $_POST['resume_link'];

    // Insert the data into the student_details table
    $sql = "UPDATE student_details
            SET class10 = '$class10', 
                class12 = '$class12', 
                cpi = '$cpi', 
                age = '$age', 
                specialization = '$specialization', 
                area_of_interest = '$area_of_interest', 
                batch_year = '$batch_year', 
                back = '$back',
                transcript_link = '$trans_link',
                resume_link = '$res_link'
            WHERE roll_number = '$roll_no'
            ";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Details updated successfully')</script>";
        echo "<script>window.location='student_dashboard.php'</script>";
        exit();
    } else {
        echo "<script>alert('There was a problem in updating the details')</script>";
        exit();
    }

?>
