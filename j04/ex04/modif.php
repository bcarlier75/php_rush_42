<?php
if ($_POST['login'] && $_POST['oldpw'] && $_POST['newpw'] && $_POST['submit'] && $_POST['submit'] === "OK")
{
	$path = '../private/passwd';
	if (!file_exists('../private'))
		mkdir("../private");
	if (!file_exists($path))
	file_put_contents($path, null);
	$content = file_get_contents($path);
	$account = unserialize($content);
	if ($account)
	{
		$flag = 0;
		foreach ($account as $key => $val)
		{
			if ($val['login'] === $_POST['login'] && $val['passwd'] === hash('whirlpool', $_POST['oldpw']))
			{
				$flag = 1;
				$account[$key]['passwd'] =  hash('whirlpool', $_POST['newpw']);
			}
		}
		if ($flag)
		{
			file_put_contents($path, serialize($account));
			header('Location: index.html');
			echo "OK\n";
			exit();
		}
		else
			echo "ERROR\n";
	}
	else
		echo "ERROR\n";
}
else
	echo "ERROR\n";
?>
