<?php
    if($_POST[login]  && $_POST[pass]){
        $login = $_POST[login];
        $pass = $_POST[pass];
        include("../db.php");
        // verifie si login existe
        $query = "SELECT count(login) from user_db WHERE login = '$login'";
        $result = mysqli_fetch_row((mysqli_query($conn, $query)));

        // Faux renvoie une erreur sql;
        if ($result === FALSE){
                mysqli_error($conn);
                mysqli_error_list($conn);
            }
        // si result = 0 crée l'utilisateur, si la creation plante renvoie une erreur sql
        if ($result[0] == 0){
            $hash = hash("whirlpool", $pass);
            $result = mysqli_query($conn, "INSERT INTO user_db (login, password, admin) VALUES ('$login', '$hash', NULL)");
            if ($result === FALSE){
                print_r(mysqli_error_list($conn));
            }
            // print_r(mysqli_error_list($conn));
            mysqli_close($conn);
            header("Location: ../index.php");
            return;
        }
        mysqli_close($conn);
        echo "Error User already in database";
    }
?>
    <form action="create_user.php" method="POST">
    <br><br>
        Id______: <input type="text" name="login" value="" required>
        <br> 
        Password: <input type="password" name="pass" value="" required>
        <input type="submit" name="submit" value="OK">
	</form>
	<a href="../index.php">Home page</a>


