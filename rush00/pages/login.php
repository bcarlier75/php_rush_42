<?php
include('auth.php');
include('../db.php');
session_start();

if ($_POST[login] && $_POST[pass])
{
	$login = $_POST[login];
	$passwd = $_POST[pass];
	if (auth($login, $passwd, $conn) === TRUE)
	{
		$_SESSION[loggued_on_user] = $login;
		header('Location: ../index.php');
	}
	else
	{
		$_SESSION[loggued_on_user] = "";
		echo("Error\n\n");
	}
}

?>
<html><body>
<br> <br>
        <form action="login.php" method="POST">
            Id______: <input type="text" name="login" value="test" required>
            <br> 
            Password: <input type="password" name="pass" value="" required>
            <input type="submit" name="submit" value="OK">
        </form>
        <a href="../index.php">Home page</a>
</body></html>
