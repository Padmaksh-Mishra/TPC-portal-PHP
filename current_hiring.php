<?php
require 'config.php';

session_start();
 
if(!isset($_SESSION['sess_user_id']))
{
    header('Location: login.php'); // redirecting the user to another link
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $selected_option = $_POST['myDropdown1'];
    $_SESSION['sess_user_role'] = $selected_option;
}
$currentYear = date('Y');
$email = $_SESSION['sess_user_email'];
$id = $_SESSION['sess_user_id'];
$role = $_SESSION['sess_user_role'];
$_SESSION['selectedYear'] = $currentYear;


$result = mysqli_query($conn, "select * from companies where id = '$id'"); 
$row = mysqli_fetch_array($result);  // row gets stored as an array
$Fname = $row["name"];


$prefix = 'year_';
$tableName = $prefix . $_SESSION['selectedYear']; // concatenate prefix and date to create table name
$result_new = mysqli_query($conn, "SELECT table_name FROM information_schema.tables WHERE table_schema = '$dbname' AND table_name = '$tableName' LIMIT 1");


if (mysqli_num_rows($result_new) == 1) 
{
    $result_row = mysqli_query($conn, "select * from $tableName where id = '$id' and Role = '$role'"); 

    if (mysqli_num_rows($result_row) != 0)
    {

    }
    else
    {
        $sql1 = "insert into $tableName(id,MinimumQualification,ThresholdMarks,SalaryPackage,InterviewMode,RecruitingSince,Back,Role,locations) values($id, 'B.Tech', 11, 0, 'online', 2011, 'yes', '$role','-')";

        if ($conn->query($sql1) === TRUE) 
        {
            // echo '<script type="text/javascript">alert("Added Successfully! Logging you out")</script>';
        } 
        else 
        {
            echo "Error: " . $sql1 . "<br>" . $conn->error;
        }
    }
} 
else 
{
    $sql = "create table $tableName(id int,MinimumQualification varchar(100), ThresholdMarks float, SalaryPackage int, InterviewMode varchar(100), RecruitingSince int, Back varchar(10),Role varchar(100), locations varchar(200), primary key(id,Role))"; 
    
    if ($conn->query($sql) === TRUE) 
    {
        echo '<script type="text/javascript">alert("Table Creation Successfull!")</script>';
    } 
    else 
    {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $sql1 = "insert into $tableName(id,MinimumQualification,ThresholdMarks,SalaryPackage,InterviewMode,RecruitingSince,Back,Role,locations) values($id, 'B.Tech', 11, 0, 'online', 2011, 'yes', '$role','-')";

	if ($conn->query($sql1) === TRUE) 
    {
        // echo '<script type="text/javascript">alert("Added Successfully! Logging you out")</script>';
    } 
    else 
    {
        echo "Error: " . $sql1 . "<br>" . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>
	<style>
		/* Custom CSS styles */
		body {
			/* background-color: #f5f5f5; */
			background-image: linear-gradient(to right, #8360c3, #2ebf91);		}

		.container {
			max-width: 1200px;
			margin: 0 auto;
			padding: 20px;
			
			/* background-color: #FAF0E6; */
			background-color: #F2E6FF;
			background-color: rgba(255, 255, 255, 0.5);

			box-shadow: 0 0 5px rgba(0,0,0,0.3);
		}

		.heading {
			margin-bottom: 20px;
			text-align: center;
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


		form button {
			font-size: 20px;
			padding: 15px 20px;
			border: none;
			border-radius: 5px;
			background-color: #e60000;
			color: #ffffff;
			cursor: pointer;
			box-shadow: 2px 2px 2px #cccccc;
			transition: background-color 0.3s ease-in-out;
		}

		form button:hover {
			background-color: #ff1a1a;
		}

		form button:focus {
			outline: none;
		}

		.scroll-view {
			max-height: 400px;
			overflow-y: scroll;
			margin-bottom: 20px;
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


		.student-list {
		margin: 0;
		padding: 0;
		list-style: none;
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

	</style>
</head>


<body>
    <div class="container">
        <div class="heading">
            <h1> <?php echo "Welcome! ".$Fname; ?> </h1>
        </div>
        <div class="top">
            <a href="after_login_menu_dashboard.php">Back</a>
            <a href="profile.php">Profile Details</a>
            <a href="update.php">Update Profile</a>
            <a href="logout.php">Log out</a>
			<a href="delete.php">Delete</a>

        </div>

		<h3 style="text-align: center;"> <?php echo "Eligible Students according to the current Criteria and Job Role are :"; ?> </h3>

		<div class="scroll-view">
  			<ul class="student-list">
    		<?php
      		// Query the database to get a list of students

			$currentYear = date('Y');
			$batch_year = $currentYear -3;

			$result_row = mysqli_query($conn, "select * from $tableName where id = '$id' and Role = '$role' LIMIT 1"); 
			$roww = mysqli_fetch_assoc($result_row);
			$min_cpi = $roww['ThresholdMarks'];
			$back = $roww['Back'];
			$package = $roww['SalaryPackage']; 
			$resume_link = $roww['resume_link'];
			$transcript_link = $roww['transcript_link'];
			
			if($back == "yes")
			{
				//$queryx = "SELECT * FROM student_details where batch_year = '$batch_year' and cpi >= '$min_cpi' and package < '$package'"; //works whether you put inverted commas or not..but using it is preferable coz sometimes not putting does not work

				$queryx = "SELECT student_details.roll_number, student_details.cpi, student_details.specialization, student_details.resume_link, student_details.transcript_link
				FROM student_details 
				JOIN student_application  ON student_details.roll_number = student_application.roll_number JOIN student_placement ON student_details.roll_number = student_placement.roll_number
				WHERE student_application.company_id = '$id' AND student_details.batch_year = '$batch_year' AND student_application.role = '$role' AND student_details.cpi >= '$min_cpi' AND student_placement.package < '$package' ";
			}
			else
			{
				// $queryx = "SELECT * FROM student_details where batch_year = $batch_year and cpi >= $min_cpi and package < $package and back = $back";

				$queryx = "SELECT student_details.roll_number, student_details.cpi, student_details.specialization, student_details.resume_link, student_details.transcript_link
				FROM student_details 
				JOIN student_application  ON student_details.roll_number = student_application.roll_number JOIN student_placement ON student_details.roll_number = student_placement.roll_number
				WHERE student_application.company_id = '$id' AND student_details.batch_year = '$batch_year' AND student_application.role = '$role' AND student_details.cpi >= '$min_cpi' AND student_placement.package < '$package' AND student_details.back ='$back'";
			}
           
      		$resultx = mysqli_query($conn, $queryx);
      
			if (mysqli_num_rows($resultx) > 0) 
			{
				echo '<div class="scroll-view">';
				while($rows = mysqli_fetch_assoc($resultx)) 
				{
					echo '<div class="card">';
					echo '<h2> Roll no: ' . $rows['roll_number'] . '</h2>';
					echo '<h4 class="student-name">CPI: '.$rows['cpi'].' &nbsp;&nbsp;&nbsp;&nbsp; Specialization: '.$rows['specialization'].' &nbsp;&nbsp;&nbsp;&nbsp;  <a href="'.$rows['resume_link'].'">Resume</a> &nbsp;&nbsp;&nbsp;&nbsp; <a href="'.$rows['transcript_link'].'">Transcript</a></h4>';
					echo '</div>';
				}
				echo '</div>';
			}

    		?>
  			</ul>
		</div>

    </div>	
</body>
</html>

