#!/usr/bin/php
<?php

function cmp($A, $B)
{
	return(strcmp($A[0], $B[0]));
}

function is_line_note($line)
{
	return(is_numeric($line[1]));
}

$flag = 0;
$my_array = array();
$users = array();
$final = array();
if($argc < 2)
	return;
while(!feof(STDIN))
{
    if(!($line = fgetcsv(STDIN, 0, ';')))
		break;
	array_push($my_array, $line);
}
$my_array = array_filter($my_array, 'is_line_note');
usort($my_array, 'cmp');

if($argv[1] == "moyenne")
{
	$count = 0;
	$sum = 0;
	foreach($my_array as $elem)
	{
		if ($elem[2] != "moulinette")
		{
			$sum += $elem[1];
			$count += 1;
		}
	}
	if($count != 0)
		echo ($sum / $count)."\n";
}
else if($argv[1] == "moyenne_user" || $argv[1] == "ecart_moulinette")
{
	foreach($my_array as $elem)
	{
		if(in_array($elem[0], $users) == false)
			array_push($users, array($elem[0], $elem[1], $elem[2]));
	}
	$name = $my_array[0][0];
	$moy =0;
	$iter =0;
	$moulinette =0;
	foreach($my_array as $elem)
	{
		if ($name != $elem[0])
		{
			if ($iter > 0)
				array_push($final, array($name, $moy/$iter, $moulinette));
			$name = $elem[0];
			$moy = 0;
			$iter =0;
			$moulinette =0;
		}
		if ($elem[2] == "moulinette")
			$moulinette = $elem[1];
		else
		{
			$moy += $elem[1];
			$iter += 1;
		}
	}
	if ($iter > 0)
		array_push($final, array($name, $moy/$iter, $moulinette));
	foreach($final as $user)
	{
		echo $user[0].":";
		if ($argv[1] == "moyenne_user")
			echo($user[1])."\n";
		if ($argv[1] == "ecart_moulinette")
			echo($user[1]- $user[2])."\n";
	}
}
?>
