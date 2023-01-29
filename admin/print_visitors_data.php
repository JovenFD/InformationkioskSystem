<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once('../header.php');?>
    <title>Print Visitors Records</title>
</head>
<body class="bg-white">

<?php
    $title = 'VISITORS RECORDS';
    require_once('tableHeader.php'); 
?>
<table class="table table-bordered text-center">
    <thead>
        <tr>
        <th>#</th>
        <th>Picture</th>
        <th>Qrcode</th>
        <th>Visitors's Name</th>
        <th>Date of Birth</th>
        <th>Gender</th>
        <th>Address</th>
        <th>Contact Number</th>
        <th>Porpose</th>
        </tr>
    </thead>
    <tbody>
    <?php require_once('../php/init.php'); printVisitors();?>
    </tbody>
</table>
</body>
</html>