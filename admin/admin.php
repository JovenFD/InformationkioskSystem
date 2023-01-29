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
    <title>Admin | Dashboard</title> 
    <?php require_once('../header.php');?>
</head>
<body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
                <a href="admin.php" class="site_title">
                  <div class="row">
                    <img id="Flogo" width="48px" height="48px" class="img-circle m-2">
                        <span class="tracking-widest mt-1">INFO-KIOSK</span>
                   </div>
                </a>
            </div>
            <!-- Synamic Logo -->
            <script src="../assets/dynamic/adminLogo.js"></script>
            <div class="clearfix"></div>

            <?php
                require_once '../php/init.php';
                $name   = unserialize($_SESSION['admin']);
                $avatar = unserialize($_SESSION['avatar_admin']);
            ?>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
                <div class="relative mt-2 mx-auto w-28 h-28 rounded-full border-gray-600 border-4">
                    <a href="#" data-toggle="modal" data-target="#profileModal">
                        <img class="w-full h-full rounded-full"
                        src="<?php echo $avatar?>">
                    </a>
                </div>
                <div class="text-center text-white">
                    <h2><?php echo ucwords($name); ?></h2>
                    <h3>Welcome Admin</h3>
                </div>
            </div>
            <!-- /menu profile quick info -->

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section text-xl">
            <ul class="nav side-menu">
                <li class="nav-home active"><a><i class="fas fa-home mr-3"></i>Home <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="./admin.php?page=home"><i class="fas fa-tachometer-alt mr-3"></i>Dashboard </a></li>
                </ul> 

                <li class="nav-student"><a><i class="fas fa-user-graduate mr-3"></i>Student <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="./admin.php?page=student"><i class="fas fa-user-friends mr-3"></i>Student List</a></li>
                    <li class="nav-uploadStudentCsvFile"><a href="./admin.php?page=uploadStudentCsvFile"><i class="fas fa-file-upload mr-3"></i>Upload Student Record</a></li>
                    <li class="nav-studentclass"><a href="./admin.php?page=studentclass"><i class="fas fa-book-reader mr-3"></i>Student Class</a></li>
                </ul>  

                <li class="nav-teacher"><a><i class="fas fa-chalkboard-teacher mr-3"></i>Teacher <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="./admin.php?page=teacher"><i class="fas fa-user-friends mr-3"></i>Teacher List</a></li>
                    <li class="nav-uploadTeacherCsvFile"><a href="./admin.php?page=uploadTeacherCsvFile"><i class="fas fa-file-upload mr-3"></i>Upload Teacher Record</a></li>
                    <li class="nav-teacheradvisory"><a href="./admin.php?page=teacheradvisory"><i class="fas fa-chalkboard mr-3"></i>Teacher Advisory</a></li>
                    <li class="nav-templateCsvFile"><a href="./admin.php?page=templateCsvFile"><i class="fas fa-copy mr-3"></i>Tempates Csv file</a></li>
                </ul>   

                <li class="nav-year"><a href="./admin.php?page=year"><i class="far fa-calendar-alt mr-3"></i>School Year</a></li>

                <li class="nav-level"><a href="./admin.php?page=level"><i class="fas fa-layer-group mr-3"></i>Year Level</a></li>

                <li class="nav-subject"><a href="./admin.php?page=subject"><i class="fas fa-book mr-3"></i>Subject</a></li>

                <li class="nav-class"><a href="./admin.php?page=class"><i class="fas fa-bar-chart-o mr-3"></i>Class</a></li>

                <li class="nav-visitors"><a href="./admin.php?page=visitors"><i class="fas fa-users mr-3"></i></i>Visitor</a></li>

                <li class="nav-gaurd"><a href="./admin.php?page=gaurd"><i class="fas fa-users mr-3"></i></i>Guard</a></li>

                <li class="nav-logs"><a href="./admin.php?page=logs"><i class="fas fa-calendar mr-3"></i>School Log</a></li>

                <li class="nav-news"><a href="./admin.php?page=news"><i class="far fa-newspaper mr-3"></i>Add News</a></li>

                <li class="nav-events"><a href="./admin.php?page=events"><i class="far fa-calendar-alt mr-3"></i></i>Add Events</a></li>
                <li class="nav-depedLeaders"><a href="./admin.php?page=depedLeaders"><i class="far fa-calendar-alt mr-3"></i></i>Deped Leader</a></li>

                <li class="nav-settings"><a href="./admin.php?page=settings"><i class="fas fa-cog mr-3"></i>System Setting</a></li>
            </ul>
            </div>
        </div>
        <!-- /sidebar menu -->
        </div>
    </div>

    <!-- top navigation -->
    <div class="top_nav">
        <div class="nav_menu">
            <div class="nav toggle mb-3">
                <a id="menu_toggle"><i class="fas fa-bars"></i></a>
            </div>
            <nav class="nav navbar-nav h-14">
            <ul class=" navbar-right mt-3">
                <li class="nav-item dropdown open">
                <a href="javascript:;" class="user-profile text-lg dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                <span class="fas fa-user-circle text-2xl"></span> Admin
                </a>
                
                <div class="dropdown-menu dropdown-usermenu pull-right rounded-lg" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" data-toggle="modal" data-target="#profileModal"> 
                    <i class="fa fa-user pull-right"></i>
                        <span>Profile</span>
                    </a>
                    <a class="dropdown-item" onclick="logout('0')">
                    <i class="fas fa-power-off pull-right"></i>
                        <span>Log Out</span>
                    </a>                
                </div>
                </li>
                <?php require('feedBack.php');?>
            </ul>
            </nav>
        </div>
        <script src="../assets/js/logout.js"></script>
        </div>
    <!-- /top navigation -->

    <div class="right_col" role="main">
    <h1 class="text-2xl text-black">Dashboard</h1>
        <?php 
            
            (isset($_GET['page']) && !empty($_GET['page'])) 
            ? require_once($_GET['page'].'.php') 
            : require_once('home.php'); 
        ?>
        <button id="btnScrollUp" class="fixed bottom-5 right-4 w-16 h-16 hover:border-blue-600 hover:bg-blue-100 hover:text-blue-600 tracking-wide text-lg text-white bg-blue-400 py-2 rounded-full border-blue-500 border-2">
            <i class="fas fa-arrow-up"></i>
        </button>
    </div>

    <?php 
        require_once('./modals/profile_modal.php');
        require_once('footer.php');
    ?>