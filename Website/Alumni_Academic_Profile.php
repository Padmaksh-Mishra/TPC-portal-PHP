<!DOCTYPE html>
<html>
  <head>
    <title>Student Details</title>
    <style>
      body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f7f7f7;
        color: #333;
      }
      
      #container {
        max-width: 800px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.2);
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
      <h1>Student Details</h1>
      <div class="details">
        <h2>Personal Information</h2>
        <p><label>Roll No:</label> <?php echo getFieldValueFromAcademicDatabase('roll_number'); ?></p>
        <p><label>Name:</label> <?php echo getFieldValueFromDatabase('10th') . ' ' . getFieldValueFromDatabase('last_name'); ?></p>
        <p><label>Age:</label> <?php echo getFieldValueFromDatabase('age'); ?></p>
        <p><label>Specialization:</label> <?php echo getFieldValueFromDatabase('specialization'); ?></p>
        <p><label>Area of Interest:</label> <?php echo getFieldValueFromDatabase('area_of_interest'); ?></p>
      </div>
      <div class="details">
        <h2>Academic Information</h2>
        <p><label>Class X Percentage:</label> <?php echo getFieldValueFromCompanyDatabase('10th'); ?></p>
        <p><label>Class XII Percentage:</label> <?php echo getFieldValueFromCompanyDatabase('12th'); ?></p>
        <p><label>CPI:</label> <?php echo getFieldValueFromCompanyDatabase('cpi'); ?></p>
        <p><label>Batch Year:</label> <?php echo getFieldValueFromCompanyDatabase('batch_year'); ?></p>
        <p><label>Failed in any course:</label> <?php echo getFieldValueFromCompanyDatabase('back'); ?></p>
      </div>
    </div>

    <?php

    session_start();

    // Check if the user is logged in

    if (!isset($_SESSION['user_id'])) {
      echo "User not logged in.";
      // Redirect or display an error message as needed
      exit;
    }

    // Retrieve the logged-in user's ID from the session
    $user_id = $_SESSION['user_id'];

    require_once('config.php');
    // Function to fetch field value from the database
    function getFieldValueFromAcademicDatabase($fieldName) {

      // Fetch field value from database
      $sql = "SELECT $fieldName FROM alumni_academic_details";
      $result = $conn->query($sql);
      $row = $result->fetch_assoc();
      $fieldValue = $row[$fieldName];

      // Close connection
      $conn->close();

      return $fieldValue;
    }

    function getFieldValueFromCompanyDatabase($fieldName) {

      // Fetch field value from database
      $sql = "SELECT $fieldName FROM alumni_placement_details";
      $result = $conn->query($sql);
      $row = $result->fetch_assoc();
      $fieldValue = $row[$fieldName];

      // Close connection
      $conn->close();

      return $fieldValue;
    }
    ?>

  </body>
</html>
