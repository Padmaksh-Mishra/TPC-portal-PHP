<?php
require 'config.php';

if(isset($_POST["Submit"])) 
{
    $email = $_POST["email"]; 
    $pass = $_POST["pass"];

    $query = "select * from companies where email = '$email' and password = '$pass'";

    $result = mysqli_query($conn, $query); 

    $row = mysqli_fetch_array($result);// row gets stored as an array
    $role = "";

    if (mysqli_num_rows($result) != 0)
    {
        session_start();
        $_SESSION['sess_user_email'] = $email;
        $_SESSION['sess_user_id'] = $row["id"];

        header ('Location: after_login_menu_dashboard.php'); // redirecting user to another link
    }
    else
    {
        echo '<script type="text/javascript">alert("Invalid Email or Password!")</script>';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Logins</title>
    <style>
        .container {
            position: absolute;
            top: 40%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(255, 255, 255, 0.5); /* set alpha value to 0.5 for semi-transparent background */
            padding: 20px;
            max-width: 500px;
            margin: 0 auto;
            /* background-color: #FAF0E6; */
            border-radius: 10px;
            box-shadow: 0px 5px 10px rgba(0,0,0,0.1);
            padding: 30px;
        }

        body {
            background-size: cover;
            background-color: #f5f5f5;
            background-image: linear-gradient(to right, #8360c3, #2ebf91);		
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
            font-size: 1.5rem;
            color: #4a4a4a;
            margin-bottom: 1rem;
            display: block;
        }

        input[type="text"],
        input[type="password"] {
            font-size: 1.5rem;
            padding: 0.5rem;
            width: 100%;
            border: 0;
            border-radius: 0.25rem;
            box-shadow: inset 0 0.1rem 0.25rem rgba(0, 0, 0, 0.1);
            margin-bottom: 1rem;
            color: #4a4a4a;
        }

        input[type="submit"] {
            font-size: 1.5rem;
            background-color: #008000;
            color: #ffffff;
            padding: 0.5rem 1rem;
            border: 0;
            border-radius: 0.25rem;
            transition: background-color 0.2s ease-in-out;
        }

        input[type="submit"]:hover {
            background-color: #555;
            cursor: pointer;
        }

        .top {
            font-size: 1.5rem;
            color: #4a4a4a;
            text-align: center;
            margin-top: 2rem;
        }

        .top a {
            color: #333;
            text-decoration: none;
        }

        .top a:hover {
            text-decoration: underline; 
        }
    </style>
</head>

<body>
    <div class="container">
    <h1>Company Login</h1>
    <form action="" method="post">
        <?php if (isset($error)): ?>
            <p><?php echo $error; ?></p>
        <?php endif; ?>

        <label for="email">Emails:</label>
        <input type="text" id="email" name="email" required>

        <label for="pass">Password:</label>
        <input type="password" id="pass" name="pass" required>

        <input type="submit" value="Login" name="Submit">
        <div class="top">Don't have an account? <a href="register.php">Register</a></div>
    </form>
    </div>
</body>
</html>



