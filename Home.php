<?php
    session_start();
	// Configuration settings for database connection
	$servername = "localhost"; // Update with your database servername
	$username = "root"; // Update with your database username
	$password = "password"; // Update with your database password
	$dbname = "TPC"; // Update with your database name

	// Create a connection to the database
	$conn = mysqli_connect($servername, $username, $password, $dbname);

	// Check the connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

    // Get the current year
    $currentYear = date("Y");

    // Calculate the year 4 years ago
    $year4YearsAgo = $currentYear - 4;

    // Check if the data already exists in alumni_academic_profile table
    $sqlCheck = "SELECT COUNT(*) as count FROM alumni_academic_profile WHERE batch_year = " . $year4YearsAgo;
    $resultCheck = mysqli_query($conn, $sqlCheck);
    $row = mysqli_fetch_assoc($resultCheck);
    $count = $row['count'];

    // If data does not exist, then insert into alumni_academic_profile table
    if ($count == 0) {
        $sqlInsert = "INSERT INTO alumni_academic_profile (roll_number, class10, class12, cpi, back, age, specialization, area_of_interest, batch_year, transcript_link, resume_link)
                    SELECT roll_number, class10, class12, cpi, back, age, specialization, area_of_interest, batch_year, transcript_link, resume_link
                    FROM student_details
                    WHERE batch_year < " . $year4YearsAgo;


        // Run the query
        $resultInsert = mysqli_query($conn, $sqlInsert);
    }

    // Check if there are any rows to be deleted
    $sqlCount = "SELECT COUNT(*) as count FROM student_details WHERE batch_year < " . $year4YearsAgo;
    $resultCount = mysqli_query($conn, $sqlCount);
    $rowCount = mysqli_fetch_assoc($resultCount);
    $count_del = $rowCount['count'];

    if ($count_del > 0) {
        // Delete rows from student_details table
        $sqlDelete = "DELETE FROM student_details WHERE batch_year < " . $year4YearsAgo;
        $resultDelete = mysqli_query($conn, $sqlDelete);

        // Check if the query executed successfully
        if ($resultDelete) {
            $affectedRows = mysqli_affected_rows($conn);
        }
    }

    // // Insert deleted rows into alumni_graduation_placement table
    // $newPlacementTableName = "alumni_academic_profile";
    // $sqlInsert = "INSERT INTO 'alumni_academic_profile' SELECT * FROM 'student_details' WHERE batch_year < " . $year4YearsAgo;
    // // Execute the insertion query
    // // Replace this with your actual database query execution code
    // $result = $conn->query($sqlInsert);
    // echo '1';

    // // Delete rows from student_placement table for years less than current - 4 years
    // $oldPlacementTableName = "student_details";
    // $sqlDelete = "DELETE FROM " . $oldPlacementTableName . " WHERE batch_year < " . $year4YearsAgo;
    // // Execute the deletion query
    // // Replace this with your actual database query execution code
    // $result1 = $conn->query($sqlDelete);
    // echo '2';
?>

<!DOCTYPE html>
<html>
<head>
	<title>My Page</title>
	<style>
        		/*body {
			margin: 0;
			padding: 0;
			background: #34495e;
			font-family: sans-serif;
		}*/
		body {
			margin: 0;
			padding: 0;
			font-family: Arial, sans-serif;
			background-image: linear-gradient(to right, #8360c3, #2ebf91);
		}

		.page {
			padding: 8% 0 0;
			margin: auto;
		}

		.form {
			position: relative;
			z-index: 1;
			background-color: rgba(255, 255, 255, 0.7); /* 70% opacity white */
			max-width: 750px;
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
			<h1>Dashboard</h1>
			<div class="button-container">
				<form method="POST" action="Student_Home.php">
					<button type="submit" class="button" name="update">Student</button>
				</form>

				<form method="POST" action="Company_Home.php">
					<button type="submit" class="button" name="update">Company</button>
				</form>

				<form method="POST" action="Alumni_Home.php">
					<button type="submit" class="button" name="update">Alumni</button>
				</form>


        </div>
	</div>
</body>
</html>
