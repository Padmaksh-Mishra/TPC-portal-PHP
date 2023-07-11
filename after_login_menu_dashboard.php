<?php
require 'config.php';

session_start();
 
if(!isset($_SESSION['sess_user_id']))
{
    header('Location: login.php'); // redirecting the user to another link
}

$email = $_SESSION['sess_user_email'];
$id = $_SESSION['sess_user_id'];

$result = mysqli_query($conn, "select * from companies where id = '$id'"); 
$row = mysqli_fetch_array($result);  // row gets stored as an array

$Fname = $row["name"];
?>


<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>
	<style>

	body {
	background-color: #F5F5F5;
	font-family: Arial, sans-serif;
	color: #333;
	background-size: cover;
	background-color: #f5f5f5;
	background-image: linear-gradient(to right, #8360c3, #2ebf91);		
	}


	.container {
		
	max-width: 1000px;
	margin: 0 auto;
	padding: 20px;
	background-color: #FAF0E6;
	border-radius: 10px;
	box-shadow: 0px 0px 10px #999999;
	background-color: rgba(255, 255, 255, 0.5);      

	text-align: center;
	}

	.heading {
	margin-top: 50px;
	margin-bottom: 30px;
	}

	h1 {
	font-size: 3rem;
	font-weight: bold;
	}

	form {
	margin-top: 20px;
	}

	p {
	font-size: 1.2rem;
	font-weight: bold;
	}

	select {
	padding: 10px;
	font-size: 1.2rem;
	border: none;
	border-radius: 5px;
	margin-bottom: 20px;
	}

	a {
	font-size: 1.2rem;
	padding: 10px 20px;
	background-color: #333;
	color: white;
	border: none;
	border-radius: 4px;
	cursor: pointer;
	}

	a:hover {
	background-color: #0062cc;
	}

	.heading {
	text-align: center;
	}

	.top {
	display: flex;
	justify-content: space-between;
	align-items: center;
	}

	button {
	font-size: 1.2rem;
	padding: 10px 20px;
	background-color: #333;
	color: white;
	border: none;
	border-radius: 4px;
	cursor: pointer;
	}

	select {
	padding: 10px;
	border-radius: 4px;
	border: none;
	}
	/* Style for form container */
	.form-container {
	position: relative;
	display: inline-block;
	}

	/* Style for dropdown button */
	.form-container button {
	background-color: #4CAF50;
	color: white;
	padding: 12px;
	border: none;
	cursor: pointer;
	}

	/* Style for dropdown content */
	.form-container .dropdown-content {
	display: none;
	position: absolute;
	z-index: 1;
	top: 40px;
	background-color: #f9f9f9;
	min-width: 160px;
	box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
	}

	/* Style for dropdown options */
	.form-container select {
	width: 100%;
	padding: 12px 20px;
	margin: 8px 0;
	display: inline-block;
	border: 1px solid #ccc;
	border-radius: 4px;
	box-sizing: border-box;
	}

	/* Style for selected option */
	.form-container select option:checked {
	background-color: #4CAF50;
	color: white;
	}

	/* Hover effect for dropdown button */
	.form-container:hover button {
	background-color: #3e8e41;
	}

	/* Show dropdown content when button is clicked */
	.form-container.show .dropdown-content {
	display: block;
	}
	</style>
</head>


<body>
    <div class="container">
        <div class="heading">
            <h1> <?php echo "Welcome! ".$Fname; ?> </h1>
			<h2> <?php echo "What do you wish to proceed with?" ?> </h2>
        </div>
        <div class="top">

		<button id="showDropdown1">Current Hiring</button>

		<form id="current_hiring" class="form-container" method="post" action="current_hiring.php" style="display:none;"> 
		<select name="myDropdown1" id="myDropdown1" >
			<option disabled selected>Choose a Job Role</option>
			<option value="SDE">SDE</option>
			<option value="QUANT">QUANT</option>
			<option value="ML">ML</option>
			<option value="MANAGEMENT">MANAGEMENT</option>
		</select>
		</form>

		<button id="showDropdown2">Past Records</button>

		<form id="past_records" class="form-container" method="post" action="past_records.php" style="display:none;">
		<select name="myDropdown2" id="myDropdown2">
			<option disabled selected>Select a year</option>
			<?php
			$currentYear = date('Y');
			$startYear = 2011; // change this to the start year you want
			for ($year = $currentYear-1; $year >= $startYear; $year--) 
			{
				echo "<option value='$year'>$year</option>";
			}
			?>
		</select>
		</form>

		<!-- jQuery code -->
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script>
		$(document).ready(function() 
		{
		$('#showDropdown1').click(function() {
			$('#current_hiring').show();
		});

		$('#myDropdown1').change(function() {
			$('#current_hiring').submit();
		});

		$('#showDropdown2').click(function() {
			$('#past_records').show();
		});
		
		$('#myDropdown2').change(function() {
			$('#past_records').submit();
		});
		});
		</script>

		<a href="logout.php">Log out</a>

        </div>
    </div>	
</body>
</html>









