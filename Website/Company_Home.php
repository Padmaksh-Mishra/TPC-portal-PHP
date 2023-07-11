<?php
require 'config.php';

$currentYear = date('Y');
$prefix = 'year_';
$tableName = $prefix . $currentYear; // concatenate prefix and date to create table name

?>

<!DOCTYPE html>
<html>
<head>
	<title>My Page</title>
	<style>


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
		body {
			margin: 0;
			padding: 0;
			font-family: Arial, sans-serif;
			background-image: linear-gradient(to right, #8360c3, #2ebf91);
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

		.page {
			padding: 8% 0 0;
			margin: auto;
		}

		.form {
			position: relative;
			z-index: 1;
			background-color: rgba(255, 255, 255, 0.7); /* 70% opacity white */
			max-width: 1000px;
			margin: 0 auto 100px;
			padding: 45px;
			text-align: center;
			border-radius: 25px;
			box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.2), 0 5px 20px 0 rgba(0, 0, 0, 0.15);
		}

		.form input[type='number'],
		.form input[type='text'],
		.form input[type="email"],
		.form input[type="password"] {
		font-family: "Roboto", sans-serif;
		outline: 0;
		background: #f2f2f2;
		width: 100%;
		border: 0;
		margin: 0 0 15px;
		padding: 15px;
		box-sizing: border-box;
		font-size: 14px;
		border-radius: 25px;
		}

		.form button[type="submit"] {
			font-family: "Roboto", sans-serif;
			text-transform: uppercase;
			outline: 0;
			background: #27ae60;
			width: 200px;
			border: 0;
			padding: 15px;
			color: #FFFFFF;
			font-size: 14px;
			cursor: pointer;
			border-radius: 25px;
			transition: all 0.3s ease-in-out;
		}
		h1 {
		font-size: 28px;
		font-weight: bold;
		text-align: center;
		margin-bottom: 30px;
		color: #333333;
		text-shadow: 1px 1px 1px #ffffff;
		}
		.form select {
			width: 100%;
			padding: 10px;
			margin-bottom: 20px;
			border: none;
			border-radius: 5px;
			box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.1);
			font-size: 18px;
		}
		.form button[type="submit"]:hover {
			background: #2ecc71;
		}

		.form .message {
			margin: 15px 0 0;
			color: #b3b3b3;
			font-size: 12px;
		}

		.form .message a {
			color: #27ae60;
			text-decoration: none;
		}

		.form .alert {
			margin-top: 10px;
			color: red;
			font-size: 12px;
			text-align: center;
			display: none;
		}

		.button-container {
			display: flex;
			flex-direction: row;
			justify-content: center;
			align-items: center;
		}
		.button-container form {
			margin: 20px;
		}
		.button-container .button {
			background-color: #4CAF50;
			border: none;
			color: white;
			padding: 10px 20px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			cursor: pointer;
			border-radius: 5px;
			transition: all 0.3s ease-in-out;
		}
		.button-container .button:hover {
			background-color: #3e8e41;
		}
	</style>
</head>
<body>
    <div class = "page">
		<div class = "form">
			<h1>Company Dashboard</h1>
			<div class="button-container">
				<form method="POST" action="package_stats.php">
					<button type="submit" class="button" name="update">Package Statistics</button>
				</form>

				<form method="POST" action="admin_verification.php">
					<button type="submit" class="button" name="update">Company Verification</button>
				</form>

				<form method="POST" action="">
					<button type="submit" class="button" name="update">Back</button>
				</form>
        </div>

		<div class="container">
        <div class="heading">
            <h1> <?php echo "Registered Companies: ".$Fname; ?> </h1>
        </div>

		<div class="scroll-view">
  			<ul class="student-list">
    		<?php

            $queryx = "select companies.name, $tableName.Role, $tableName.SalaryPackage, $tableName.ThresholdMarks, $tableName.MinimumQualification, $tableName.InterviewMode, $tableName.Back, $tableName.locations  from $tableName JOIN companies ON $tableName.id = companies.id";
            
            // $queryx = "select companies.name, $tableName.Role from $tableName JOIN companies ON $tableName.id = companies.id";

            
            $resultx = mysqli_query($conn, $queryx);

            if (mysqli_num_rows($resultx) > 0) 
			{
                echo '<div class="scroll-view">';
                while($row = mysqli_fetch_assoc($resultx)) 
				{
                    echo '<div class="card">';
                    echo '<h2> Company: ' . $row["name"] . '</h2>';
                    echo '<h2> Job Role: ' .$row["Role"]. '</h2>';
					echo '<h4 class="student-name"> Salary Package: '.$row['SalaryPackage'].' &nbsp;&nbsp;&nbsp;&nbsp; Threshold CPI: '.$row['ThresholdMarks'].' </h4>';
					echo '<h4 class="student-name">Minimum Qualification: '.$row['MinimumQualification'].' &nbsp;&nbsp;&nbsp;&nbsp; InterviewMode: '.$row['InterviewMode'].' &nbsp;&nbsp;&nbsp;&nbsp; Backlog Allowed: '.$row['Back'].' &nbsp;&nbsp;&nbsp;&nbsp; Job Locations: '.$row['locations'].' </h4>';
                    echo '</div>';
                }
                echo '</div>';
            }
    		?>
  			</ul>
		</div>
    </div>	
	</div>
</body>
</html>
