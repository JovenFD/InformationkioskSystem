<?php
    unset($_SESSION['logged_in']);
    unset($_SESSION['email']);
    unset($_SESSION['user']);
    unset($_SESSION['user']);
    unset($_SESSION['userid']);

    header('Location: ../admin/logout.php');
?>