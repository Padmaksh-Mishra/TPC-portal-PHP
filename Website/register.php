<?php
require 'config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';


if (isset($_POST["Submit"])) 
{
    $first_name= $_POST["fName"];
    $email = $_POST["email"];
    $contact = $_POST["contact"];

    echo '<script type="text/javascript">alert("You will shortly receive your credentials via email after our TPC officer verifies your request!")</script>';

    $mail = new PHPMailer(true);
    //$mail->SMTPDebug=3;
    
    //SMTP settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'randomuserchosen@gmail.com';
    $mail->Password = 'bxebezfpilbbvfna';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->isHTML(true);

    //Sender and recipient information
    $mail->setFrom('randomuserchosen@gmail.com');
    $mail->addAddress('rajnishbhagat4@gmail.com');

    $shortkey = 'pass'.$first_name.'';
    $url = 'http://localhost/miniproject_dbms/admin_verification.php?key1='.$first_name.'&key2='.$email.'&key3='.$shortkey.'&key4='.$contact;
  
    $message = 
    '<html>
    <head>
      <title>Company Verification Email!</title>
    </head>
    <body>
      <h3>Respected Sir,</h3>
      <p>Below are the credentials of a company trying to register on the TPC portal. If you find the domain name of the Email-Id, and the company to be legitimate, kindly click on the link below to register the company on the portal.</p>
      
      <p>Name: '.$first_name.'</p>
      <p>Email-Id: '.$email.'</p>
      <p>Contact Number: '.$contact.'</p>
      <p>Initial Password: '.$shortkey.'</p>
      
      <a href="'.$url.'">Register the firm!</a>
      
      <p>Thank You.</p>
    </body>
    </html>';

    //Email content
    ;
    $mail->Subject = "Company Verification";
    $mail->Body = "$message";


    try 
    {
        //Send the email
        $mail->send();
    } 
    catch (Exception $e) 
    {
        //Handle any exceptions that are thrown
        echo "<script>alert('Message could not be sent. Error: {$mail->ErrorInfo}');</script>";
    }
    $conn->close();
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>User Registration</title>

  <style>
    body {
      background-size: cover;
      background-color: #f5f5f5;
      background-image: linear-gradient(to right, #8360c3, #2ebf91);
    }

    .container {
      position: absolute;
      top: 40%;
      left: 50%;
      transform: translate(-50%, -50%);
      max-width: 500px;
      margin: 0 auto;
      background-color: rgba(255, 255, 255, 0.5);      
      border-radius: 10px;
      box-shadow: 0px 5px 10px rgba(0,0,0,0.1);
      padding: 30px;
    }

    h1 {
      text-align: center;
      font-size: 36px;
      margin-bottom: 20px;
      color: #333;
      text-transform: uppercase;
      letter-spacing: 3px;
      font-weight: 900;
    }

    label {
      font-size: 16px;
      font-weight: 500;
      color: #666;
      text-transform: uppercase;
      letter-spacing: 2px;
      margin-top: 20px;
      display: block;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      font-size: 16px;
      border-radius: 5px;
      border: 1px solid #ccc;
      margin-top: 10px;
      box-sizing: border-box;
      background-color: #f9f9f9;
      color: #666;
    }

    input[type="submit"] {
      background-color: #008000;
      color: #fff;
      padding: 10px 20px;
      font-size: 16px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      margin-top: 20px;
      box-sizing: border-box;
      text-transform: uppercase;
      letter-spacing: 2px;
      font-weight: 500;
    }

    input[type="submit"]:hover {
      background-color: #555;
    }

    p.top {
      text-align: center;
      margin-top: 20px;
      margin-bottom: 0;
      font-size: 16px;
      color: #666;
    }

    a {
      color: #333;
      text-decoration: none;
      font-weight: 500; 
    }

    a:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>
  <div class="container">
    <h1>Company Registration</h1>

    <?php if (isset($error)): ?>
      <p><?php echo $error; ?></p>
    <?php endif; ?>

    <form action="" method="post">
      <label for="FirstName">Name</label>
      <input type="text" id="FirstName" name="fName" required>
      
      <label for="Email">Email Address</label>
      <input type="text" id="Email" name="email" required>

      <label for="contact">Contact Number</label>
      <input type="text" id="contact" name="contact" required>

      <input type="submit" value="Register" name="Submit">
      <p class="top">Already a verified User? <a href="login.php">Login</a></p>
    </form>
  </div>
</body>
</html>





