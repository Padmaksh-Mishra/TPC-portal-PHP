<?php
    session_start();
    require 'config.php';
    $roll_number = $_SESSION['roll_number'];
    // data from the database
    $sql = "SELECT student_login.roll_number, student_login.first_name, student_login.last_name, student_details.class10, student_details.class12, student_details.cpi, student_details.age, student_details.specialization, student_details.area_of_interest,student_details.batch_year,student_placement.package,student_details.back,student_placement.company,student_placement.role,student_placement.package,student_placement.off_campus,student_placement.place_of_work FROM student_login JOIN student_details ON student_login.roll_number = student_details.roll_number JOIN student_placement ON student_login.roll_number = student_placement.roll_number WHERE student_login.roll_number = '$roll_number'";
   
    $result = $conn->query($sql);

    while($row = $result->fetch_assoc()){
        $GLOBALS['roll_number'] = $row['roll_number'];
        $GLOBALS['first_name'] = $row['first_name'];
        $GLOBALS['last_name'] = $row['last_name'];
        $GLOBALS['class10'] = $row['class10'];
        $GLOBALS['class12'] = $row['class12'];
        $GLOBALS['cpi'] = $row['cpi'];
        $GLOBALS['age'] = $row['age'];
        $GLOBALS['specialization'] = $row['specialization'];
        $GLOBALS['area_of_interest'] = $row['area_of_interest'];
        $GLOBALS['batch_year'] = $row['batch_year'];
        $GLOBALS['package'] = $row['package'];
        $GLOBALS['back'] = $row['back'];
        $GLOBALS['company'] = $row['company'];
        $GLOBALS['role'] = $row['role'];
        $GLOBALS['off_campus'] = $row['off_campus'];
        $GLOBALS['place_of_work'] = $row['place_of_work'];
    }
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
    <div class="page">
    <div class ="form">
      <h1>Student Details</h1>
      <div class="details">
        <h2>Personal Information</h2>
        <p><label>Roll No:</label> <?php echo strtoupper($GLOBALS['roll_number']); ?> </p>
        <p><label>Name:</label> <?php echo $GLOBALS['first_name'] ;echo " " ; echo $GLOBALS['last_name'];?> </p>
        <p><label>Age:</label> <?php echo $GLOBALS['age'] ?> </p>
        <p><label>Specialization:</label> <?php echo $GLOBALS['specialization'] ?> </p>
        <p><label>Area of Interest:</label> <?php echo $GLOBALS['area_of_interest'] ?> </p>
      </div>
      <div class="details">
        <h2>Academic Information</h2>
        <p><label>Class X Percentage:</label> <?php echo $GLOBALS['class10'] ?> </p>
        <p><label>Class XII Percentage:</label> <?php echo $GLOBALS['class12'] ?> </p>
        <p><label>CPI:</label> <?php echo $GLOBALS['cpi'] ?> </p>
        <p><label>Batch Year:</label> <?php echo $GLOBALS['batch_year'] ?></p>
        <p><label>Failed in any course:</label> <?php echo $GLOBALS['back'] ?> </p>
      </div>
      <div class="details">
        <h2>Placement Details</h2>
        <p><label>Company Placed</label> <?php echo $GLOBALS['company'] ?> </p>
        <p><label>Package:</label> <?php echo $GLOBALS['package'] ?> </p>
        <p><label>Role:</label> <?php echo $GLOBALS['role'] ?> </p>
        <p><label>Place of work:</label> <?php echo $GLOBALS['place_of_work'] ?> </p>
        <p><label>Was the placement off campus:</label> <?php if($GLOBALS['off_campus']==1){echo "YES";}else{echo "NO";} ?> </p>
      </div>
    </div>
  </div>
  </body>
</html>
