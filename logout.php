<?php
require 'config.php';

session_unset();

// Destroy the session
session_destroy();

// Delete the session ID cookie
setcookie(session_name(), '', time()-3600, '/');
 
?> 

 
<!DOCTYPE html>
<html>
<head> 
	<title>Logout</title>
	<style>
	.container {
      max-width: 500px;
      margin: 0 auto;
      background-color: #FAF0E6;
      border-radius: 10px;
      box-shadow: 0px 5px 10px rgba(0,0,0,0.1);
	  background-color: rgba(255, 255, 255, 0.5);      
      padding: 30px;
    }
	body {
	background-color: #ffffff;
	font-family: Arial, sans-serif;
	font-size: 16px;
	color: black;
	background-image: linear-gradient(to right, #8360c3, #2ebf91);
	}

	h1 {
	text-align: center;
	margin-top: 50px;
	}

	.top {
	text-align: center;
	margin-top: 30px;
	}

	a {
	color: #008CBA;
	text-decoration: none;
	}

	a:hover {
	text-decoration: underline;
	}
	</style>
</head>
<body>
	<div class="container">
	<h1>You have been logged out!</h1>
	<p class="top">Click <a href="index.php">here</a> to return to the login page.</p>
	</div>
</body>
</html>


