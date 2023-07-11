<?php
require 'config.php';

session_start();

if(!isset($_SESSION['sess_user_id'])){
    header('Location: login.php'); 
}

$id = $_SESSION['sess_user_id'];
$selectedYear=$_SESSION['selectedYear'];
$prefix = 'year_';
$tableName = $prefix . $_SESSION['selectedYear']; 
$role = $_SESSION['sess_user_role'];
$email = $_SESSION['sess_user_email'];


$result2 = mysqli_query($conn, "select * from $tableName where id = '$id' and Role = '$role' ");
$row2 = mysqli_fetch_array($result2);// row gets stored as an array


if(isset($_POST["Yes"]))
{
$query = "delete from $tableName where id = '$id' and Role = '$role'";
$result = mysqli_query($conn, $query);

if($result)
{
    echo '<script type="text/javascript">alert("Deleted Succesfully!")</script>';
    echo '<script language="javascript">window.location = "http://localhost/miniproject_dbms/logout.php";</script>';
}
else
{
    echo '<script type="text/javascript">alert("Error!")</script>';
}
}


if(isset($_POST["No"]))
{
    echo '<script language="javascript">window.location = "http://localhost/miniproject_dbms/current_hiring.php";</script>';
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Delete</title>
	<style>
		body {
			background-color: #f2f2f2;
			font-family: Arial, sans-serif;
			background-image: linear-gradient(to right, #8360c3, #2ebf91);
		}

		h1 {
			text-align: center;
			font-size: 25px;
			margin-bottom: 20px;
			color: #333;
			text-transform: uppercase;
			letter-spacing: 3px;
			font-weight: 900;
		}

		.container {
			margin: 50px auto;
			max-width: 600px;
			padding: 20px;
			background-color: #FAF0E6;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
			border-radius: 5px;
			background-color: rgba(255, 255, 255, 0.5);      
		}

		p.top {
			font-size: 20px;
			margin-top: 20px;
			margin-bottom: 20px;
			text-align: center;
		}

		form {
			text-align: center;
		}

		input.button {
			display: inline-block;
			padding: 10px 20px;
			margin: 10px;
			font-size: 20px;
			font-weight: bold;
			color: #ffffff;
			background-color: #333;
			border: none;
			border-radius: 5px;
			cursor: pointer;
			transition: background-color 0.3s;
		}

		input.button:hover {
			background-color: #cc0000;
		}

		a {
			display: block;
			margin-top: 20px;
			font-size: 20px;
			text-align: center;
			color: #333333;
		}

		a:hover {
			color: #cc0000;
		}
	</style>
</head>

<body>
	<h1>Cancel The Current Recruitment Process?</h1>
	<div class="container">
		<p class="top">Are you sure you want to cancel it?</p>
		<form method="post">
			<input type="submit" name="Yes" class="button" value="Yes, Delete The Data For This Job Role!" />
			<input type="submit" name="No" class="button" value="No, Take me Back!" />
		</form>
		<a href="current_hiring.php">Back</a>
	</div>
</body>
</html>



