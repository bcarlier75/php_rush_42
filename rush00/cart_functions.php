<?php

function add_to_cart($id)
{
	if(isset($_SESSION['cart'][$id]))
	{
		$_SESSION['cart'][$id]++;
		return true;
	}
	else
	{
		$_SESSION['cart'][$id] = 1;
		return true;
	}
	return false;
}

function update_cart()
{
	foreach($_SESSION['cart'] as $id => $qty)
	{
		if($_POST[$id] == '0')
			unset($_SESSION['cart'][$id]);
		else
			$_SESSION['cart'][$id] = $_POST[$id];
	}
}

function total_items($cart)
{
	$nb_items = 0;
	if(is_array($cart))
	{
		foreach($cart as $id => $nb)
			$nb_items += $nb;
	}
	return $nb_items;
}

function total_price($cart)
{
	$total_price = 0.0;
	$servername = 'localhost';
	$username = 'root';
	$password = 'password';
	$db = 'minishop';
	$conn = mysqli_connect($servername, $username, $password, $db);
	if (mysqli_connect_errno())
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	if(is_array($cart))
	{
		foreach($cart as $id => $nb)
		{
			$sql = "SELECT * FROM products_db WHERE id='$id'";
			$result = mysqli_query($conn,$sql);
			if($result)
			{
				$line = mysqli_fetch_array($result, MYSQLI_ASSOC);
				$item_price = $line['price'];
				$total_price += $item_price * abs($nb);
			}
		}
	}
	return $total_price;
}

function order_received()
{
	include("db.php");
	foreach($_SESSION['cart'] as $id => $quantity)
	{
		$product = get_item_database($id);
		$sql_name = $product['name'];
		$sql_qty = abs($quantity);
		$sql_price = $product['price'];
		$sql_total = $sql_qty * $sql_price;
		$sql_login = $_SESSION[loggued_on_user];
		$sql = "INSERT INTO orders_db (name, qty, prix_produits, total, login)
				VALUES ('$sql_name', $sql_qty, $sql_price,$sql_total,'$sql_login')
				";
		if (mysqli_query($conn, $sql))
			echo "New record created successfully";
		else
    		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		usleep(900000);
	}
}
?>
