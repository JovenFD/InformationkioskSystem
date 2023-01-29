<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once('../header.php');?>
    <title>Print Security Personel's Records</title>
</head>
<body class="bg-white">

<?php
    $title = "SECURITY PRESONEL'S RECORDS";
    require_once('tableHeader.php'); 
?>
<table class="table table-bordered text-center">
    <thead>
        <tr>
            <th>#</th>
            <th>Picture</th>
            <th>Name's</th>
            <th>Date of Birth</th>
            <th>Gender</th>
            <th>Address</th>
            <th>Email</th>
            <th>Contact Number</th>
        </tr>
    </thead>
    <tbody>
    <?php require_once('../php/init.php'); printGuard();?>
    </tbody>
</table>
</body>
</html>