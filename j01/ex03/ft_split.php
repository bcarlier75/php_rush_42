<?php
function ft_split($str)
{
	$exploded_str = explode(" ", $str);
	$output = array_filter($exploded_str, 'strlen');
	sort($output, SORT_STRING);
	return($output);
}
?>
