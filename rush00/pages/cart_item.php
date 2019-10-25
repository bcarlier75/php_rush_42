<tr>
	<td style="width:50px;"><a href="index.php?view=product&id=<?=$product['id']?>">
		<img src="<?=$product['path']?>"></a></td>
	<td><a href="index.php?view=product&id=<?=$product['id']?>">
		<?=$product['name']?></a></td>
	<td><?=number_format($product['price'],2);?> €</td>
	<td><input type="text" size="2" name="<?=$id;?>" maxlength="2"
		style="font-size:16px; font-family:'Trebuchet MS', Helvetica, sans-serif;
		text-align:center;" value="<?=abs($quantity);?>"></td>
	<td><?=number_format($product['price'] * abs($quantity) ,2);?> €</td>
</tr>
