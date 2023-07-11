<?php
require 'config.php';

$currentYear = date('Y');
$prefix = 'year_';
$tableName = $prefix . $currentYear; // concatenate prefix and date to create table name

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
            <h1> <?php echo "Registered Companies: ".$Fname; ?> </h1>
        </div>

        <div class="top">
            <a href="">View Statistics</a>
            <a href="admin_verification.php">Register a Company</a>
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



		<!-- <div class="top">
            <a href="after_login_menu_dashboard.php">Back</a>
            <a href="logout.php">Log out</a>
        </div> -->

    </div>	
</body>
</html>

