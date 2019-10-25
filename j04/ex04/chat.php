<?php
session_start();
if (!($_SESSION['loggued_on_user']))
	echo "ERROR\n";
else
{
	$path = '../private/chat';
	if (file_exists('../private') && file_exists($path))
		$chat = unserialize(file_get_contents($path));
	foreach ($chat as $user)
	{
		echo "[".date('H:i', $user['time'])."] ";
		echo "<b>".$user['login']."</b>: ";
		echo $user['msg'];
		echo "<br />";
	}
}
?>
