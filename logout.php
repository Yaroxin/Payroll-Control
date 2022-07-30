<?php
    require "db.php";
    unset($_SESSION['date']);
    unset($_SESSION['logged_user']);
    header('location:/');
?>
