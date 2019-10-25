#!/usr/bin/php
<?php
if ($argc > 1)
{
	$i = 1;
	while($i < $argc)
	{
		$string .= " ".$argv[$i]." ";
		$i++;
	}
	$string_t = trim($string);
	while((strpos($string_t, "  ")) == true)
		$string_t = str_replace("  ", " ", $string_t);
	$tab = explode(" ", $string_t);
	sort($tab);
	foreach($tab as $elem)
		echo "$elem\n";
}
?>
