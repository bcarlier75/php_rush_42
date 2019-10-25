#!/usr/bin/php
<?php
/*
Inspired by https://www.geekality.net/2011/05/12/php-how-to-get-all-images-from-an-html-page/
*/

// Return array with urls
function ft_urls_in_array($html)
{
	$my_array = array();
	$dom_doc = new DOMDocument();
	libxml_use_internal_errors(true);
	if (!$dom_doc->loadHTML($html))
		return (false);
	libxml_use_internal_errors(false);
	if (($images = $dom_doc->getElementsByTagName('img')))
	{
		foreach ($images as $img)
			array_push($my_array,$img->getAttribute("src"));
		if(!empty($my_array))
			return ($my_array);
	}
	return (false);
}

if($argc == 2 && filter_var($argv[1], FILTER_VALIDATE_URL))
{
	if (($request = curl_init($argv[1])))
	{
		curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
		$html = curl_exec($request);
		$array_urls = ft_urls_in_array($html);
		curl_close($request);
		if ($array_urls)
		{
			// Download images here
			foreach ($array_urls as $url)
			{
				// test if base_url ($argv[1]) is at the start of $url
				if (!preg_match("/^https?:\/\/(www\.)?.+/", $url))
					$url = $argv[1].$url;
				if(!($dir = parse_url($url,PHP_URL_HOST)))
					return (-1);
				if (!file_exists($dir) && !is_dir($dir))
					mkdir($dir);
				$img_name = basename($url);
				$file_p = fopen($dir . '/' . $img_name, 'wb');
				$request = curl_init($url);
				curl_setopt($request, CURLOPT_FILE, $file_p);
				curl_setopt($request, CURLOPT_HEADER, 0);
				curl_exec($request);
				curl_close($request);
				fclose($file_p);
			}
		}
	}
}
?>
