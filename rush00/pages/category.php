<?php
    session_start();
    if ($_SESSION['admin'] == false) {
        header("Location: admin.php");
    }
    function refresh($url = NULL) {
        ?>
        <script type="text/javascript">
        window.location.href = '<?php $_SERVER[REQUEST_URI] ?>';
        </script>
    <?php
    }
    include("../db.php");
    $resQuery = mysqli_query($conn, "SELECT * FROM sports_db");
    if (($row = mysqli_fetch_array($resQuery))  == NULL) {
        echo "<h2 style='color: #E6855F'>No items</h2>";
    }
    foreach ($resQuery as $elem) {
        echo "<form action='items.php' method='post'>";
        $i = 0;
        foreach ($elem as $value) {
            echo "<input type='text' name='$i' value='$value'>";
            $id = $elem['id'];
            $i++;
        }
        echo "<input type='hidden' name='value_id' value='{$id}'>";
        echo "<input type='submit' name='delete' value='Delete'>";
        echo "<input type='submit' name='modify_category' value='Edit'>";
        echo "<hr style='height: 5px'>";
        echo "</form>";
    }
    if (isset($_POST['delete'])) {
        if ($_POST['delete'] == "Delete") {
            $id = $_POST['value_id'];

            $query = mysqli_query($conn, "DELETE FROM `sports_db` WHERE id = '$id'");
            refresh();
        }
    }
    if (isset($_POST['modify_item'])) {
        if ($_POST['modify_item'] == "Edit") {
            $id = $_POST['value_id'];
            $name = $_POST['1'];
            $sport_id = $_POST['2'];

            $query = mysqli_query($conn, "UPDATE `sports_db` SET `name` = '$name', `sport_id` = '$sport_id' WHERE id = '$id'");
            refresh();
        }
    }
    if (isset($_POST['add'])) {
        if ($_POST['add'] == "ADD") {
            $name = $_POST['name'];
            $sport_id = $_POST['sport_id'];
            include("../db.php");
            $queryInsert = mysqli_query($conn, "INSERT INTO sports_db (name, sport_id) VALUES ('$name', '$sport_id')");
            mysqli_close($conn);
            refresh();
        }
    }
?>
<form method="post" action="">
    <input type="text" name="name" value="Delete" placeholder="name" /><br>
    <input type="text" name="sport_id" value="Edit" placeholder="sport_id" /><br>
    <input type="submit" name="add" value="ADD"/>
</form>
<form method="get" action=work.php>
    <input type="submit" name="void" value="retour" />
</form>
