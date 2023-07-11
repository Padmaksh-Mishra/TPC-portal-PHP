<?php

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
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;

// Get the user data from the form
$firstName = $_POST['first_name'];
$lastName = $_POST['last_name'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
echo '1';

if (empty($firstName) || empty($lastName) || empty($email) ) {
    $error = "All fields are required.";
} else {
    if (empty($password) || empty($confirm_password) || empty($firstName) || empty($lastName) || empty($email) ) {
        $error = "All fields are required.";
    }

    if ( $password != $confirm_password) {
        $error = "Confirm password is not same as the password.";
    }

    $emailDomain = "@iitp.ac.in";
    if (strpos($email, $emailDomain) !== false) {
        $startPos = strpos($email, "_") + 1;
        $endPos = strpos($email, "@");
        $roll = substr($email, $startPos, $endPos - $startPos);
    } else {
        $error = "Email domain is not correct. Please use @iitp.ac.in domain.";
    }
    // Generate a random password
    $token = generateRandomPassword();
    echo '2';
    // Hash the password
    $hashedtoken = password_hash($token, PASSWORD_DEFAULT);
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $verified = 0;
    // Check for database connection error
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    echo '3';
    echo $roll;
    echo $token;
    // Insert the user data into the table
    $sql = "INSERT INTO alumni_login (roll_number, email, first_name, last_name, password, verification_token, verified) VALUES ('$roll','$email', '$firstName', '$lastName', '$hashedPassword', '$hashedtoken', '$verified')";
    $sql_academic_profile = "INSERT INTO alumni_academic_profile (roll_number) VALUES ('$roll')";
    echo '5'; 
    $result_1 = $conn->query($sql);
    echo '4';
    $result_academic_profile = $conn->query($sql_academic_profile);
    echo '6';
    if ($result_1 && $result_academic_profile) {
        // Close the database connection
        mysqli_close($conn);

        // echo '<script type="text/javascript">alert("You will shortly receive an email informing further steps!")</script>';
        // Send the password to the user's email using PHPMailer
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  // Replace with your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'randomuserchosen@gmail.com';  // Replace with your email address
        $mail->Password = 'bxebezfpilbbvfna';  // Replace with your email password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->setFrom('randomuserchosen@gmail.com', 'Your Name');  // Replace with your name and email address
        $mail->addAddress($email);  // Recipient's email address
        $mail->Subject = 'Verification of your TPC account';
        $mail->isHTML(true);

    $shortkey = 'pass'.$first_name.'';
    $url = 'http://localhost/MiniProject/Alumni/verification.html';
    $message = 
    '<html>
    <head>
      <title>Alumni Verification Email!</title>
    </head>
    <body>
      <h3>Respected Sir,</h3>
      <p>You have recently tried to register on the TPC portal. If you feel that the credentials are correct and you voluntarily did this. Please click on the link below.</p>
      
      <p>Name: '.$firstName.' '. $lastName.'</p>
      <p>Email-Id: '.$email.'</p>
      <p>Verification Token: '.$token.'</p>
      <a href="'.$url.'">Verify yourself by clicking on this link!</a>
      
      <p>Thank You.</p>
    </body>
    </html>';
    $mail->Body = $message;

        if ($mail->send()) {
            // Redirect to an HTML page
            echo '<script type="text/javascript">alert("You will shortly receive an email informing further steps!")</script>';
            echo '<script language="javascript">window.location = "http://localhost/MiniProject/Alumni/verification.html";</script>';
        } else {
            echo "Failed to send password email. Please try again later. Error: " . $mail->ErrorInfo;
        }
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

function generateRandomPassword() {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $password = '';
    $length = 8;  // Change this to the desired length of the password

    for ($i = 0; $i < $length; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $password .= $characters[$index];
    }

    return $password;
}
?>
