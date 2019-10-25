<?php
if ($_POST['login'] && $_POST['passwd'] && $_POST['submit'] && $_POST['submit'] === "OK")
{
	if (!file_exists('../private'))
		mkdir("../private");
	if (!file_exists('../private/passwd'))
	file_put_contents('../private/passwd', null);
	$content = file_get_contents('../private/passwd');
	$accounts = unserialize($content);
	$flag = 0;
	if ($accounts)
	{
		foreach ($accounts as $key => $value)
		{
	    	if ($value['login'] === $_POST['login'])
				$flag = 1;
		}
	}
	if ($flag)
		echo "ERROR\n";
	else
	{
		$user['login'] = $_POST['login'];
		$user['passwd'] = hash('whirlpool', $_POST['passwd']);
		$accounts[] = $user;
		file_put_contents('../private/passwd', serialize($accounts));
		header('Location: index.html');
		echo "OK\n";
		exit();
	}
}
else
	echo "ERROR\n";
?>
