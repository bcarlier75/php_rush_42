<?php
session_start();
include("../cart_functions.php");
if ($_SESSION[loggued_on_user] == "")
	header('Location: pages/login.php');
else
{
	order_received();
	$_SESSION['cart'] = array();
	$_SESSION['total_items'] = 0;
	$_SESSION['total_price'] = '0.00';
}
?>

<div class="land" style="padding-top:50px;">
	<h1 style="font-size:60px;">Your order has been well received.<br>Thank you !</h1>
	<p>We will get back to you with your delivery informations.</p>
	<div class="shop_button">
		<a href="index.php?view=shop">
		<img src="images/cart.jpg" alt="Cart">Go back to shop</a>
	</div>
</div>
