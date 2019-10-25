<?php
    session_start();
    if ($_SESSION['admin'] == false) {
        header("Location: admin.php");
    }
    if (!isset($_GET['page'])) {
        $page = "info.php";
    }elseif ($_GET['page'] == "users") {
        $page = "users.php";
    }elseif ($_GET['page'] == "category") {
        $page = "category.php";
    }elseif ($_GET['page'] == "items") {
        $page = "items.php";
    }elseif ($_GET['page'] == "orders") {
        $page = "orders.php";
    }elseif ($_GET['page'] == "logout") {
        $page = "logout_admin.php";
    }
    header("Location: $page");
    ?>
