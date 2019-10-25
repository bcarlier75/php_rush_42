#!/usr/bin/php
<?php
if($argc > 2)
{
	$mykey = $argv[1];
	$i = 2;
	$found = null;
	$nbr_mykey = substr_count($mykey, ':');
	while($i < $argc)
	{
		$string = $argv[$i];
		if (($pos = strpos($string, ':')) === false)
		{
			$i++;
			continue;
		}
		$j = 0;
		while($j < $nbr_mykey)
		{
			if (($pos = strpos($string, ':', $pos + 1)) === false)
				break;
			$j++;
		}
		if ($j < $nbr_mykey)
		{
			$i++;
			continue;
		}
		$key = substr($argv[$i], 0, $pos);
		$value = substr($argv[$i], $pos + 1);
		if($key == $mykey)
			$found = $value;
		$i++;
	}
	if($found)
		echo $found."\n";
}
?>
