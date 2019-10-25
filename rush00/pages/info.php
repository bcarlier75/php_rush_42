<?php
    session_start();
    if ($_SESSION['admin'] == false) {
        header("Location: admin.php");
    }
?>

<form action="work.php" method="get" class="form-example">
  <div class="form-example">
    <input type="submit" name="page" value="users">
  </div>
  <div class="form-example">
  <input type="submit" name="page" value="category">
  </div>
  <div class="form-example">
  <input type="submit" name="page" value="items">
  </div>
  <div class="form-example">
  <input type="submit" name="page" value="orders">
  </div>
  <div class="form-example">
  <input type="submit" name="page" value="logout">
  </div>
</form>
