#!/usr/bin/php
<?php
if ($argc != 2)
{
	echo "Incorrect Parameters\n";
	return(-1);
}
$tab1 = preg_split("* *", $argv[1], -1, PREG_SPLIT_NO_EMPTY);
$tab = array();
foreach($tab1 as $elem)
{
	$tab2 = preg_split('/(\+|\-|\*|\/|\%)/', $elem, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
	$tab = array_merge($tab, $tab2);
}
$p0 = array_shift($tab);
if ($p0 == "-" || $p0 == "+")
	$p0 = $p0.array_shift($tab);
$p1 = array_shift($tab);
$p2 = array_shift($tab);
if ($p2 == "-" || $p2 == "+")
	$p2 = $p2.array_shift($tab);

array_unshift($tab, $p2);
array_unshift($tab, $p1);
array_unshift($tab, $p0);

$nb_param = count($tab);
if($nb_param != 3)
{
	echo("Syntax Error\n");
	return(-1);
}
if(!is_numeric($tab[0]) || !is_numeric($tab[2]))
{
	echo("Syntax Error\n");
	return(-1);
}
	if (strcmp($tab[1], "+") == 0)
		echo ($tab[0] + $tab[2])."\n";
	else if (strcmp($tab[1], "-") == 0)
		echo ($tab[0] - $tab[2])."\n";
	else if (strcmp($tab[1], "*") == 0)
		echo ($tab[0] * $tab[2])."\n";
	else if (strcmp($tab[1], "/") == 0)
		echo ($tab[0] / $tab[2])."\n";
	else if (strcmp($tab[1], "%") == 0)
		echo ($tab[0] % $tab[2])."\n";
?>
