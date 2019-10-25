#!/usr/bin/php
<?php
if (file_exists($argv[1]))
{
	$fd = fopen($argv[1], 'r');
	$new = "";
	while ($fd && !feof($fd))
		$new .= fgets($fd);
	$regex_main = '/(<a )(.*?)(>)(.*)(<\/a>)/s';
	$new = preg_replace_callback($regex_main,
	function ($matches)
	{
		$matches[0] = preg_replace_callback('/( title=\")(.*?)(\")/s',
		function ($matches)
		{
			return ($matches[1].strtoupper($matches[2]).$matches[3]);
		}, $matches[0]);
		$matches[0] = preg_replace_callback('/(>)(.*?)(<)/s',
		function ($matches)
		{
			return ($matches[1].strtoupper($matches[2]).$matches[3]);
		}, $matches[0]);
		return ($matches[0]);
	}, $new); // end of main preg
	echo $new;
}
?>
