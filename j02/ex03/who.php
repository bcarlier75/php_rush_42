#!/usr/bin/php
<?php
date_default_timezone_set('Europe/Paris');
$fd = fopen("/var/run/utmpx", "r");
while ($var_utmpx = fread($fd, 628)) // 628 = taille utmpx / nb lignes
{
	$temp = unpack("a256user/a4id/a32line/ipid/itype/I2time/a256host/i16pad", $var_utmpx);
	$tab[$temp['line']] = $temp;
}
foreach ($tab as $t)
{
	if ($t['type'] == 7) // USER_PROCESS -> Normal process
	{
		echo str_pad(substr(trim($t['user']), 0, 8), 8, " ")." ";
		echo str_pad(substr(trim($t['line']), 0, 8), 8, " ")." ";
		echo date("M", $t["time1"]);
		echo str_pad(date("j", $t["time1"]), 3, " ", STR_PAD_LEFT)." ".date("H:i", $t["time1"]);
		echo " ";
		echo "\n";
	}
}
?>
