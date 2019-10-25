<?php
	$servername = "localhost";
	$username = "root";
	$password = "password";
	$db = "minishop";
		// Create connection
	$conn = mysqli_connect($servername, $username, $password);
	// Check connection
	if (!$conn)
        die("Connection failed: " . mysqli_connect_error().header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500));
	// Create database checking whether it exists
	$sql = "CREATE DATABASE IF NOT EXISTS $db";
	if (mysqli_query($conn, $sql))
		echo "";
	else
		echo "Error creating database: " . mysqli_error($conn);
	mysqli_close($conn);
	// Create connection with created db
	$conn = mysqli_connect($servername, $username, $password, $db);
	// Check connection
	if (!$conn)
		die("Connection failed: " . mysqli_connect_error());

	///////// CREATE AND LOAD TABLE sports_db /////////
	// sql to create table with sports
	$sql = "CREATE TABLE IF NOT EXISTS sports_db (
			id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			name VARCHAR(30) NOT NULL,
			sport_id VARCHAR(30) NOT NULL

			)";
	if (mysqli_query($conn, $sql))
		echo "";
	else
		echo "Error creating table: " . mysqli_error($conn);
	// loading data into table 'sports'
	$sql = "LOAD DATA LOCAL INFILE 'database/sports.csv'
			INTO TABLE sports_db
			FIELDS ENCLOSED BY '\"'
			TERMINATED BY ','
			IGNORE 1 ROWS";
	 if (mysqli_query($conn, $sql))
		echo "";
	 else
		echo "Error: " . $sql . "<br>" . mysqli_error($conn) . "<br>";
	

	///////// CREATE AND LOAD TABLE user_db /////////
	// sql to create table with users
	$sql = "CREATE TABLE IF NOT EXISTS user_db (
		id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		login VARCHAR(30) NOT NULL,
		password VARCHAR(128) NOT NULL,
		admin BOOLEAN NULL
		)";
	if (mysqli_query($conn, $sql))
		echo "";
	else
		echo "Error creating table: " . mysqli_error($conn);


	///////// CREATE AND LOAD TABLE products_db /////////
	// sql to create table with products
	$sql = "CREATE TABLE IF NOT EXISTS products_db (
			id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			name VARCHAR(60) NOT NULL,
			sport_id VARCHAR(30) NOT NULL,
			cat_id VARCHAR(30) NOT NULL,
			price INT NOT NULL,
			path VARCHAR(50) NOT NULL
			)";
	if (mysqli_query($conn, $sql))
		echo "";
	else
		echo "Error creating table: " . mysqli_error($conn);
	// loading data into table 'products'
	$sql = "LOAD DATA LOCAL INFILE 'database/products.csv'
			INTO TABLE products_db
			FIELDS ENCLOSED BY '\"'
			TERMINATED BY ','
			IGNORE 1 ROWS";
	if (mysqli_query($conn, $sql))
		echo "";
	else
	 	echo "Error: " . $sql . "<br>" . mysqli_error($conn);

	///////// CREATE AND LOAD TABLE orders_db /////////
    // sql to create table with sports
    $sql = "CREATE TABLE IF NOT EXISTS orders_db (
        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(30) NOT NULL,
        qty INT NULL,
        prix_produits INT NULL,
        total INT  NULL,
        login VARCHAR(30) NOT NULL
        )";
    if (mysqli_query($conn, $sql))
        echo "";
    else
        echo "Error: " . $sql . "<br>" . mysqli_error($conn) . "<br>";

	mysqli_close($conn);
?>
