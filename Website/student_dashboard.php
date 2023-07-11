<?php
    require 'config.php';
    session_start();

    if(!isset($_SESSION['logged_in'])){
        header('Location: student_login.html');
    }

    // Fetch user's information from database
    $roll_number = $_SESSION['roll_number'];
    $result = mysqli_query($conn, "select * from student_login where roll_number = '$roll_number'");
    $row = mysqli_fetch_array($result);

    $first_name = $row['first_name'];
    $last_name = $row['last_name'];

?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style type="text/css">
        .form {
          position: relative;
          z-index: 1;
          background-color: rgba(255, 255, 255, 0.7); /* 70% opacity white */
          max-width: 700px;
          margin: 0 auto 100px;
          padding: 45px;
          text-align: center;
          border-radius: 25px;
          box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.2), 0 5px 20px 0 rgba(0, 0, 0, 0.15);
        }
        
    </style>
</head>
<body>
    <div class="page">
        <div class = "form">
        <h1 class="heading">Welcome! <?php echo $first_name . ' ' . $last_name; ?></h1>
        <div class="button-container">
            <form method="POST" action="student_update_details.html">
                <button type="submit" class="button" name="update">Update Details</button>
            </form>

            <form action="student_show_details.php" method="post">
                <button type="submit" class="button" name="show_details">Show Details</button>
            </form>

            <form method="POST" action="student_check_companies.php">
                <button type="submit" class="button" name="check_compaines">Check Companies</button>
            </form>

            <form method="post" action="student_logout.php">
                <button type="submit" class="button">Logout</button>
            </form>
        </div>
        </div>
    </div>
</body>
</html>
