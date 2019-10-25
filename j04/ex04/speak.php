<?php
session_start();
if (!($_SESSION['loggued_on_user']))
	echo "ERROR\n";
else
{
	if ($_POST['msg'])
	{
		$path = '../private/chat';
		if (!file_exists('../private'))
			mkdir("../private");
		if (!file_exists($path))
			file_put_contents($path, null);
		$content = file_get_contents($path);
		$chat = unserialize(file_get_contents($path));
		$file_p = fopen($path, "w");
		flock($file_p, LOCK_EX);
		$user['login'] = $_SESSION['loggued_on_user'];
		$user['time'] = time();
		$user['msg'] = $_POST['msg'];
		$chat[] = $user;
		file_put_contents($path, serialize($chat));
		fclose($file_p);
	}
?>
<html>
<head>
	<script langage="javascript">top.frames['chat'].location = 'chat.php';</script>
</head>
<body>
	<form action="speak.php" method="POST">
	<input type="text" name="msg" value=""/><input type="submit" name="submit" value="Send"/>
</form>
</body>
</html>
<?php
}
?>
