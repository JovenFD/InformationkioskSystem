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
    <title>Teacher | Dashboard</title> 
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
                <!-- Dynamic Logo -->
                <script src="../assets/dynamic/adminLogo.js"></script>
            </div>
            <div class="clearfix"></div>

            <?php
                require_once '../php/init.php';
                $name   = unserialize($_SESSION['user']);
                $avatar = unserialize($_SESSION['avatar_user']);
            ?>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
                <div class="relative mt-2 mx-auto w-32 h-32 rounded-full border-gray-600 border-4">
                    <a href="#" data-toggle="modal" data-target="#profileModal">
                        <img class="w-full h-full rounded-full"
                        src="<?php echo $avatar?>">
                    </a>
                </div>
                <div class="text-center text-white">
                    <h2><?php echo ucwords($name); ?></h2>
                    <h3>Welcome Teacher</h3>
                </div>
            </div>
            <!-- /menu profile quick info -->

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
            <ul class="nav side-menu text-lg">
                <li class="nav-home active"><a href="./teacher.php?page=home"><i class="fas fa-home fa-calendar-alt mr-3"></i>Home</a></li>

                <li class="nav-studentList"><a href="./teacher.php?page=studentList"><i class="fas fa-user-graduate mr-3"></i>My Students</a></li>

                <li class="nav-uploadGrades"><a href="./teacher.php?page=uploadGrades"><i class="fas fa-upload mr-3"></i>Upload Grades</a></li>

                <li class="nav-studentGrades"><a href="./teacher.php?page=studentGrades"><i class="fas fa-users mr-3"></i>Student Grades</a></li>

                <li class="nav-printStudentRecords"><a href="./teacher.php?page=printStudentRecords"><i class="fas fa-print mr-3"></i>Print Records</a></li>

                <li class="nav-reportFile"><a href="./teacher.php?page=reportFile"><i class="fas fa-file mr-3"></i>Files Report</a></li>

                <li class="nav-attendanceLog"><a href="./teacher.php?page=attendanceLog"><i class="fas fa-user-check mr-3"></i>Attendance Logs</a></li>
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
                <span class="fas fa-user-circle text-2xl mr-1"></span>Teacher
                </a>
                
                <div class="dropdown-menu dropdown-usermenu pull-right rounded-lg" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" data-toggle="modal" data-target="#profileModal"> 
                    <i class="fa fa-user pull-right"></i>
                        <span>Profile</span>
                    </a>
                    <a class="dropdown-item" onclick="logout('1')">
                    <i class="fas fa-power-off pull-right"></i>
                        <span>Log Out</span>
                    </a>                
                </div>
                </li>
            </ul>
            </nav>
        </div>
        <script src="../assets/js/logout.js"></script>
        </div>
    <!-- /top navigation -->

    <div class="right_col" role="main">
    <h1 class="text-2xl">Dashboard</h1>
        <?php 
            
            (isset($_GET['page']) && !empty($_GET['page'])) 
            ? require_once($_GET['page'].'.php') 
            : require_once('home.php'); 
        ?>
    </div>

    <?php 
        require_once('./modals/profile_modal.php');
        require_once('footer.php');
    ?>