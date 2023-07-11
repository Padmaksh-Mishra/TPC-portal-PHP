<?php
session_start();

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
$sql= "SELECT * FROM alumni_graduation_placement where roll_number = '$roll_number'";
$result= $conn->query($sql);

$sql_current = "SELECT * FROM alumni_current_details where roll_number = '$roll_number'";
$result_current = $conn->query($sql_current);

// Fetch data and store in variables
if ($result-> num_rows > 0 && $result_current-> num_rows > 0){
    $row = $result->fetch_assoc();
    $role = $row["role_"];
    $company = $row["company"];
    $package = $row["package"];
    $place_of_work =  $row["place_of_work"];
    $offcampus =  $row["offcampus"];
    if($offcampus = 1){
      $oncampus = 'Yes';
    }else{
      $oncampus = 'No';
    }

    $row_current = $result_current->fetch_assoc();
    $current_role = $row_current["role_"];
    $current_company = $row_current["company"];
    $ctc = $row_current["ctc"];
    $current_location =  $row_current["place_of_work"];
    $position =  $row_current["position"];
    $prev_exp = $row_current["previous_experience"];
    $wt = $row_current["working_tenure"];

    echo $row["place_of_work"];

} else {
  $sql_grad = "INSERT INTO alumni_graduation_placement (roll_number) VALUES ('$roll_number')";
  $sql_current = "INSERT INTO alumni_current_details (roll_number) VALUES ('$roll_number')";
  $result_grad = $conn->query($sql_grad);
  $result_current = $conn->query($sql_current);
  echo '<script type="text/javascript">alert("No Data Found, Please update your graduation placement profile first!")</script>';
  echo '<script language="javascript">window.location = "http://localhost/MiniProject/Alumni_Welcome.php";</script>';
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
      <h1>Career Details</h1>
      <div class="details">
        <h2>Graduation Placement</h2>
        <p><label>Company:</label><?php echo $company; ?></p>
        <p><label>Package:</label><?php echo $package; ?></p>
        <p><label>Role:</label><?php echo $role; ?></p>
        <p><label>Location:</label><?php echo $place_of_work; ?></p>
        <p><label>OffCampus:</label><?php echo $oncampus; ?></p>
      </div>
      <div class="details">
        <h2>Current Placement</h2>
        <p><label>Company: </label><?php echo $current_company; ?></p>
        <p><label>CTC:  </label><?php echo $ctc; ?></p>
        <p><label>Role: </label><?php echo $current_role; ?></p>
        <p><label>Position: </label><?php echo $position; ?></p>
        <p><label>Location: </label><?php echo $current_location; ?></p>
        <p><label>Employment duration: </label><?php echo $wt; ?></p>
        <p><label>Previous Experience: </label><?php echo $prev_exp; ?></p>
      </div>
    <!-- <div class="btn-container">
        <a href="http://localhost/MiniProject/Alumni/Alumni_Welcome.php" class="back-btn">Back</a>
    </div> -->
    <form method="POST" action="Alumni_Welcome.php">
					<button type="submit" class="button" name="back">Back</button>
			</form>
  </body>
</html>

