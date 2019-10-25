<?php
	$servername = "localhost";
	$username = "root";
	$password = "password";
	$db = "minishop";
	// Create connection
	$conn = mysqli_connect($servername, $username, $password, "minishop", 128);
	// Check connection
	if (!$conn) {
        die("Connection failed: " . mysqli_connect_error().header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500));
    }
?>
