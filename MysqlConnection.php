<?php
$servername = "localhost"; 
$username = "root"; 
$password = "K1@rein3"; //enter your password
$dbname = "realestatecompany"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>