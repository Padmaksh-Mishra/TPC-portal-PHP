<?php
$servername = "localhost";
$username = "root"; 
$password = "Rajnish@7000";  
$dbname = "TPC";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection 

if ($conn->connect_error) 
{
    die("Connection failed: " . mysqli_connect_error());
}
?>