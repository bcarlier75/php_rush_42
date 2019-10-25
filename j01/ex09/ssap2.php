#!/usr/bin/php
<?php
function ft_cmp($str1, $str2)
{
	$str_A = strtolower($str1);
	$str_B = strtolower($str2);
	for($i = 0; ($i < strlen($str_A) && $i < strlen($str_B)); $i++)
	{
		$char_A = $str_A[$i];
		$char_B = $str_B[$i];
		if ($char_A == $char_B)
			continue;
		if(ctype_alpha($char_A))
		{
			if(ctype_alpha($char_B))
			{
				if(strcmp($char_A, $char_B) == 0)
					continue;
				return(strcmp($char_A, $char_B));
			}
			return(-1);
		}
		else if(is_numeric($char_A))
		{
			if(is_numeric($char_B))
				return(strcmp($char_A, $char_B));
			else if(ctype_alpha($char_B))
				return (1);
			return (-1);
		}
		else
		{
			if(!ctype_alpha($char_B) && !is_numeric($char_B))
				return (strcmp($char_A, $char_B));
			return (1);
		}
	}
	return(strlen($str_A) - strlen($str_B));
}

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
	usort($tab, "ft_cmp");
	foreach($tab as $elem)
		echo "$elem\n";
}
?>
