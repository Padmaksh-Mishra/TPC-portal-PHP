<?php

session_start(); // Start the session

// Database connection
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "TPC";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Query to fetch data from alumni_profile table
$roll_number = $_SESSION['user_id'];
$sql_profile = "SELECT * FROM alumni_academic_profile WHERE roll_number = '$roll_number'";
$result_1 = $conn->query($sql_profile);

$sql_login = "SELECT * FROM alumni_login WHERE roll_number = '$roll_number'";
$result_2 = $conn->query($sql_login);

// Fetch data and store in variables
if ($result_1 && $result_2) {
    $row = $result_1->fetch_assoc();
    $rollNo = $row["roll_number"];
    $age = $row["age"];
    $specialization = $row["specialization"];
    $areaOfInterest = $row["area_of_interest"];
    $class10Percentage = $row["class10"];
    $class12Percentage = $row["class12"];
    $cpi = $row["cpi"];
    $batchYear = $row["batch_year"];
    $failedCourses = $row["back"];

} else {
  echo '<script type="text/javascript">alert("No Data Found, Please update your profile first!")</script>';
  echo '<script language="javascript">window.location = "http://localhost/MiniProject/Alumni/Alumni_Welcome.php";</script>';
}

if ($result_2->num_rows > 0) {
    $row = $result_2->fetch_assoc();
    $name = $row["first_name"] . " " . $row["last_name"];
    $email  = $row["email"];
} else {
    echo "No data found.";
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Student Details</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* CSS for the layout */
      body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-image: linear-gradient(to right, #8360c3, #2ebf91);
        color: #333;
      }
      .form {
        position: relative;
        z-index: 1;
        background-color: rgba(255, 255, 255, 0.9); /* 70% opacity white */
        max-width: 800px;
        margin: 0 auto 100px;
        padding: 45px;
        text-align: left;
        border-radius: 25px;
        box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.2), 0 5px 20px 0 rgba(0, 0, 0, 0.15);
      }
      
      h1 {
        text-align: center;
        font-size: 36px;
        margin-bottom: 30px;
      }
      
      .details {
        margin-bottom: 30px;
        padding: 30px;
        border: 2px solid #eee;
        border-radius: 10px;
        box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
      }
      
      .details h2 {
        font-size: 28px;
        margin-bottom: 20px;
        border-bottom: 2px solid #eee;
        padding-bottom: 10px;
      }
      
      .details p {
        margin: 0;
        font-size: 20px;
        line-height: 30px;
      }
      
      .details label {
        font-weight: bold;
        margin-right: 10px;
        color: #666;
      }
    </style>
  </head>
  <body>
    <div id="container">
      <div class = "page">
        <div class = "form">
      <h1>Student Details</h1>
      <div class="details">
        <h2>Personal Information</h2>
        <p><label>Roll No:</label><?php echo $rollNo; ?></p>
        <p><label>Name:</label><?php echo $name; ?></p>
        <p><label>Age:</label><?php echo $age; ?></p>
        <p><label>Specialization:</label><?php echo $specialization; ?></p>
        <p><label>Area of Interest:</label><?php echo $areaOfInterest; ?></p>
      </div>
      <div class="details">
        <h2>Academic Information</h2>
        <p><label>Class X Percentage:</label><?php echo $class10Percentage; ?></p>
        <p><label>Class XII Percentage:</label><?php echo $class12Percentage; ?></p>
        <p><label>CPI:</label><?php echo $cpi; ?></p>
        <p><label>Batch Year:</label><?php echo $batchYear; ?></p>
        <p><label>Failed in any course:</label><?php echo $failedCourses; ?></p>
      </div>
    <!-- <div class="btn-container">
        <a href="http://localhost/MiniProject/Alumni/Alumni_Welcome.php" class="back-btn">Back</a>
      </div> -->
      <form method="POST" action="Alumni_Welcome.php">
					<button type="submit" class="button" name="back">Back</button>
			</form>
    </div>
    </div>
  </body>
</html>

