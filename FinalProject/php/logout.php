<?php
    session_start();
    unset($_SESSION['login']);
    unset($_SESSION['deliveryDetails']);
    header("Location: ../index.php");
?>