<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index | Page</title>
    <?php require_once('header.php'); ?>
</head> 
<body>
<header id="header" class="fixed-top flex flex-row justify-center items-center">
    <nav class="nav-menu d-none d-lg-block" id='top-nav'>
        <ul class="space-x-10">
            <li class="nav-home active"><a href="./index.php?page=home"><span class="fa fa-home text-2xl mr-2"></span> Home</a></li>
            <li class="nav-map"><a href="./index.php?page=map"><span class="fas fa-map-marked-alt text-2xl mr-2"></span>School Map</a></li>
            <li class="nav-logs"><a href="./index.php?page=logs"><span class="fas fa-user-check text-2xl mr-2"></span> School Log</a></li>
            <li class="nav-grades"><a href="./index.php?page=grades"><span class="fas fa-user-graduate text-2xl ml-3 mr-2"></span>Student Grades</a></li>
            <li class="nav-about"><a href="./index.php?page=about"><span class="far fa-question-circle text-2xl -ml-5 mr-2"></span>About</a></li>
            <li class="drop-down nav-bus nav-location"><a href="#"><span class="fa fa-chevron-circle-down text-2xl"></span> View More</a> 
                <ul> 
                    <li class="nav-organization  "><a href="./index.php?page=organization"><span class="fa fa-users mr-2 text-2xl"></span>DepEd Leader</a></li>
                    <li class="nav-viewTeacherLogs"><a href="./index.php?page=viewTeacherLogs"><span class="fas fa-user-check mr-2 text-2xl"></span>View Teacher</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</header>
    <?php 
    
        (isset($_GET['page']) && !empty($_GET['page'])) 
        ? require_once($_GET['page'].'.php') 
        : require_once('home.php'); 
    ?>
    <button id="btnScrollUp" class="fixed bottom-5 right-4 w-16 h-16 hover:border-red-900 hover:bg-red-100 hover:text-red-900 tracking-wide text-lg text-white bg-red-900 py-2 rounded-full border-red-500 border-2">
        <i class="fas fa-arrow-up"></i>
    </button>
<?php require_once('footer.php');?>