#!/usr/bin/php
<?php
date_default_timezone_set('Europe/Paris');

$months = array(
		"janvier" => 1,
		"fevrier" => 2,
		"f\xc3\xa9vrier" => 2,
		"mars" => 3,
		"avril" => 4,
		"mai" => 5,
		"juin" => 6,
		"juillet" => 7,
		"aout" => 8,
		"ao\xc3\xbbt" => 8,
		"septembre" => 9,
		"octobre" => 10,
		"novembre" => 11,
		"decembre" => 12,
		"d\xc3\xa9cembre" => 12,
);

$days = array(
		"Monday" => "lundi",
		"Tuesday" => "mardi",
		"Wednesday" => "mercredi",
		"Thurday"=> "jeudi",
		"Friday" => "vendredi",
		"Saturday" => "samedi",
		"Sunday" => "dimanche",
);

if ($argc != 2)
	return(-1);
$str_tab = preg_split("* *", $argv[1], -1, PREG_SPLIT_NO_EMPTY);
if (count($str_tab) != 5)
{
	echo"Wrong Format\n";
	return(-1);
}
$temp = substr($str_tab[0], 0, 1);
$temp = strtolower($temp);
$str_tab[0] = substr_replace($str_tab[0], $temp, 0, 1);

$temp = substr($str_tab[2], 0, 1);
$temp = strtolower($temp);
$str_tab[2] = substr_replace($str_tab[2], $temp, 0, 1);

if (($str_tab[0] = array_search($str_tab[0], $days, TRUE)) == false
	|| (array_key_exists($str_tab[2], $months)) == false)
{
	echo"Wrong Format\n";
	return(-1);
}
$str_tab[2] = $months[$str_tab[2]];
$day_letter = array_shift($str_tab);
$day_num = array_shift($str_tab);
$month = array_shift($str_tab);
$year = array_shift($str_tab);

if (is_numeric($day_num) === false
	|| strlen($day_num) > 2
	|| strpos($day_num, '.') !== false
	|| strpos($day_num, '+') !== false
	|| strpos($day_num, '-') !== false
	|| is_numeric($month) === false
	|| is_numeric($year) === false
	|| strlen($year) !== 4
	|| strpos($year, '+') !== false
	|| strpos($year, '-') !== false
	|| strpos($year, '.') !== false
	|| checkdate($month, $day_num, $year) === false
	)
{
	echo"Wrong Format\n";
	return(-1);
}
$hour_split = explode(":", $str_tab[0]);
if (count($hour_split) != 3)
{
	echo"Wrong Format\n";
	return(-1);
}
foreach($hour_split as $elem)
{
	if (strlen($elem) != 2
		|| strpos($elem, '+') !== false
		|| strpos($elem, '.') !== false
		|| strpos($elem, '-') !== false)
	{
		echo"Wrong Format\n";
		return(-1);
	}
}

$hour = array_shift($hour_split);
$min = array_shift($hour_split);
$sec = array_shift($hour_split);

$mytime = mktime($hour, $min, $sec, $month, $day_num, $year);
if (!($mytime) || date("l", $mytime) != $day_letter)
{
	echo"Wrong Format\n";
	return(-1);
}
echo $mytime."\n";
?>
