<?php
    require 'config.php';

    // Retrieve the token from the URL parameter
    $token = $_GET['token'];

    $sql = "UPDATE student_login SET verified = 1 WHERE verification_token = '$token'";

    if (mysqli_query($conn, $sql)) {
        echo "<script>'Your email address has been verified. You can now log in to your account.'</script>";
        echo "<script>window.location='student_login.html'</script>";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    mysqli_close($conn);
?>
