<?php
function auth($login, $passwd)
{
	if (!file_exists('../private'))
		mkdir("../private");
	if (!file_exists('../private/passwd'))
		file_put_contents('../private/passwd', null);
	$content = file_get_contents('../private/passwd');
	$accounts = unserialize($content);
	if ($accounts)
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
