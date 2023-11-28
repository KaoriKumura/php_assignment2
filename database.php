<?php
//Database Connectivity
$servername = "localhost";
$username = "root";
$password = "";
$database = "student_db";

//creating a connection
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
	die("Sorry, connection failed!" . $conn->connect_error);
}

echo "";

?>