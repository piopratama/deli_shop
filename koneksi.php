<?php
	$servername = "sql130.main-hosting.eu";
	$username = "u610112734_deli";
	$password = "deli_123PP";
	$dbname = "u610112734_deli";
	/*$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "deli_shop";*/

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
?>