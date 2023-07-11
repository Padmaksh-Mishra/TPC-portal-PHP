<?php
session_start();

// check if the student is logged in
if (!isset($_SESSION['logged_in'])) {
    header("Location: student_login.html"); // redirect to login page if not logged in
    exit();
}
session_destroy();
header("Location: index.php"); // redirect to main home page after logout
exit();
?>
