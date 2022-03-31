<?php
	// include("connect.php");
	$servername = "db";
	$username = "root";
	$password = "very-secure-password";
	$dbName = "mydb";
	 
	// create connection
	$con = new mysqli($servername,$username,$password,$dbName);
	 
	// check connection
	if ($con->connect_error) {
		die("Fail to connect: " . $conn->connect_error);
	}
