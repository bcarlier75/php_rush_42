#!/usr/bin/php
<?php
if ($argc > 1)
{
	$string_t = trim($argv[1]);
	while ((strpos($string_t, "  ")) == TRUE)
		$string_t = str_replace("  ", " ", $string_t);
	echo("$string_t\n");
}
?>
