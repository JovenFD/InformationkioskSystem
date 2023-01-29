<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once('../header.php');?>
    <title>Print Student Class Records</title>
</head>
<body class="bg-white">

<?php
    $title = 'STUDENT CLASS RECORDS';
    require_once('tableHeader.php'); 
?>
<table class="table table-bordered text-center">
    <thead>
        <tr>
            <th>#</th>
            <th>Profile</th>
            <th>Class Name</th>
            <th>Learners Name</th>
            <th>Subjects</th>
        </tr>
    </thead>
    <tbody>
    <?php require_once('../php/init.php'); printStudentClass()?>
    </tbody>
</table>
</body>
</html>