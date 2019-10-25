#!/usr/bin/php
<?php
if ($argc != 4)
	echo "Incorrect Parameters\n";
else
{
	$av1 = trim($argv[1]);
	$av2 = trim($argv[2]);
	$av3 = trim($argv[3]);

	if (strcmp($av2, "+") == 0)
		echo ($av1 + $av3)."\n";
	else if (strcmp($av2, "-") == 0)
		echo ($av1 - $av3)."\n";
	else if (strcmp($av2, "*") == 0)
		echo ($av1 * $av3)."\n";
	else if (strcmp($av2, "/") == 0)
		echo ($av1 / $av3)."\n";
	else if (strcmp($av2, "%") == 0)
		echo ($av1 % $av3)."\n";
}
?>
