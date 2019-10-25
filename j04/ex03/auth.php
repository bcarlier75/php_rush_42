<?php
function auth($login, $passwd)
{
	if (!$login || !$passwd)
		return false;
	$content = file_get_contents('../private/passwd');
	$accounts = unserialize($content);
	if ($accounts !== false)
	{
		foreach ($accounts as $key => $value)
		{
			if ($value['login'] === $login && $value['passwd'] === hash('whirlpool', $passwd))
				return true;
		}
	}
	return false;
}
?>
