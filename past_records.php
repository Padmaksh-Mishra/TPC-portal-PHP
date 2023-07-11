<?php
require 'config.php';

session_start();
 
if(!isset($_SESSION['sess_user_id']))
{
    header('Location: login.php'); // redirecting the user to another link
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $selected_option = $_POST['myDropdown2'];
    // echo "You selected: " . $selected_option;
    $_SESSION['selectedYear'] = $selected_option;
}

$email = $_SESSION['sess_user_email'];
$id = $_SESSION['sess_user_id'];

$result = mysqli_query($conn, "select * from companies where id = '$id'"); 
$row = mysqli_fetch_array($result);  // row gets stored as an array
$Fname = $row["name"];


$prefix = 'year_';
$tableName = $prefix . $_SESSION['selectedYear']; // concatenate prefix and date to create table name
$result_new = mysqli_query($conn, "SELECT table_name FROM information_schema.tables WHERE table_schema = '$dbname' AND table_name = '$tableName' LIMIT 1");


if (mysqli_num_rows($result_new) == 1) 
{
    $result_row = mysqli_query($conn, "select * from $tableName where id = '$id'"); 

    if (mysqli_num_rows($result_row) == 0)
    {
		echo '<script type="text/javascript">alert("Your Company did not visit our campus for hiring in the selected year!")</script>';
    }
} 
else 
{
    echo '<script type="text/javascript">alert("Your Company did not visit our campus for hiring in the selected year!")</script>';
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
			background-color: #f2f2f2;
			background-image: linear-gradient(to right, #8360c3, #2ebf91);
		}

		.container {
			max-width: 800px;
			margin: 0 auto;
			padding: 20px;
			background-color: #FAF0E6;
			background-color: rgba(255, 255, 255, 0.5);      
			box-shadow: 0 0 5px rgba(0,0,0,0.3);
		}

		.heading {
			margin-bottom: 20px;
			text-align: center;
		}

		.student-list {
			margin: 0;
			padding: 0;
			list-style: none;
		}

		.card {
			margin: 20px 0;
			padding: 20px;
			background-color: #FAF0E6;
			box-shadow: 0 0 5px rgba(0,0,0,0.1);
		}

		.card h2 {
			margin-top: 0;
		}

		.student-name {
			margin-top: 10px;
			margin-bottom: 0;
			font-size: 16px;
			font-weight: normal;
			color: #333;
		}

		.top {
			margin-top: 20px;
			text-align: center;
		}

		.top a {
			display: inline-block;
			margin: 0 10px;
			padding: 10px 20px;
			background-color: #333;
			color: #fff;
			text-decoration: none;
			border-radius: 5px;
		}

		.top a:hover {
			background-color: #444;
		}

		.scroll-view {
			max-height: 400px;
			overflow-y: scroll;
			margin-bottom: 20px;
		}

		table {
			border-collapse: collapse;
			margin-bottom: 20px;
			width: 100%;
		}

		.student-item {
		padding: 10px;
		border-bottom: 1px solid #ccc;
		}

		.student-name {
		margin: 0;
		font-size: 18px;
		font-weight: bold;
		}

		.student-info {
		margin: 5px 0 0 0;
		font-size: 14px;
		} 

		/* Style the table */
		table {
			border-collapse: collapse;
			margin: 0 auto;
			width: 80%;
			max-width: 800px;
			background-color: #FAF0E6;
			box-shadow: 2px 2px 0px #ddd;
		}

		th {
			background-color: #333;
			color: #fff;
			font-size: 20px;
			font-weight: normal;
			text-align: left;
			padding: 10px;
			border: 1px solid #ddd;
			text-align: left;
			padding: 10px;
		}

		td {
			font-size: 18px;
			font-weight: bold;
			padding: 10px;
			border-bottom: 1px solid #ddd;
			border-left: 1px solid #ddd;
			color: #333;
		}
	</style>
</head>


<body>
    <div class="container">
        <div class="heading">
            <h1> <?php echo "Welcome! ".$Fname; ?> </h1>
        </div>


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
				<td><?php echo $_SESSION['selectedYear']; ?></td>
			</tr>
		</tbody>
		</table>

		<h3> <?php echo "The criterias and details for different Job Roles offered by your company were:"; ?> </h3>

		<div class="scroll-view">
  			<ul class="student-list">
    		<?php

            $queryx = "select * from $tableName where id = '$id'";
            $resultx = mysqli_query($conn, $queryx);

            if (mysqli_num_rows($resultx) > 0) 
			{
                echo '<div class="scroll-view">';
                while($row = mysqli_fetch_assoc($resultx)) 
				{
                    echo '<div class="card">';
                    echo '<h2> Role: ' . $row["Role"] . '</h2>';
					echo '<h4 class="student-name">Minimum Qualification: '.$row['MinimumQualification'].' &nbsp;&nbsp;&nbsp;&nbsp; Threshold CPI: '.$row['ThresholdMarks'].' &nbsp;&nbsp;&nbsp;&nbsp; Salary Package: '.$row['SalaryPackage'].' </h4>';
					echo '<h4 class="student-name">Interview Mode: '.$row['InterviewMode'].' &nbsp;&nbsp;&nbsp;&nbsp; Backlog Allowed: '.$row['Back'].'  </h4>';
                    echo '</div>';
                }
                echo '</div>';
            }
    		?>
  			</ul>
		</div>



		<div class="top">
            <a href="after_login_menu_dashboard.php">Back</a>
            <!-- <a href="profile.php">Profile Details</a> -->
            <a href="logout.php">Log out</a>
        </div>

    </div>	
</body>
</html>

