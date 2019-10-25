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
    $resQuery = mysqli_query($conn, "SELECT * FROM orders_db");
    if (($row = mysqli_fetch_array($resQuery)) == NULL) {
        echo "<h2 style='color: #E6855F'>No orders</h2>";
    }
    foreach ($resQuery as $elem) {
        echo "<form action='' method='post'>";
        $i = 0;
        foreach ($elem as $value) {
            echo "<input type='text' name='$i' value='$value'>";
            $i++;
        }
        echo "<input type='submit' name='delete' value='Delete'>";
        echo "</form>";
    }
    if (isset($_POST['delete'])) {
        if ($_POST['delete'] == "Delete") {
            $id = $_POST[0];
            $resLogQuery = mysqli_query($conn, "SELECT * FROM `orders_db` WHERE id = '$id'");
            if ($resLogQuery) {
                $resQuery = mysqli_query($conn, "DELETE FROM `order` WHERE id = '$id'");
                refresh();
            }
        }
    }
?>
<html>
<form method="get" action=work.php>
    <input type="submit" name="void" value="retour" />
</form>
</html>
