<?php
require 'config.php';

session_start();

if(!isset($_SESSION['sess_user_id']))
{ 
	
    header('Location: login.php');
}
 
$email = $_SESSION['sess_user_email'];
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
$Role = $row2["Role"];
$locations = $row2["locations"];

?> 


<!DOCTYPE html>
<html>
<head>
	<title>Profile Details</title>
	<style>
	body {
	background-size: cover;
	background-color: #f5f5f5;
	background-image: linear-gradient(to right, #8360c3, #2ebf91);
    }

	.container {
	max-width: 700px;
	margin: 0 auto;
	background-color: #FAF0E6;
	border-radius: 10px;
	box-shadow: 0px 5px 10px rgba(0,0,0,0.1);
	background-color: rgba(255, 255, 255, 0.5);      

	padding: 30px;
	}
		
	.heading {
	text-align: center;
	margin-top: 20px;
	margin-bottom: 20px;
	}

	/* Table styles */
	table {
		border-collapse: collapse;
		width: 80%;
		margin: 0 auto;
		margin-bottom: 20px;
	}

	th, td {
		padding: 20px;
		text-align: left;
		font-weight:bold;
	}

	th {
		background-color: #dddddd;
	}
	td {
		background-color: #FAF0E6;
	}

	/* Back button styles */
	.top {
		margin-top: 20px;
		text-align: center;
	}

	a {
		display: inline-block;
		padding: 10px 20px;
		background-color: #333;
		color: #fff;
		border-radius: 5px;
		text-decoration: none;
		margin-right: 10px;
	}

	a:hover {
		background-color: #0062cc;
	}
	</style>
</head>


<body>
	<div class="container">
	<!-- Heading section -->
	<div class="heading">
		<h1>Company's Profile</h1>
	</div>

	<!-- Table section -->
	<table>
		<tbody>
			<tr>
				<th>Name:</th>
				<td><?php echo $Fname; ?></td>
			</tr>
			<tr>
				<th>Email:</th>
				<td><?php echo $email; ?></td>
			</tr>
			<tr>
				<th>Accessed Year:</th>
				<td><?php echo $selectedYear; ?></td>
			</tr>
		</tbody>
	</table>

	<div class="heading">
		<h1>Hiring Criteria</h1>
	</div>

	<!-- Table section -->
	<table> 
		<tbody>
			<tr>
				<th>Minimum Qualification:</th>
				<td><?php echo $MinimumQualification; ?></td>
			</tr>
			<tr>
				<th>Threshold CPI:</th>
				<td><?php echo $ThresholdMarks; ?></td>
			</tr>
			<tr>
				<th>Salary Package:</th>
				<td><?php echo $SalaryPackage; ?></td>
			</tr>
			<tr>
				<th>Interview Mode:</th>
				<td><?php echo $InterviewMode; ?></td>
			</tr>
			<tr>
				<th>Recruiting From IIT Patna Since:</th>
				<td><?php echo $RecruitingSince; ?></td>
			</tr>
			<tr>
				<th>Backlog Allowed:</th>
				<td><?php echo $Back; ?></td>
			</tr>
			<tr>
				<th>Job Role:</th>
				<td><?php echo $Role; ?></td>
			</tr>
			<tr>
				<th>Job Locations:</th>
				<td><?php echo $locations; ?></td>
			</tr>
		</tbody>
	</table>

	<!-- Back button section -->
	<div class="top">
		<a  href="current_hiring.php" style="display: block; text-align: center;">Back</a>
	</div>
</div>
</body>
</html>

