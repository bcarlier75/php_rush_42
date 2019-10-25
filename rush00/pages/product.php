<?php
	$id = $_GET['id'];
	$product = get_item_database($id);
	if ($product['name'] != ''){?>
	<div class="land" style="padding-top:60px; margin-top:0;">
		<h1><?=$product['name']?></h1>
		<img class="prodimg" src="<?=$product['path']?>">
		<p class="proddesc"><b>Sport: </b><a href = "index.php?view=shop&sport=<?=$product['sport_id']?>"><?=ucfirst($product['sport_id'])?></a></p>
		<p class="proddesc"><b>Price: </b><?=$product['price']?> €</p>
		<div class="shop_button" id="add">
			<a href="index.php?view=add_to_cart&id=<?=$product['id']?>">Add to cart</a>
		</div>
		<div class="shop_button" id="back">
			<a href="index.php?view=shop">Back to the shop</a>
		</div>
	</div>
<?php } else { ?>
	<div class="land" style="padding-top:60px; margin-top:0;">
		<h1>Item not found in our database ! 😢</h1>
	</div>
<?php } ?>
