<?php 
session_start();
if(!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']
){
    header('Location: ./login.php');
    die();  
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once('../header.php');?>
    <title>Print Student List Records</title>
</head>
<body class="bg-white">

<table class="table table-bordered text-center">
    <thead>
    <tr>
        <th colspan="5">
            <?php
                $title = 'STUDENT LIST RECORDS';
                require_once('tableHeader.php'); 
            ?>
        </th>
    </tr>
    <tr>
        <th>#</th>
        <th>Profile</th>
        <th>Learner's Name</th>
        <th>Class</th>
        <th>Year Level</th>
    </tr> 
    </thead>
    <tbody>
    <?php require_once('../php/init.php'); printStudentListTeacher();?>
    </tbody>
</table>
<!-- Laoding Components -->
<script src="../assets/js/loading.js"></script>
</body>
</html>