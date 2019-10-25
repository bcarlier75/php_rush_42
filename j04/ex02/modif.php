<?php
if ($_POST['login'] && $_POST['oldpw'] && $_POST['newpw'] && $_POST['submit'] && $_POST['submit'] === "OK")
{
	$content = file_get_contents('../private/passwd');
	$accounts = unserialize($content);
	if ($accounts !== false)
	{
		$flag = 0;
		foreach ($accounts as $key => $value)
		{
			// Check if login and passwd already exist in accounts
			if ($value['login'] === $_POST['login'] && $value['passwd'] === hash('whirlpool', $_POST['oldpw']))
			{
				$flag = 1;
				$accounts[$key]['passwd'] = hash('whirlpool', $_POST['newpw']);
			}
		}
		if ($flag)
		{
			file_put_contents('../private/passwd', serialize($accounts));
			echo "OK\n";
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
