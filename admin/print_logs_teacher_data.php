<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once('../header.php');?>
    <title>Print School Records</title>
</head>
<body class="bg-white">

<?php 
    $title = 'SCHOOL LOGS RECORDS';
    require_once('tableHeader.php'); 
?>
<table class="table table-bordered text-center">
    <thead>
    <tr>
        <th>#</th>
        <th>Picture</th>
        <th>Name's</th>
        <th>User Type</th>
        <th>Log Type</th>
        <th>Log Dates & Time</th>
    </tr>
    </thead>
    <tbody>
    <?php require_once('../php/init.php');  printTeacherLogs();?>
    </tbody>
</table>
</body>
</html>