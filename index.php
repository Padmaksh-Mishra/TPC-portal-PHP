<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TPC HOME</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .form input[type="submit"] {
            background-color: #27ae60;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .form input[type="submit"]:hover {
            background-color: #2ecc71;
        }
        .error {
            color: #ff0000;
            font-size: 18px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <?php
        if(isset($_POST['submit'])) {
            $role = $_POST['role'];
            if($role == 'student') {
                header('Location:student_login.html');
            }
            elseif($role == 'alumni') {
                header('Location: alumni_login.php');
            }
            elseif($role == 'company') {
                header('Location: login.php');
            }
            else {
                $error = "Invalid role selected.";
            }
        }
    ?>
    <div class="page">
        <div class="form">
            <h2>Please select your role to login:</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="home">
                <select class="select" name="role" id="role">
                    <option value="">Select your role</option>
                    <option value="student">Student</option>
                    <option value="alumni">Alumni</option>
                    <option value="company">Company</option>
                </select>
                <br>
                <input type="submit" name="submit" value="Enter">
            </form>
            <?php if(isset($error)) { echo "<p class='error'>$error</p>"; } ?>
        </div>
    </div>
</body>
</html>
