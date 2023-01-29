<?php
    unset($_SESSION['logged_in']);
    unset($_SESSION['email']);
    unset($_SESSION['guard']);
    unset($_SESSION['avatar_guard']);
    unset($_SESSION['guardid']);

    header('Location: ../admin/logout.php');
?>