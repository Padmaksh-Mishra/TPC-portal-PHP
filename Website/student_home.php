<?php
    require 'config.php';
    session_start();

    if(!isset($_SESSION['sess_user'])){
        header('Location: home.php');
    }

    // Fetch user's information from database
    $roll_no = $_SESSION['sess_user'];
    $result = mysqli_query($conn, "select * from students where roll_no = '$roll_no'");
    $row = mysqli_fetch_array($result);

    $first_name = $row['first_name'];
    $last_name = $row['last_name'];

?>


<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        .container {
            margin-top: 50px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .heading {
            font-size: 36px;
            margin-bottom: 30px;
            text-align: center;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="heading">Welcome! <?php echo $first_name . ' ' . $last_name; ?></h1>

        <div class="button-container">
        <form method="POST" action="student_update_details.php">

            <button type="submit" class="button btn" name="update">Update Details</button>
        </form>

        <form action="student_show_details.php" method="post">
            <input type="hidden" name="roll_no" value="<?php echo $roll_no; ?>">
            <button type="submit" class="button btn" name="show_details">Show Details</button>
        </form>

        <form method="POST" action="student_check_companies.php">
            <button type="submit" class="button btn" name="check_compaines">Check Compaines</button>
        </form>
        <form method="post" action="student_logout.php">
            <button type="submit" class="button btn">Logout</button>
        </form>
        </div>
    </div>
</body>
</html>
