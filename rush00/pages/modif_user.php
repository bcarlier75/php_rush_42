<?php
session_start();
    if($_POST[login] && $_POST[oldpass] && $_POST[newpass])
	{
        $login = $_POST[login];
        $oldpass = $_POST[oldpass];
        $newpass = $_POST[newpass];

        //initie la liaison sql
        include("../db.php");

        // verifie si login existe
        $query = "SELECT count(login) from user_db WHERE login = '$login'";
        $result = mysqli_fetch_row((mysqli_query($conn, $query)));

        // Faux renvoie une erreur sql;
        if ($result === FALSE)
		{
                mysqli_error($conn);
                mysqli_error_list($conn);
        }
        // si result = 1 change le mdp;

        if ($result[0] == 1)
		{
            $hash = hash("whirlpool", $oldpass);
            $query = "SELECT password FROM user_db WHERE login = '$login'";
            $result = mysqli_fetch_row((mysqli_query($conn, $query)));
            if($result[0] == $hash)
			{
                $hash = hash("whirlpool", $newpass);
                $result = mysqli_query($conn, "UPDATE user_db SET password='$hash' WHERE login = '$login'");
                if ($result === FALSE)
                    print_r(mysqli_error_list($conn));
            }
			else
			{
				header('Location: modif_user.php');
				return;
			}
			mysqli_close($conn);
            header("Location: ../index.php");
            return;
        }
        mysqli_close($conn);
        header('Location: modif_user.php');
        return;
    }
?>

<html><body>
    Modify password;
    <form action="modif_user.php" method="POST">
        Id__________: <input type="text" name="login" value="test" required>
        <br> 
        Old password: <input type="password" name="oldpass" value="" required>
        <br> 
        New password: <input type="password" name="newpass" value="" required>
        <input type="submit" name="submit" value="OK">
	</form>
	<a href="../index.php">Home page</a>
</body></html>
