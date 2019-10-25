<?php
	session_start();
	if(!isset($_SESSION['cart']))
	{
		$_SESSION['cart'] = array();
		$_SESSION['total_items'] = 0;
		$_SESSION['total_price'] = '0.00';
	}
	//include("install.php");
	include("database_functions.php");
	include("cart_functions.php");
	$view = empty($_GET['view']) ? 'landing' : $_GET['view'];
	$sport = empty($_GET['sport']) ? '' : $_GET['sport'];
	$type = empty($_GET['type']) ? '' : $_GET['type'];

	$arr = array('index','shop','product','cart','add_to_cart','update_cart','order', 'error', 'foot', 'basket', 'volley', 'ping_pong', 'landing', 'empty_cart', 'admin', 'login', 'logout', 'create_user', 'modif_user');
	if(!in_array($view,$arr))
		$view = 'error';
?>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Sport factory</title>
		<link rel="stylesheet" href="pages/styles/landing.css">
	</head>
	<body>
		<div class="top_bar">
			<a href="index.php?view=landing">Home</a>
			<a href="index.php?view=shop">Shop</a>
			<a href="index.php?view=admin">Admin</a>

			<?php
			if ($_SESSION[loggued_on_user] == "")
			{
			?>	<a href="index.php?view=login">Login</a>
			<?php }
			else {
			?>	<a href="index.php?view=logout">Logout</a>
			<?php } ?>
			
			<?php
			if ($_SESSION[loggued_on_user] == "")
			{
			?>	<a href="index.php?view=create_user">Create User</a>
			<?php }
			else {
			?>	<a href="index.php?view=modif_user">Modif User</a>
			<?php } ?>
			
			<a href="index.php?view=cart" style="float:right;">
			<img src="images/cart.jpg" style="height:20px; margin: 0 10px;
			padding:0;" alt="cart">(<?=abs($_SESSION['total_items']);?>) | <?=$_SESSION['total_price'];?> €</a>
		</div>
		<?php
			if ($view == "add_to_cart")
			{
				$id = $_GET['id'];
				$add_item = add_to_cart($id);
				$_SESSION['total_items'] = total_items($_SESSION['cart']);
				$_SESSION['total_price'] = total_price($_SESSION['cart']);
				header('Location: index.php?view=product&id='.$id);
			}
			else if ($view == "empty_cart")
			{
				$_SESSION['cart'] = array();
				$_SESSION['total_items'] = 0;
				$_SESSION['total_price'] = '0.00';
				header('Location: index.php?view=cart');
			}
			else if ($view == "update_cart")
			{
				update_cart();
				$_SESSION['total_items'] = total_items($_SESSION['cart']);
				$_SESSION['total_price'] = total_price($_SESSION['cart']);
				header('Location: index.php?view=cart');
			}
			else if ($view == "error")
				include("pages/$view.php");
			else if ($view == "order" && $_SESSION['total_items'] != 0)
			{
				include("pages/$view.php");
			}
			else if ($view == "order" && $_SESSION['total_items'] == 0)
				header('Location: index.php?view=error');
			else if ($view == "admin")
				header('Location: pages/admin.php');
			else if ($view == "login")
				header('Location: pages/login.php');
			else if ($view == 'create_user')
				header('Location: pages/create_user.php');
			else if ($view == 'modif_user')
				header('Location: pages/modif_user.php');
			else if ($view == 'logout')
			{
				$_SESSION['cart'] = array();
				$_SESSION['total_items'] = 0;
				$_SESSION['total_price'] = '0.00';
				header('Location: pages/logout.php');
			}
			else
				include("pages/$view.php");
		?>
	</body>
</html>
