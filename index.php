<?php 
    require_once('php/init.php'); 
    $action = '';

    if (!empty($_GET["action"])) {
        $action = $_GET["action"];
    }
    switch($action) {
        case 'login-user':
            Login();
            break;
        case 'logout-user':
            Logout();
            break;
        case 'adminprofile':
            AdminProfile();
            break;
        case 'add-logs':
            SaveLog();
            break;
        case 'statistics-count':
            Statistics();
            break;
        case 'student':
            Student();
            break;
        case 'teacher':
            teacher();
            break;
        case 'studentLogs':
            StudentsLog();
            break;
        case 'teacherLogs':
            TeachersLog();
            break;
        case 'visitorLogs':
            VisitorsLog();
            break;
        case 'visitors':
            visitor();
            break;
        case 'year':
            Year();
            break;
        case 'level':
            Level();
            break;
        case 'subject':
            Subject();
            break;
        case 'class':
            Classes();
            break;
        case 'stdclass':
            StudentClass();
            break;
        case 'teacherAvisory':
            TeacherAdvisory();
            break;
        case 'csvfile':
            CsvFile();
            break;
        case 'teacherAccount':
            TeacherAccount();
            break;
        case 'dynamicComponent':
            DynamicComponent();
            break;
        case 'uploadVideo':
            UploadingVideo();
            break;
        case 'uploadSchoolImages':
            UploadSchoolGallery();
            break;
        case 'view-grades':
            ViewScanGrades();
            break;
        case 'viewTeachersLog':
            ViewTeachersLogs();
            break;
        case 'reportfile':
            ViewFilesReport();
            break;
        case 'feedback':
            FeedBack();
            break;
        case 'gaurd':
            Guard();
            break;
        default:
            require_once("landingPage/landingPage.php");
        break;
    }
?>