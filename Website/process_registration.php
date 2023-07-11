<?php
require 'config.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $parts = explode('@', $email);
    $roll_number_parts = explode('_', $parts[0]);
    $roll_number = $roll_number_parts[1];

    // Validate email address format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_msg = "Invalid email address format";
    } else {
        // Check if email already exists in database
        
        $sql = "SELECT * FROM student_login WHERE email = '$email'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $error_msg = "Email address already registered";
        } else {
            // Check if password and confirm password match
            if ($password != $confirm_password) {
                $error_msg = "Passwords do not match";
            } else {
                // Generate verification token
                $verification_token = bin2hex(random_bytes(32));
                
                // Insert user data into database
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO student_login (email, roll_number, first_name, last_name, password, verification_token) VALUES ('$email', '$roll_number', '$first_name', '$last_name', '$hashed_password', '$verification_token')";

                $sql2 = "INSERT INTO student_details (roll_number) VALUES ('$roll_number');";
                $sql3 = "INSERT INTO student_placement (roll_number) VALUES ('$roll_number')";

                if (mysqli_query($conn, $sql) && mysqli_query($conn, $sql2) && mysqli_query($conn,$sql3)) 
                {
                    echo "<script>alert('Please verify your email to finish the registration process');</script>";


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
                    $mail->addAddress($email);
                    $url = 'http://localhost/miniproject_dbms/verify_email.php?token='.$verification_token;


                    $message = 'Please click the following link to verify your email address:'.$url;

                    //Email content
                    
                    $mail->Subject = "Verify your email address";
                    $mail->Body = "$message";

                    try 
                    {
                        //Send the email
                        $mail->send();
                        echo "<script>window.location='student_login.html'</script>";
                    } 
                    catch (Exception $e) 
                    {
                        //Handle any exceptions that are thrown
                        echo "<script>alert('Message could not be sent. Error: {$mail->ErrorInfo}');</script>";
                    }



                    // Send verification email
                    // $to = $email;
                    // $subject = "Verify your email address";
                    // $message = "Please click the following link to verify your email address: http://localhost/TPC/student/verify_email.php?token=$verification_token";
                    // $headers = "From: verifier <randomuserchosen@gmail.com>\r\n";
                    // $headers .= "Do not reply\r\n";
                    // $headers .= "Content-type: text/html\r\n";

                    // mail($to, $subject, $message, $headers);

                    // // Redirect to login page
                    // echo "<script>window.location='student_login.html'</script>";
                    // // header("Location: student_login.php");
                    // exit();
                } 
                else {
                    $error_msg = "Error: " . mysqli_error($conn);
                }
            }
        }

        mysqli_close($conn);

        if (isset($error_msg)) {
            echo "<script>alert('$error_msg');</script>";
            echo "<script>window.location='student_registration.html'</script>";
            // header("Location : student_register.php");
            exit();
        }
    }
}

?>
