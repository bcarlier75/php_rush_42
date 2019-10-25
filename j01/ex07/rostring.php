#!/usr/bin/php
<?php
if ($argc > 1)
{
	$s = $argv[1];
	while((strpos($s, "  ")) == true)
		$s = str_replace("  ", " ", $s);
	$tab = explode(" ", $s);
	$nb_words = count($tab);
	
	$i = 1;
	while ($i < $nb_words)
		echo $tab[$i++]." ";
	echo $tab[0]."\n";
}
?>
