<?php
function auth($login, $passwd, $conn)
{
	if($login !== NULL && $passwd !== NULL)
	{
		$query = "SELECT password FROM user_db WHERE login = '$login'";
		$result = mysqli_fetch_row(mysqli_query($conn, $query));
		if ($result[0] === hash('whirlpool',$passwd))
			return TRUE;
	}
	return FALSE;
}
?>
