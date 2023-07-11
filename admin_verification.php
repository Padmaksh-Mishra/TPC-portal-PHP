<?php
require 'config.php';


// if(!isset($_SESSION['admin_id']))
// {
//   header('Location: login_admin.php'); // redirecting the user to another link
// }

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$name = $_GET['key1'];
$email = $_GET['key2'];
$passwordx = $_GET['key3'];

if (isset($_POST["Submit"]) ) 
{
    $first_name= $_POST["fName"];
    $email = $_POST["email"];
    $password = $_POST["pass1"];
 
    $sql = "INSERT INTO companies(name,email,password) VALUES('$first_name', '$email', '$password')"; 

    if ($conn->query($sql) === TRUE) 
    {
        echo '<script type="text/javascript">alert("Registration Successfull!")</script>';
    } 
    else 
    {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $mail = new PHPMailer(true);
    
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
    $mail->addAddress($email);
  
    $message = 
    '<html>
    <head>
      <title>Company Verification Email!</title>
    </head>
    <body>
      <h3>Respected Sir,</h3>
      <p>Your company details have been verified. Below are your login credentials for the TPC Portal of IIT Patna. Do not forget to change your password once logged in!</p>
      
      <p>Email-Id/ Username: '.$email.'</p>
      <p>Initial Password: '.$passwordx.'</p>
      
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




    // Close the database connection
    $conn->close();
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>User Registration</title>

  <style>
    body {
      background-color: #f1f1f1;
      font-family: 'Roboto', sans-serif;
      background-image: linear-gradient(to right, #8360c3, #2ebf91);

    }

    .container {
      position: absolute;
      top: 40%;
      left: 50%;
      transform: translate(-50%, -50%);
      max-width: 700px;
      margin: 0 auto;
      background-color: #FAF0E6;
      border-radius: 10px;
      box-shadow: 0px 5px 10px rgba(0,0,0,0.1);
      padding: 30px;
      background-color: rgba(255, 255, 255, 0.5);      

    }

    h1 {
      text-align: center;
      font-size: 33px;
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
      background-color: #333;
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
    <h1>Company Registration - PIC TPC</h1>

    <?php if (isset($error)): ?>
      <p><?php echo $error; ?></p>
    <?php endif; ?>

    <form action="" method="post">
      <label for="FirstName">Name</label>
      <input type="text" id="FirstName" name="fName" value="<?php echo $name ?>" required>
      
      <label for="Email">Email Address</label>
      <input type="text" id="Email" name="email" value="<?php echo $email ?>" required>

      <label for="Password1">Password</label>
      <input type="password" id="Password1" name="pass1" value="<?php echo $passwordx ?>" required>

      <input type="submit" value="Register" name="Submit">
  </form>
</body>
</html>





