<?php

function get_products_database()
{
	include("db.php");
	$sql = "SELECT * FROM products_db ORDER BY id ASC";
	$result = mysqli_query($conn,$sql);
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$products[] = $row;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
	return($products);
}

function get_products_sport_database($sport)
{
	include("db.php");
	$sql = "SELECT * FROM products_db WHERE sport_id='$sport' ORDER BY id ASC";
	$result = mysqli_query($conn,$sql);
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
		$products[] = $row;
	mysqli_free_result($result);
	mysqli_close($conn);
	return($products);
}

function get_products_type_database($type)
{
	include("db.php");
	$sql = "SELECT * FROM products_db WHERE cat_id='$type' ORDER BY id ASC";
	$result = mysqli_query($conn,$sql);
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
		$products[] = $row;
	mysqli_free_result($result);
	mysqli_close($conn);
	return($products);
}

function get_type_database()
{
	include("db.php");
	$sql = "SELECT * FROM sports_db ORDER BY id ASC";
	$result = mysqli_query($conn,$sql);
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$types[] = $row;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
	return($types);
}

function get_item_database($id)
{
	include("db.php");
	$sql = "SELECT * FROM products_db WHERE id='$id' ";
	$result = mysqli_query($conn,$sql);
	$item = mysqli_fetch_array($result, MYSQLI_ASSOC);
	mysqli_free_result($result);
	mysqli_close($conn);
	return($item);
}
?>
