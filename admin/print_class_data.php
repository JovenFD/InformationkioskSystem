<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once('../header.php');?>
    <title>Print Class Records</title>
</head>
<body class="bg-white">

<?php
    $title = 'CLASS RECORDS';
    require_once('tableHeader.php'); 
?>
<table class="table table-bordered text-center">
    <thead>
        <tr>
            <th>#</th>
            <th>Class Name</th>
            <th>School Year</th>
            <th>Year Level</th>
        </tr>
    </thead>
    <tbody>
    <?php require_once('../php/init.php'); printClass();?>
    </tbody>
</table>
<!-- Laoding Components -->
<script src="../assets/js/loading.js"></script>
</body>
</html>