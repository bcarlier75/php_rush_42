<?php
if ($_GET["action"] === "set")
	setcookie($_GET["name"], $_GET["value"], time() + 3600);
else if ($_GET["action"] === "get" && $value = $_COOKIE[$_GET["name"]])
	echo "$value\n";
else if ($_GET["action"] == "del")
	setcookie($_GET["name"], "", time() - 3600);


/*if (array_key_exists("action", $_GET))
{
	if ($_GET["action"] === "set")
	{
		setcookie($_GET["name"], $_GET["value"], time() + 3600);
	}
	else if ($_GET["action"] === "get" && $value = $_COOKIE[$_GET["name"]])
	{
		if (strlen($_COOKIE[$cookie_name]) > 0)
			echo $_COOKIE[$cookie_name]."\n";
	}
	else if ($_GET["action"] === "del")
	{
		$cookie_name = $_GET["name"];
		setcookie($_GET["name"], "", -1);
	}
}*/

?>
