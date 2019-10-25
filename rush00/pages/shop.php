<div class="land" style="padding-top:9px;">
	<div class="nav_sports">
		<p>By sport:</p>
		<a href="index.php?view=shop&sport=Football">Football</a>
		<a href="index.php?view=shop&sport=Basketball">Basketball</a>
		<a href="index.php?view=shop&sport=Volleyball">Volley</a>
		<a href="index.php?view=shop&sport=Ping-pong">Ping-Pong</a>
		<p>By type:</p>
		<a href="index.php?view=shop&type=shoes">Shoes</a>
		<a href="index.php?view=shop&type=ball">Ball</a>
		<a href="index.php?view=shop&type=accessories">Accessories</a>
		<a href="index.php?view=shop" style="margin-left:100px"><b>Reset filter</b></a>
	</div>
	<br><br><br><br>
	<?php
	if (!$sport && !$type)
	{
		$products = get_products_database();
		if ($products)
		{
			foreach($products as $item)
			include("pages/item.php");
		}
	}
	else if ($sport)
	{
		$products = get_products_sport_database($sport);
		if($products)
		{
			foreach($products as $item)
				include("pages/item.php");
		}
	}
	else if ($type)
	{
		$products = get_products_type_database($type);
		if($products)
		{
			foreach($products as $item)
				include("pages/item.php");
		}
	}
	?>
</div>
