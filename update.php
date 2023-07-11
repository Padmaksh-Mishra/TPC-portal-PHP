<?php
require 'config.php';

session_start();

//If there is no session user, then redirect to login page 
if (!isset($_SESSION['sess_user_id'])) 
{
	header("location: login.php");
}

$id = $_SESSION['sess_user_id'];
$selectedYear=$_SESSION['selectedYear'];
$prefix = 'year_';
$tableName = $prefix . $_SESSION['selectedYear']; 
$role = $_SESSION['sess_user_role'];


$result = mysqli_query($conn, "select * from companies where id = '$id'");
$result2 = mysqli_query($conn, "select * from $tableName where id = '$id' and Role = '$role'");

$row = mysqli_fetch_array($result);// row gets stored as an array
$row2 = mysqli_fetch_array($result2);// row gets stored as an array


$Fname = $row["name"];
$email = $row["email"];
$pass = $row["password"];
$MinimumQualification = $row2["MinimumQualification"];
$ThresholdMarks = $row2["ThresholdMarks"];
$SalaryPackage = $row2["SalaryPackage"];
$InterviewMode = $row2["InterviewMode"];
$RecruitingSince = $row2["RecruitingSince"];
$Back = $row2["Back"];
$locations= $row2["locations"];


if (isset($_POST['Submit1'])) 
{
    $new_fname = $_POST["fName"];
	$new_email = $_POST["email"];
    $new_pass1 = $_POST["pass1"];
    $new_pass2 = $_POST["pass2"];
	
    if($new_pass1 != $new_pass2)
	{
        echo '<script type="text/javascript">alert("Passwords Dont Match!")</script>';
    }
    else
	{
            $query = "update companies set name = '$new_fname', password = '$new_pass1', email = '$new_email' where id='$id'";
            $resultx = mysqli_query($conn, $query);

            if($resultx)
			{
                echo '<script type="text/javascript">alert("Updated Successfully! Logging you out.")</script>';
                echo '<script language="javascript">window.location = "http://localhost/miniproject_dbms/logout.php";</script>';
            }
            else
			{
                echo '<script type="text/javascript">alert("Error!")</script>';
        	}   
    }
}


if (isset($_POST['Submit2'])) 
{
	$new_MinimumQualification = $_POST["MinimumQualification"];
	$new_ThresholdMarks = $_POST["ThresholdMarks"];
	$new_SalaryPackage = $_POST["SalaryPackage"];
	$new_InterviewMode = $_POST["InterviewMode"];
	$new_RecruitingSince = $_POST["RecruitingSince"];
	$new_Back = $_POST["Back"];
	$new_Role = $_POST["Role"];
	$new_locations = $_POST["locations"];

	$_SESSION['sess_user_role'] = $new_Role;
	
	$prefix = 'year_';
	$tableName = $prefix . $_SESSION['selectedYear']; 
	echo $tableName;

	// $query = "update $tablename set MinimumQualification = 'll' where id='$id' and Role='$role'";
    
	$query = "update $tableName set MinimumQualification = '$new_MinimumQualification', ThresholdMarks = $new_ThresholdMarks, SalaryPackage = $new_SalaryPackage, InterviewMode = '$new_InterviewMode', RecruitingSince = $new_RecruitingSince, Back = '$new_Back', Role = '$new_Role', locations = '$new_locations' where id ='$id' and Role='$role'";
	$resultx = mysqli_query($conn, $query);

	if($resultx)
	{
		echo '<script type="text/javascript">alert("Updated Successfully!")</script>';
	}
	else
	{
		echo '<script type="text/javascript">alert("Error!")</script>';
	}   
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Update Profile</title>
	<style>
		body {
			color: black;
			background-color: #f2f2f2;
			font-family: Arial, sans-serif;
			color: #333;
			margin: 0;
			padding: 0;
			background-image: linear-gradient(to right, #8360c3, #2ebf91);
		}

		.container {
			max-width: 600px;
			margin: 50px auto;
			padding: 20px;
			border-radius: 5px;
			background-color: #FAF0E6;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
			background-color: rgba(255, 255, 255, 0.5);      
		}

		h1 {
			font-size: 40px;
			margin-bottom: 30px;
			text-align: center;
		}

		form {
			display: flex;
			flex-direction: column;
			align-items: center;
		}

		label {
			font-size: 20px;
			margin-bottom: 10px;
			font-weight:bold;

		}

		input {
			font-size: 20px;
			padding: 10px;
			margin-bottom: 20px;
			border-radius: 5px;
			border: none;
			box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
			background-color: #FAF0E6;
		}

		input[type="submit"] {
			background-color: #333;
			color: #fff;
			font-size: 20px;
			font-weight: bold;
			padding: 10px 20px;
			border: none;
			border-radius: 5px;
			cursor: pointer;
			transition: background-color 0.3s ease;
		}

		input[type="submit"]:hover {
			background-color: #522e52;
		}

		a {
			font-size: 20px;
			margin-top: 20px;
			text-align: center;
			text-decoration: none;
		}

		a:hover {
			text-decoration: underline;
		}
	</style>
</head>

<body>
	<?php if (isset($error)): ?>
		<p><?php echo $error; ?></p>
	<?php endif; ?>

	<div class="container">
		<h1>Update Profile</h1>

		<form action="" method="post">
			<label for="FirstName">Name:</label>
			<input type="text" id="FirstName" name="fName" value="<?php echo $Fname ?>" required>

			<label for="email">Email:</label>
			<input type="text" id="email" name="email" value="<?php echo $email ?>" required>

			<label for="Password1">Password:</label>
			<input type="password" id="Password1" name="pass1" value="<?php echo $pass ?>" required>

			<label for="Password2">Confirm Password:</label>
			<input type="password" id="Password2" name="pass2" value="<?php echo $pass ?>" required>

			<input type="submit" value="Update Profile" name="Submit1">

		</form>

		<h1>Add Criteria</h1>

		<form action="" method="post">
			<label for="MinimumQualification">Minimum Qualification: (B.Tech/ M.Tech/ Phd)</label>
			<input type="text" id="MinQualification" name="MinimumQualification" value="<?php echo $MinimumQualification ?>" required>

			<label for="ThresholdMarks">Threshold CPI:</label>
			<input type="text" id="ThresholdMarks" name="ThresholdMarks" value="<?php echo $ThresholdMarks ?>" required>

			<label for="SalaryPackage">Salary Package:</label>
			<input type="text" id="SalaryPackage" name="SalaryPackage" value="<?php echo $SalaryPackage ?>" required>

			<label for="InterviewMode">Interview Mode: (online/ offline)</label>
			<input type="text" id="InterviewMode" name="InterviewMode" value="<?php echo $InterviewMode ?>" required>

			<label for="RecruitingSince">Recruiting from IIT Patna since (year):</label>
			<input type="text" id="RecruitingSince" name="RecruitingSince" value="<?php echo $RecruitingSince ?>" required>

			<label for="Back">Backlog Allowed:(yes/ no)</label>
			<input type="text" id="Back" name="Back" value="<?php echo $Back ?>" required>

			<label for="Role">Job Role: (SDE/ QUANT/ ML/ MANAGEMENT)</label>
			<input type="text" id="Role" name="Role" value="<?php echo $role ?>" required>

			<label for="Role">Job Locations:</label>
			<input type="text" id="locations" name="locations" value="<?php echo $locations ?>" required>

			<input type="submit" value="Add Criteria" name="Submit2">

			<a href="current_hiring.php">Back</a>
		</form>
	</div>
</body>
</html>



