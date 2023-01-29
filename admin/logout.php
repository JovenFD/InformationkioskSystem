<?php
    unset($_SESSION['logged_in']);
    unset($_SESSION['admin']);
    unset($_SESSION['avatar_admin']);

    header('Location: Login.php');
?>