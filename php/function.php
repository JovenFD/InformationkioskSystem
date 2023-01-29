<?php 
    function Login() {
        session_start();
        
        if((isset($_POST['username']) && trim($_POST['username'])!= '')
        && (isset($_POST['password']) && trim($_POST['password'])!= '')
        ) {
            $loginObj = new login(
                $_POST['username'], 
                $_POST['password']
            );
            $loginObj->setLogin();
        } else {
            echo json_encode(array(
            "message" => "Error: Fill up all the required fields.",
            "status"  => "error"
            ));
        }
    }

    function truncate($text) {
        $chars = 50;
        $text = $text." ";
        $text = substr($text,0,$chars);
        $text = substr($text,0,strrpos($text,' '));
        $text = $text."...";

        return $text;
    }

    function QrLogo() {
        require_once('../class/Controller.php');
        require_once('../class/DynamicComponent.php');
    
        $logoBarObj = new DynamicComponent();
        $result = $logoBarObj->getLogoBar();
        $logo = '';
    
        if (is_array($result) || is_object($result)
        ) { 
            foreach ($result as $row) {
                $logo = '.'.$row['logo_img'];
            }
        }
        return $logo;
    }

    function tableHeader() {
        $logoBarObj = new DynamicComponent();
    
        $resultLeft  = $logoBarObj->getLogoBar();
        $resultRight = $logoBarObj->getRightLandingPageLogo();
        $resultAllTitle = $logoBarObj->getAllLandingTableTittle();
    
        if (is_array($resultLeft) || is_object($resultLeft)
        ) { 
            foreach ($resultLeft as $row) {
                $logoLeft = $row['logo_img'];
            }
        }
        
        if (is_array($resultRight) || is_object($resultRight)
        ) { 
            foreach ($resultRight as $row) {
                $logoRight = $row['logo_img'];
            }
        }
    
        if (is_array($resultAllTitle) || is_object($resultAllTitle)
        ) { 
            foreach ($resultAllTitle as $row) {
                $titleHeader = $row['tabletitle'];
                $region = $row['region'];
                $division = $row['division'];
            }
        }

        return array(
            $logoLeft, 
            $logoRight, 
            $titleHeader,
            $region,
            $division
        );
    }

    function newsLandingPage() {
        $newsObj = new DynamicComponent();
        $result = $newsObj->getNewsNumRows();

        if (is_array($result) || is_object($result)
        ) { 
            foreach ($result as $key => $value) {

                $row = $newsObj->getShowLandingPageNews($key);
            
            if (is_array($row) || is_object($row)
            ) {
                echo '<div class="carousel-item" id="item">
                <div class="row">';

                foreach ($row as $value) {
                    echo '  
                    <div class="col mb-3 text-center">
                    <div class="card m-4 border-double border-red-900">
                        <div class="card-header">
                        '.$value['title'].'
                    </div>
                        <img class="object-fill h-60 w-full align-middle" src="'.$value['newspic'].'">
                        <div class="card-body">
                            <p class="card-text">'.truncate($value['summary']).'</p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">Last updated '.date('m/d/Y', strtotime($value['create_date'])).'</small>
                        </div>
                    </div>
                </div>';
                }

                echo '</div>
                </div>';
                }
            }
        }
    }

    function newsTeacherPage() {
        $newsObj = new DynamicComponent();
        $result = $newsObj->getNewsNumRows();

        if (is_array($result) || is_object($result)
        ) { 
            foreach ($result as $key => $value) {

                $row = $newsObj->getShowLandingPageNews($key);
            
            if (is_array($row) || is_object($row)
            ) {
                echo '<div class="carousel-item" id="item">
                <div class="row">';

                foreach ($row as $value) {
                    echo '  
                    <div class="col mb-3">
                        <div class="card m-4">
                        <div class="card-header">
                        '.$value['title'].'
                    </div>
                        <img object-fill h-60 w-full align-middle border-none src=".'.$value['newspic'].'">
                        <div class="card-body">
                            <h4 class="card-title"></h4> 

                            <p class="card-text">'.truncate($value['summary']).'</p>

                            <div class="card-footer">
                            <small class="text-muted">Last updated '.date('m/d/Y', strtotime($value['create_date'])).'</small>
                            </div>
                        </div>
                    </div>
                </div>';
                }

                echo '</div>
                </div>';
                }
            }
        }
    }

    function Logout() {
        session_start();
        unset($_SESSION["user"]);
        unset($_SESSION["logged_in"]);
        unset($_SESSION["avatar_admin"]);
        
        echo json_encode(array(
            "message" => "Successfully logged out.",
            "status"  => "success"
        ));
    }

    function Statistics() {
        $countObj = new Statitics();
        if((isset($_GET['student']))
        ) {
            $countObj->studentStatistics();
        } elseif (isset($_GET['teacher'])
        ) {
            $countObj->teachersStatistics();
        } elseif (isset($_GET['visitors'])
        ) {
            $countObj->visitorsStatistics();
        } elseif (isset($_GET['subject'])
        ) {
            $countObj->subjectsStatistics();
        } elseif (isset($_GET['class'])
        ) {
            $countObj->classStatistics();
        } elseif (isset($_GET['schoollogs'])
        ) {
            $countObj->schoolLogsStatistics();
        } elseif (isset($_GET['schoolyear'])
        ) {
            $countObj->schoolYearStatistics();
        } elseif (isset($_GET['teacheradvidory'])
        ) {
            $countObj->teacherAdvidoryStatistics();
        } elseif (isset($_GET['yearlevel'])
        ) {
            $countObj->yearLevelStatistics();           
        } else {
            $countObj->studentClassStatistics();
        }
    }

    function AdminProfile() {
        $adminObj = new AdminProfile();
        
        if(isset($_GET['view'])) {
            $adminObj->getAllUser();
        } else {

            if(strlen($_POST['formVal'][10]) < 8 ) {

                $response = json_encode(array(
                    "message" => "Invalid password must 8 characters!",
                    "status"  => "error"
                ));

            } elseif($_POST['formVal'][9] !== $_POST['formVal'][10]) {

                $response = json_encode(array(
                    "message" => "Password does not match!",
                    "status"  => "error"
                ));

            } else {
            
                foreach($_POST['formVal'] as $value) {
                    if((isset($value) && trim($value)!= '')
                    ) {  
                        $fileUpload = ''; 
                        if($_FILES["file"]["error"] != 4) {
                            require_once('fileUploader.php');
                
                            $fileUpload = upload($_FILES['file'], './uploads/');
                
                            if($fileUpload['status'] == 'error') {
                            echo json_encode($fileUpload);
                            die();
                            }
                        } else {
                            $fileUpload = array(
                            "message" => "Empty file.",
                            "status" => "error",
                            "avatar" => NULL,
                            );
                        }

                        $defaultAvatar = '../assets/images/account.png';
                        $fileUpload = '../uploads/'.$fileUpload['avatar'];
                
                        $_POST['formVal'][] = (strlen($_FILES['file']['name']) > 0 ) 
                                    ? $fileUpload 
                                    : $defaultAvatar;

                        $adminObj->updateAdminProfile($_POST['formVal']);
                        die();
                        
                    } else {
                        echo json_encode(array(
                            "message" => "Error: Fill up all the required fields.",
                            "status"  => "error"
                        ));
                        die();
                    }
                }
            }
            echo $response;
        }
    }

    function SaveLog() {
        if((isset($_POST['codetype']) && trim($_POST['codetype'])!= '')
        ) {
            $usertype = explode("_", $_POST['codetype'])[0];
            $logsObj = new CheckLogs();

            switch($usertype) {
                case 'Student':
                    $logsObj->setStudent(
                        $_POST['codetype'], 
                        $usertype
                    );
                break;
                case 'Teacher':
                    $logsObj->setTeacher(
                        $_POST['codetype'], 
                        $usertype
                    );
                break;
                case 'Visitors':
                    $logsObj->setVisitors(
                        $_POST['codetype'], 
                        $usertype
                    );
                break;
                default:
                echo json_encode(array(
                        "message" => "Invalid QrCode Please Try Agian!..",
                        "status"  => "warning"
                    ));
                break;
            }  

        } else {
            echo json_encode(array(
            "message" => "Error: Fill up all the required fields.",
            "status"  => "error"
            ));
        }
    }

    function Student() {
        $stdObj = new Student();
        if(isset($_GET['view'])
        ) {
            $stdObj->getAllStudent();

        } elseif(isset($_GET['totalpage'])
        ) {
            $stdObj->studentTotalPages();

        } elseif (isset($_GET['print'])
        ) {
            $stdObj->printAllStudent();
            echo json_encode(array(
                "status"  => "success"
            ));

        } elseif ((isset($_GET['stdsort']) && trim($_GET['stdsort'])!= '') 
        ) {
            $stdObj->sortStudent(intval($_GET['stdsort']));

        } elseif ((isset($_GET['pagenum']) && trim($_GET['pagenum'])!= '')) {

            $newnum = 0;
            ($_GET['pagenum'] == 0) ? $newnum=1 : $newnum=$_GET['pagenum'];
            $stdObj->paginateStudent($newnum);

        } elseif((isset($_POST['data']) && trim($_POST['data'])!= '')
        ) {
            $stdObj->SeachStudent($_POST['data']);

        } elseif (
            (isset($_POST['formVal']) && $_POST['formVal'] != '')
        ) {

            foreach($_POST['formVal'] as $value) {
                if((isset($value) && trim($value)!= '')
                ) { 
                    $fileUpload  = ''; 
                    if($_FILES["file"]["error"] != 4) {
                        require_once './php/fileUploader.php';

                        $fileUpload = upload($_FILES['file'], './uploads/');

                        if($fileUpload['status'] == 'error') {
                            echo json_encode($fileUpload);
                            die();
                        }
                    } else {
                        $fileUpload = array(
                            "message" => "Empty file.",
                            "status" => "error",
                            "avatar" => NULL,
                        );
                    }

                    $defaultAvatar = '../assets/images/account.png';
                    $fileUpload = '../uploads/'.$fileUpload['avatar'];

                    $_POST['formVal'][] = (strlen($_FILES['file']['name']) > 0 ) 
                                ? $fileUpload 
                                : $defaultAvatar;
                    $stdObj->addStudent($_POST['formVal']);
                    die();
                
                } else {
                    echo json_encode(array(
                        "message" => "Error: Fill up all the required fields.",
                        "status" => "error"
                    ));
                    die();
                }
            }
        } elseif (
            (isset($_POST['formNewVal']) && $_POST['formNewVal'] != '')
            ) {

            foreach($_POST['formNewVal'] as $value) {
                if((isset($value) && trim($value)!= '')
                ) { 
                    $fileUpload  = ''; 
                    if($_FILES["file"]["error"] != 4) {
                        require_once './php/fileUploader.php';

                        $fileUpload = upload($_FILES['file'], './uploads/');

                        if($fileUpload['status'] == 'error') {
                            echo json_encode($fileUpload);
                            die();
                        }
                    } else {
                        $fileUpload = array(
                            "message" => "Empty file.",
                            "status" => "error",
                            "avatar" => NULL,
                        );
                    }

                    $defaultAvatar = $_POST['formNewVal'][1];
                    $fileUpload = '../uploads/'.$fileUpload['avatar'];

                    $_POST['formNewVal'][] = (strlen($_FILES['file']['name']) > 0) 
                                ? $fileUpload 
                                : $defaultAvatar;
                    $stdObj->updateStudent($_POST['formNewVal']);
                    die();
                
                } else {
                    echo json_encode(array(
                        "message" => "Error: Fill up all the required fields.",
                        "status" => "error"
                    ));
                    die();
                }
            }

        } elseif ((isset($_POST['std_chk']) && $_POST['std_chk'] != '' )
        ) {
            $stdObj->deleteStudent($_POST['std_chk']);

        } elseif((isset($_POST['stdid']) && trim($_POST['stdid'])!= '')
        ) { 
            $stdObj->updateValueStudent($_POST['stdid']);

        } elseif(isset($_GET['viewUnactive'])
        ) {
            $stdObj->getAllUnactiveStudent();

        } elseif ((isset($_POST['stdUn_chk']) && $_POST['stdUn_chk'] != '' )
        ) {
            $stdObj->restoreStudent($_POST['stdUn_chk']);

        } elseif((isset($_POST['dataUnactive']) && trim($_POST['dataUnactive'])!= '')
        ) {
            $stdObj->SeachUnactiveStudent($_POST['dataUnactive']); 

        } elseif((isset($_POST['testCode']) && trim($_POST['testCode'])!= '')
        ) {
            $stdObj->testQrCode($_POST['testCode']);

        } elseif ((isset($_POST['Student_No']) && trim($_POST['Student_No'])!= '') 
        && (isset($_POST['FirstName']) && trim($_POST['FirstName'])!= '')
        && (isset($_POST['MiddleName']) && trim($_POST['MiddleName'])!= '')
        && (isset($_POST['LastName']) && trim($_POST['LastName'])!= '')
        && (isset($_POST['Date_of_Birt']) && trim($_POST['Date_of_Birt'])!= '')
        && (isset($_POST['Gender']) && trim($_POST['Gender'])!= '')
        && (isset($_POST['Address']) && trim($_POST['Address'])!= '')
        && (isset($_POST['Email']) && trim($_POST['Email'])!= '')
        && (isset($_POST['Contact_Number']) && trim($_POST['Contact_Number'])!= '')
        ) {
            $stdObj->uploadStudentRecords($_POST);

        } else {
            echo json_encode(array(
                "message" => "Error: Fill up all the required fields.",
                "status"  => "error"
            ));
        }
    }

    function printStudent() {
        require_once('../class/Controller.php');
        require_once('../class/Student.php');
        $stdObj = new Student();
        $result = $stdObj->printAllStudent(); 
        $inc = 1;

        if (is_array($result) || is_object($result)) { 
            foreach ($result as $row) {
                echo '
                    <tr>
                    <td>'.$inc++.'</td>
                    <td>
                        <div class="relative mx-auto w-20 h-20 rounded-full border-gray-300 border-2">
                            <img class="w-full h-full rounded-full" src="'.$row['avatar'].'" alt="avatar" />
                        </div>
                    </td>
                    <td>'.$row['id_pass'].'</td>
                    <td>'.$row['student_no'].'</td>
                    <td>'.$row['fname'] .' '. strtoupper(substr($row['mname'], 0 , 1)) . ', '.$row['lname'].'</td>
                    <td>'.$row['dob'].'</td>
                    <td>'.$row['gender'].'</td>                
                    <td>'.$row['address'].'</td>
                    <td>'.$row['email'].'</td>
                    <td>'.$row['contact_no'].'</td>
                    </tr>
                ';
            }
        } else {
            echo '<tr><td colspan="10" class="text-center font-extrabold">Data Not Found...</td></tr>';
        }
    }

    function Teacher() {
        $tchrObj = new Teacher();
        if(isset($_GET['view'])
        ) {
            $tchrObj->getAllTeacher();
        
        } elseif((isset($_POST['data']) && trim($_POST['data'])!= '')
        ) {
            $tchrObj->SeachTeacher($_POST['data']);

        } elseif ((isset($_GET['tchrsort']) && trim($_GET['tchrsort'])!= '') 
        ) {
            $tchrObj->sortTeacher(intval($_GET['tchrsort']));

        } elseif(isset($_GET['totalpage'])
        ) {
            $tchrObj->teacherTotalPages();

        } elseif ((isset($_GET['pagenum']) && trim($_GET['pagenum'])!= '')) {

            $newnum = 0;
            ($_GET['pagenum'] == 0) ? $newnum=1 : $newnum=$_GET['pagenum'];
            $tchrObj->paginateTeacher($newnum);

        } elseif ((isset($_POST['tchr_chk']) && $_POST['tchr_chk'] != '')
        ) {
            $tchrObj->removeTeacher($_POST['tchr_chk']);

        } elseif (isset($_GET['print'])
        ) {
            $tchrObj->printAllTeacher();
            echo json_encode(array(
                "status"  => "success"
            ));

        } elseif (
            (isset($_POST['formVal']) && $_POST['formVal'] != '')
        ) {
            foreach($_POST['formVal'] as $value) {
                if((isset($value) && trim($value)!= '')
                ) { 
                    if(strlen($_POST['formVal'][8]) < 8 ) {

                        echo json_encode(array(
                            "message" => "Invalid password must 8 characters!",
                            "status"  => "error"
                        ));
                        die();
            
                    } elseif($_POST['formVal'][8] !== $_POST['formVal'][9]) {
            
                        echo json_encode(array(
                            "message" => "Password does not match!",
                            "status"  => "error"
                        ));
                        die();
                    } 
                        
                    $fileUpload  = ''; 
                    if($_FILES["file"]["error"] != 4) {
                        require_once './php/fileUploader.php';

                        $fileUpload = upload($_FILES['file'], './uploads/');

                        if($fileUpload['status'] == 'error') {
                            echo json_encode($fileUpload);
                            die();
                        }
                    } else {
                        $fileUpload = array(
                            "message" => "Empty file.",
                            "status" => "error",
                            "avatar" => NULL,
                        );
                    }

                    $defaultAvatar = '../assets/images/account.png';
                    $fileUpload = '../uploads/'.$fileUpload['avatar'];

                    $_POST['formVal'][] = (strlen($_FILES['file']['name']) > 0 ) 
                                ? $fileUpload 
                                : $defaultAvatar;
                    $tchrObj->addTeacher($_POST['formVal']);
                    die();
                
                } else {
                    echo json_encode(array(
                        "message" => "Error: Fill up all the required fields.",
                        "status" => "error"
                    ));
                    die();
                }
            }

        } elseif((isset($_POST['tchrid']) && trim($_POST['tchrid'])!= '')
        ) { 
            $tchrObj->updateValueTeacher($_POST['tchrid']);

        } elseif (
            (isset($_POST['formNewVal']) && $_POST['formNewVal'] != '')
            ) {
                if(strlen($_POST['formNewVal'][10]) < 8 ) {

                    echo json_encode(array(
                        "message" => "Invalid password must 8 characters!",
                        "status"  => "error"
                    ));
                    die();
        
                } elseif($_POST['formNewVal'][10] !== $_POST['formNewVal'][11]) {
        
                    echo json_encode(array(
                        "message" => "Password does not match!",
                        "status"  => "error"
                    ));
                    die();
                } 

                foreach($_POST['formNewVal'] as $value) {
                    if((isset($value) && trim($value)!= '')
                    ) { 
                        $fileUpload  = ''; 
                        if($_FILES["file"]["error"] != 4) {
                            require_once './php/fileUploader.php';

                            $fileUpload = upload($_FILES['file'], './uploads/');

                            if($fileUpload['status'] == 'error') {
                                echo json_encode($fileUpload);
                                die();
                            }
                        } else {
                            $fileUpload = array(
                                "message" => "Empty file.",
                                "status"  => "error",
                                "avatar"  => NULL,
                            );
                        }

                        $defaultAvatar = $_POST['formNewVal'][0];
                        $fileUpload = '../uploads/'.$fileUpload['avatar'];

                        $_POST['formNewVal'][] = (strlen($_FILES['file']['name']) > 0) 
                                    ? $fileUpload 
                                    : $defaultAvatar;
                        $tchrObj->updateTeacher($_POST['formNewVal']);
                        die();
                    
                    } else {
                        echo json_encode(array(
                            "message" => "Error: Fill up all the required fields.",
                            "status" => "error"
                        ));
                        die();
                    }
                }

        } elseif(isset($_GET['viewUnact'])
        ) {
            $tchrObj->getAllUnactTeacher();

        } elseif((isset($_POST['dataUnact']) && trim($_POST['dataUnact'])!= '')
        ) {
            $tchrObj->SeachUnactTeacher($_POST['dataUnact']);

        } elseif ((isset($_POST['tchrUnact_chk']) && $_POST['tchrUnact_chk'] != '')
        ) {
            $tchrObj->removeUnactTeacher($_POST['tchrUnact_chk']);

        } elseif((isset($_POST['testCode']) && trim($_POST['testCode'])!= '')
        ) { 
            $tchrObj->testQrCode($_POST['testCode']);

        } elseif ((isset($_POST['FirstName']) && trim($_POST['FirstName'])!= '')
        && (isset($_POST['MiddleName']) && trim($_POST['MiddleName'])!= '')
        && (isset($_POST['LastName']) && trim($_POST['LastName'])!= '')
        && (isset($_POST['Date_of_Birt']) && trim($_POST['Date_of_Birt'])!= '')
        && (isset($_POST['Gender']) && trim($_POST['Gender'])!= '')
        && (isset($_POST['Address']) && trim($_POST['Address'])!= '')
        && (isset($_POST['Email']) && trim($_POST['Email'])!= '')
        && (isset($_POST['Contact_Number']) && trim($_POST['Contact_Number'])!= '')
        ) {
            $tchrObj->uploadTeacherRecords($_POST);

        } else {
            echo json_encode(array(
                "message" => "Error: Fill up all the required fields.",
                "status"  => "error"
            ));
        }
    }

    function printTeacher() {
        require_once('../class/Controller.php');
        require_once('../class/Teacher.php');
        $tchrObj = new Teacher();
        $result = $tchrObj->printAllTeacher(); 
        
        $inc = 1;

        if (is_array($result) || is_object($result)) { 
            foreach ($result as $row) {
                echo '
                    <tr>
                        <td class="px-5 py-5 text-sm">'.$inc++.'</td>
                        <td class="px-5 py-5 text-sm">
                        <div class="relative mx-auto w-20 h-20 rounded-full border-gray-300 border-2">
                            <img class="w-full h-full rounded-full" src="'.$row['avatar'].'" alt="avatar" />
                        </div>
                    </td>
                    <td class="px-5 py-5 text-sm">'.$row['id_pass'].'</td>
                    <td class="px-5 py-5 text-sm">'.$row['fname'] .' '. strtoupper(substr($row['mname'], 0 , 1)) . ', '.$row['lname'].'</td>
                    <td class="px-5 py-5 text-sm">'.$row['dob'].'</td>
                    <td class="px-5 py-5 text-sm">'.$row['gender'].'</td>                
                    <td class="px-5 py-5 text-sm">'.$row['address'].'</td>
                    <td class="px-5 py-5 text-sm">'.$row['email'].'</td>
                    <td class="px-5 py-5 text-sm">'.$row['contact_no'].'</td>
                    </tr>
                ';
            }
        } else {
            echo '<tr><td colspan="9" class="text-center font-extrabold">Data Not Found...</td></tr>';
        }
    }

    function StudentsLog() {
        $logObj = new StudentsLog();
        if(isset($_GET['view'])
        ) {
            $logObj->getAllLogs();

        } elseif((isset($_POST['data']) && trim($_POST['data'])!= '')
        ) {
            $dateVal = json_decode($_POST['data'], true);
            $logObj->trackDateLogs($dateVal);

        } elseif ((isset($_GET['logsort']) && trim($_GET['logsort'])!= '') 
        ) {
            $logObj->limitLogPages(intval($_GET['logsort']));

        } elseif ((isset($_GET['pagenum']) && trim($_GET['pagenum'])!= '')) {

            $newnum = 0;
            ($_GET['pagenum'] == 0) ? $newnum=1 : $newnum=$_GET['pagenum'];
            $logObj->paginateLogs($newnum);

        } elseif(isset($_GET['totalpage'])
        ) {
            $logObj->logsTotalPages();

        } elseif (isset($_GET['print'])
        ) {
            $logObj->printAllLogs();

            echo json_encode(array(
                "status"  => "success"
            ));

        } elseif ((isset($_POST['LogSearch']) && trim($_POST['LogSearch'])!= '')
        ){
            $logObj->searchDataLogs($_POST['LogSearch']);
        
        } else {
            echo json_encode(array(
                "message" => "Error: Fill up all the required fields.",
                "status"  => "error"
            ));
        }
    }

    function TeachersLog() {
        $logObj = new TeachersLog();
        if(isset($_GET['view'])
        ) {
            $logObj->getAllLogs();

        } elseif (isset($_GET['print'])
        ) {
            $logObj->printAllLogs();

            echo json_encode(array(
                "status"  => "success"
            ));

        } elseif ((isset($_GET['logsort']) && trim($_GET['logsort'])!= '') 
        ) {
            $logObj->limitLogPages(intval($_GET['logsort']));

        } elseif((isset($_POST['data']) && trim($_POST['data'])!= '')
        ) {
            $dateVal = json_decode($_POST['data'], true);
            $logObj->trackDateLogs($dateVal);

        } elseif ((isset($_POST['LogSearch']) && trim($_POST['LogSearch'])!= '')
        ){
            $logObj->searchDataLogs($_POST['LogSearch']);

        } elseif(isset($_GET['totalpage'])
        ) {
            $logObj->logsTotalPages();

        } elseif ((isset($_GET['pagenum']) && trim($_GET['pagenum'])!= '')) {

            $newnum = 0;
            ($_GET['pagenum'] == 0) ? $newnum=1 : $newnum=$_GET['pagenum'];
            $logObj->paginateLogs($newnum);

        } else {
            echo json_encode(array(
                "message" => "Error: Fill up all the required fields.",
                "status"  => "error"
            ));
        }
    }

    function VisitorsLog() {
        $logObj = new VisitorsLog();
        if(isset($_GET['view'])
        ) {
            $logObj->getAllLogs();

        } elseif (isset($_GET['print'])
        ) {
            $logObj->printAllLogs();

            echo json_encode(array(
                "status"  => "success"
            ));

        } elseif ((isset($_POST['LogSearch']) && trim($_POST['LogSearch'])!= '')
        ){
            $logObj->searchDataLogs($_POST['LogSearch']);

        } elseif ((isset($_GET['logsort']) && trim($_GET['logsort'])!= '') 
        ) {
            $logObj->limitLogPages(intval($_GET['logsort']));

        } elseif((isset($_POST['data']) && trim($_POST['data'])!= '')
        ) {
            $dateVal = json_decode($_POST['data'], true);
            $logObj->trackDateLogs($dateVal);

        } elseif(isset($_GET['totalpage'])
        ) {
            $logObj->logsTotalPages();

        } elseif ((isset($_GET['pagenum']) && trim($_GET['pagenum'])!= '')) {

            $newnum = 0;
            ($_GET['pagenum'] == 0) ? $newnum=1 : $newnum=$_GET['pagenum'];
            $logObj->paginateLogs($newnum);

        } else {
            echo json_encode(array(
                "message" => "Error: Fill up all the required fields.",
                "status"  => "error"
            ));
        }
    }

    function printLogs() {
        require_once('../class/Controller.php');
        require_once('../class/StudentsLog.php');
        $logObj = new StudentsLog();
        $result = $logObj->printAllLogs();
        $inc = 1;

        if (!$result) {
            echo '<tr><td colspan="12" class="text-center font-extrabold">Data Not Found...</td></tr>';
            die();
        }

        if (is_array($result) || is_object($result)) { 
            foreach ($result as $row) {
                $date = date("D F d Y", strtotime($row['created_date']));
                $time = date("H:i:s A", strtotime($row['created_date']));
                $logtype = ($row['log_type'] <= 1) 
                ? '<span
                    class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                    <span aria-hidden
                        class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                    <span class="relative">In</span>
                </span>' 
                : '<span class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                    <span aria-hidden
                        class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                    <span class="relative">Out</span>
                </span>';

                echo '
                    <tr>
                    <td class="px-5 py-5 text-sm">'.$inc++.'</td>
                    <td class="px-5 py-5 text-sm">
                        <div class="relative mx-auto w-20 h-20 rounded-full border-gray-300 border-2">
                            <img class="w-full h-full rounded-full" src="'.$row['avatar'].'" alt="avatar" />
                        </div>
                    </td>
                    <td class="px-5 py-5 text-sm">'.$row['fname'] .' '. strtoupper(substr($row['mname'], 0 , 1)) . ', '.$row['lname'].'</td>
                    <td class="px-5 py-5 text-sm">'.$row['type'].'</td>                
                    <td class="px-5 py-5 text-sm">' .$logtype.'</td>
                    <td class="px-5 py-5 text-sm">
                        <div class="text-red-400 text-xl">'.$date.'</div> 
                        <div class="text-blue-400 text-lg">'.$time.'</div>
                    </td>
                    </tr>
                ';
            }
        }
    }

    function printTeacherLogs() {
        require_once('../class/Controller.php');
        require_once('../class/TeachersLog.php');
        $logObj = new TeachersLog();
        $result = $logObj->printAllLogs();
        $inc = 1;

        if (!$result) {
            echo '<tr><td colspan="12" class="text-center font-extrabold">Data Not Found...</td></tr>';
            die();
        }

        if (is_array($result) || is_object($result)) { 
            foreach ($result as $row) {
                $date = date("D F d Y", strtotime($row['created_date']));
                $time = date("H:i:s A", strtotime($row['created_date']));
                $logtype = ($row['log_type'] <= 1) 
                ? '<span
                    class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                    <span aria-hidden
                        class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                    <span class="relative">In</span>
                </span>' 
                : '<span class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                    <span aria-hidden
                        class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                    <span class="relative">Out</span>
                </span>';

                echo '
                    <tr>
                    <td class="px-5 py-5 text-sm">'.$inc++.'</td>
                    <td class="px-5 py-5 text-sm">
                        <div class="relative mx-auto w-20 h-20 rounded-full border-gray-300 border-2">
                            <img class="w-full h-full rounded-full" src="'.$row['avatar'].'" alt="avatar" />
                        </div>
                    </td>
                    <td class="px-5 py-5 text-sm">'.$row['fname'] .' '. strtoupper(substr($row['mname'], 0 , 1)) . ', '.$row['lname'].'</td>
                    <td class="px-5 py-5 text-sm">'.$row['type'].'</td>                
                    <td class="px-5 py-5 text-sm">' .$logtype.'</td>
                    <td class="px-5 py-5 text-sm">
                        <div class="text-red-400 text-xl">'.$date.'</div> 
                        <div class="text-blue-400 text-lg">'.$time.'</div>
                    </td>
                    </tr>
                ';
            }
        }
    }

    function printVisitorLogs() {
        require_once('../class/Controller.php');
        require_once('../class/VisitorsLog.php');
        $logObj = new VisitorsLog();
        $result = $logObj->printAllLogs();
        $inc = 1;

        if (!$result) {
            echo '<tr><td colspan="12" class="text-center font-extrabold">Data Not Found...</td></tr>';
            die();
        }

        if (is_array($result) || is_object($result)) { 
            foreach ($result as $row) {
                $date = date("D F d Y", strtotime($row['created_date']));
                $time = date("H:i:s A", strtotime($row['created_date']));
                $logtype = ($row['log_type'] <= 1) 
                ? '<span
                    class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                    <span aria-hidden
                        class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                    <span class="relative">In</span>
                </span>' 
                : '<span class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                    <span aria-hidden
                        class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                    <span class="relative">Out</span>
                </span>';

                echo '
                    <tr>
                    <td class="px-5 py-5 text-sm">'.$inc++.'</td>
                    <td class="px-5 py-5 text-sm">
                        <div class="relative mx-auto w-20 h-20 rounded-full border-gray-300 border-2">
                            <img class="w-full h-full rounded-full" src="'.$row['avatar'].'" alt="avatar" />
                        </div>
                    </td>
                    <td class="px-5 py-5 text-sm">'.$row['fname'] .' '. strtoupper(substr($row['mname'], 0 , 1)) . ', '.$row['lname'].'</td>
                    <td class="px-5 py-5 text-sm">'.$row['type'].'</td>                
                    <td class="px-5 py-5 text-sm">' .$logtype.'</td>
                    <td class="px-5 py-5 text-sm">
                        <div class="text-red-400 text-xl">'.$date.'</div> 
                        <div class="text-blue-400 text-lg">'.$time.'</div>
                    </td>
                    </tr>
                ';
            }
        }
    }

    function Visitor() {
        $vstrsObj = new Visitors();
        if(isset($_GET['view'])
        ) {
            $vstrsObj->getAllVisitors();

        } elseif(isset($_GET['reset'])
        ) {
            $vstrsObj->resetTableData();

        } elseif((isset($_POST['data']) && trim($_POST['data'])!= '')
        ) {
            $vstrsObj->SeachVisitors($_POST['data']);

        } elseif((isset($_POST['scanFormVisitors']) && $_POST['scanFormVisitors']!= '')
            ) {
            foreach($_POST['scanFormVisitors'] as $value) {
                if((isset($value) && trim($value)!= '')
                ) { 
                    $vstrsObj->insertVisitors($_POST['scanFormVisitors']);
                    die();

                } else {
                    echo json_encode(array(
                        "message" => "Error: Fill up all the required fields.",
                        "status"  => "error"
                    ));
                    die();
                }
            }
        } elseif((isset($_POST['vipVisitorForm']) && $_POST['vipVisitorForm']!= '')
        ) {
        foreach($_POST['vipVisitorForm'] as $value) {
            if((isset($value) && trim($value)!= '')
            ) { 
                $idpass = $_POST['vipVisitorForm'][6];

                $_POST['vipVisitorForm'][] = 'Visitors_'. $idpass;
                $_POST['vipVisitorForm'][] = 'type_admin';
                unset($_POST['vipVisitorForm'][6]);

                $vstrsObj->insertVisitors($_POST['vipVisitorForm']);
                die();

            } else {
                echo json_encode(array(
                    "message" => "Error: Fill up all the required fields.",
                    "status"  => "error"
                ));
                die();
            }
        }

        } elseif ((isset($_POST['vstrs_chk']) && $_POST['vstrs_chk'] != '')
        ) {
        $vstrsObj->removeVisitors($_POST['vstrs_chk']);

        } elseif (isset($_GET['print'])
        ) {
        $vstrsObj->printAllVisitors();

        echo json_encode(array(
            "status"  => "success"
        )); 

        } elseif ((isset($_GET['vstrssort']) && trim($_GET['vstrssort'])!= '') 
        ) {

        $vstrsObj->sortVisitors(intval($_GET['vstrssort']));

        } elseif(isset($_GET['totalpage'])
        ) {
            $vstrsObj->visitorstotalPages();

        } elseif ((isset($_GET['pagenum']) && trim($_GET['pagenum'])!= '')) {
            $newnum = 0;
            ($_GET['pagenum'] == 0) ? $newnum=1 : $newnum=$_GET['pagenum'];
            $vstrsObj->paginateVisitors($newnum);

        } elseif(isset($_GET['viewUnact'])
        ) {
            $vstrsObj->getAllUnactVisitors();

        } elseif((isset($_POST['dataUnact']) && trim($_POST['dataUnact'])!= '')
        ) {
            $vstrsObj->SeachUnactVisitors($_POST['dataUnact']);

        } elseif ((isset($_POST['vstrsUnact_chk']) && $_POST['vstrsUnact_chk'] != '')
        ) {
        $vstrsObj->removeUnactVisitors($_POST['vstrsUnact_chk']);

        } elseif((isset($_POST['testCode']) && trim($_POST['testCode'])!= '')
        ) { 
        $vstrsObj->testQrCode($_POST['testCode']);

        } else {
            echo json_encode(array(
                "message" => "Error: Fill up all the required fields.",
                "status"  => "error"
            ));
        }
    }

    function printVisitors() {
        require_once('../class/Controller.php');
        require_once('../class/Visitors.php');
        $vtrsObj = new Visitors();
        $result = $vtrsObj->printAllVisitors();
        $inc = 1;

        if (is_array($result) || is_object($result)) { 
            foreach ($result as $row) {
                echo '
                    <tr>
                        <td class="px-5 py-5 text-sm">'.$inc++.'</td>
                        <td class="px-5 py-5 text-sm">
                        <div class="relative mx-auto w-20 h-20 rounded-full border-gray-300 border-2">
                            <img class="w-full h-full rounded-full" src="../assets/images/account.png" alt="avatar" />
                        </div>
                    </td>
                    <td class="px-5 py-5 text-sm">'.$row['id_pass'].'</td>
                    <td class="px-5 py-5 text-sm">'.$row['fname'] .' '. strtoupper(substr($row['mname'], 0 , 1)) . ', '.$row['lname'].'</td>
                    <td class="px-5 py-5 text-sm">'.$row['dob'].'</td>
                    <td class="px-5 py-5 text-sm">'.$row['gender'].'</td>                
                    <td class="px-5 py-5 text-sm">'.$row['address'].'</td>
                    <td class="px-5 py-5 text-sm">'.$row['contactno'].'</td>
                    <td class="px-5 py-5 text-sm">'.$row['porpose'].'</td>
                    </tr>
                ';
            }
        } else {
            echo '<tr><td colspan="10" class="text-center font-extrabold">Data Not Found...</td></tr>';
        }
    }

    function Year() {
        $yrObj = new Year();
        if(isset($_GET['view'])
        ) {
            $yrObj->getAllYear();

        } elseif((isset($_POST['data']) && trim($_POST['data'])!= '')
        ) {
            $yrObj->SeachYear($_POST['data']);

        } elseif((isset($_POST['yearForm']) && trim($_POST['yearForm'])!= '')
        ) {
            $yrObj->addYear($_POST['yearForm']);

        } elseif((isset($_POST['yr_chk']) && $_POST['yr_chk']!= '')
        ) {
            $yrObj->removeYear($_POST['yr_chk']);

        } elseif (isset($_GET['print'])
        ) {
            $yrObj->printAllYear();

            echo json_encode(array(
                "status"  => "success"
            )); 

        } elseif ((isset($_GET['yrsort']) && trim($_GET['yrsort'])!= '') 
        ) {
            $yrObj->sortYear(intval($_GET['yrsort']));

        } elseif(isset($_GET['totalpage'])
        ) {
            $yrObj->yeartotalPages();

        } elseif ((isset($_GET['pagenum']) && trim($_GET['pagenum'])!= '')) {
            $newnum = 0;
            ($_GET['pagenum'] == 0) ? $newnum=1 : $newnum=$_GET['pagenum'];
            $yrObj->paginateYear($newnum);
            
        } elseif((isset($_POST['yrid']) && trim($_POST['yrid'])!= '')
        ) { 
            $yrObj->updateValueYear($_POST['yrid']);

        } elseif (
            (isset($_POST['yearnewForm']) && $_POST['yearnewForm'] != '')
            ) {
            foreach($_POST['yearnewForm'] as $value) {
                if((isset($value) && trim($value)!= '')
                ) { 
                    $yrObj->updateYear($_POST['yearnewForm']);
                    die();
                } else {
                    echo json_encode(array(
                        "message" => "Error: Fill up all the required fields.",
                        "status"  => "error"
                    ));
                }
            }
            
        }elseif(isset($_GET['viewUnact'])
        ) {
            $yrObj->getAllUnactiveYear();

        } elseif((isset($_POST['dataUnact']) && trim($_POST['dataUnact'])!= '')
        ) {
            $yrObj->SeachUnactYear($_POST['dataUnact']);

        } elseif((isset($_POST['yrunact_chk']) && $_POST['yrunact_chk']!= '')
        ) {
            $yrObj->removeUnactYear($_POST['yrunact_chk']);
       
        } else {
            echo json_encode(array(
                "message" => "Error: Fill up all the required fields.",
                "status"  => "error"
            ));
        }
    }

    function printSchoolYear() {
        require_once('../class/Controller.php');
        require_once('../class/Year.php');
        $yrObj = new Year();
        $result = $yrObj->printAllYear();
        $inc = 1;

        if (is_array($result) || is_object($result)
        ) { 
            foreach ($result as $row) {
                echo '
                    <tr>
                    <td class="px-5 py-5 text-sm">'.$inc++.'</td>
       
                    <td class="px-5 py-5 text-sm">'.$row['schoolyear'].'</td>
                    </tr>
                ';
            }
        } else {
            echo '<tr><td colspan="2" class="text-center font-extrabold">Data Not Found...</td></tr>';
        }
    }

    function Level() {
        $lvlObj = new Level();
        if(isset($_GET['view'])
        ) {
            $lvlObj->getAllLevel();

        } elseif((isset($_POST['data']) && trim($_POST['data'])!= '')
        ) {
            $lvlObj->SeachLevel($_POST['data']);

        } elseif((isset($_POST['lvlValForm']) && $_POST['lvlValForm']!= '')
        ) {
            foreach($_POST['lvlValForm'] as $value) {
                if((isset($value) && trim($value)!= '')
                ) { 
                    $lvlObj->insertLevel($_POST['lvlValForm']);
                    die();

                } else {
                    echo json_encode(array(
                        "message" => "Error: Fill up all the required fields.",
                        "status"  => "error"
                    ));
                    die();
                }
            }

        } elseif((isset($_POST['lvl_chk']) && $_POST['lvl_chk']!= '')
        ) {
            $lvlObj->removeLevel($_POST['lvl_chk']);

        } elseif (isset($_GET['print'])
        ) {
            $lvlObj->printAllLevel();

            echo json_encode(array(
                "status"  => "success"
            )); 
        } elseif ((isset($_GET['lvlsort']) && trim($_GET['lvlsort'])!= '') 
        ) {
            $lvlObj->sortLevel(intval($_GET['lvlsort']));

        } elseif(isset($_GET['totalpage'])
        ) {
            $lvlObj->leveltotalPages();

        } elseif ((isset($_GET['pagenum']) && trim($_GET['pagenum'])!= '')) {
            $newnum = 0;
            ($_GET['pagenum'] == 0) ? $newnum=1 : $newnum=$_GET['pagenum'];
            $lvlObj->paginateLevel($newnum);

        } elseif((isset($_POST['lvlid']) && trim($_POST['lvlid'])!= '')
        ) { 
            $lvlObj->updateValueLevel($_POST['lvlid']);

        } elseif (
            (isset($_POST['lvlNewValForm']) && $_POST['lvlNewValForm'] != '')
            ) {
            foreach($_POST['lvlNewValForm'] as $value) {
                if((isset($value) && trim($value)!= '')
                ) { 
                    $lvlObj->updateLevel($_POST['lvlNewValForm']);
                    die();
                } else {
                    echo json_encode(array(
                        "message" => "Error: Fill up all the required fields.",
                        "status"  => "error"
                    ));
                }
            }

        } elseif(isset($_GET['viewUnact'])
        ) {
            $lvlObj->getAllUnactLevel();

        } elseif((isset($_POST['dataUnact']) && trim($_POST['dataUnact'])!= '')
        ) {
            $lvlObj->SeachUnactLevel($_POST['dataUnact']);

        } elseif((isset($_POST['lvlUnact_chk']) && $_POST['lvlUnact_chk']!= '')
        ) {
            $lvlObj->removeUnactLevel($_POST['lvlUnact_chk']);

        } else {
            echo json_encode(array(
                "message" => "Error: Fill up all the required fields.",
                "status"  => "error"
            ));
        }
    }

    function printYearLevel() {
        require_once('../class/Controller.php');
        require_once('../class/Level.php');
        $lvlObj = new Level();
        $result = $lvlObj->printAllLevel();
        $inc = 1;

        if (is_array($result) || is_object($result)
        ) { 
            foreach ($result as $row) {
                echo '
                    <tr>
                    <td class="px-5 py-5 text-sm">'.$inc++.'</td>
       
                    <td class="px-5 py-5 text-sm">'.$row['grade_level'].'</td>

                    <td class="px-5 py-5 text-sm">'.$row['discription'].'</td>
                    </tr>
                ';
            }
        } else {
            echo '<tr><td colspan="3" class="text-center font-extrabold">Data Not Found...</td></tr>';
        }
    }

    function Subject() {
        $sbjObj = new Subject();
        if(isset($_GET['view'])
        ) {
            $sbjObj->getAllSubject();

        } elseif((isset($_POST['data']) && trim($_POST['data'])!= '')
        ) {
            $sbjObj->SeachSubject($_POST['data']);

        } elseif((isset($_POST['sbjFormVal']) && $_POST['sbjFormVal']!= '')
        ) {
            foreach($_POST['sbjFormVal'] as $value) {
                if((isset($value) && trim($value)!= '')
                ) { 
                    $sbjObj->insertSubject($_POST['sbjFormVal']);
                    die();

                } else {
                    echo json_encode(array(
                        "message" => "Error: Fill up all the required fields.",
                        "status"  => "error"
                    ));
                    die();
                }
            }
        } elseif (isset($_GET['print'])
        ) {
            $sbjObj->printAllSubject();

            echo json_encode(array(
                "status"  => "success"
            )); 
        } elseif((isset($_POST['sbj_chk']) && $_POST['sbj_chk']!= '')
        ) {
            $sbjObj->removeSubject($_POST['sbj_chk']);

        } elseif ((isset($_GET['sbjsort']) && trim($_GET['sbjsort'])!= '') 
        ) {
            $sbjObj->sortSubject(intval($_GET['sbjsort']));

        } elseif(isset($_GET['totalpage'])
        ) {
            $sbjObj->subjectstotalPages();

        } elseif ((isset($_GET['pagenum']) && trim($_GET['pagenum'])!= '')) {
            $newnum = 0;
            ($_GET['pagenum'] == 0) ? $newnum=1 : $newnum=$_GET['pagenum'];
            $sbjObj->paginateSubject($newnum);
            
        } elseif((isset($_POST['sbjid']) && trim($_POST['sbjid'])!= '')
        ) { 
            $sbjObj->updateValueSubject($_POST['sbjid']);

        } elseif (
            (isset($_POST['sbjNewFormVal']) && $_POST['sbjNewFormVal'] != '')
            ) {
            foreach($_POST['sbjNewFormVal'] as $value) {
                if((isset($value) && trim($value)!= '')
                ) { 
                    $sbjObj->updateSubject($_POST['sbjNewFormVal']);
                    die();
                } else {
                    echo json_encode(array(
                        "message" => "Error: Fill up all the required fields.",
                        "status"  => "error"
                    ));
                }
            }

        } elseif(isset($_GET['viewUnact'])
        ) {
            $sbjObj->getAllUnactSubject();

        } elseif((isset($_POST['dataUnact']) && trim($_POST['dataUnact'])!= '')
        ) {
            $sbjObj->SeachUnactSubject($_POST['dataUnact']);

        } elseif((isset($_POST['sbjUnact_chk']) && $_POST['sbjUnact_chk']!= '')
        ) {
            $sbjObj->removeUnactSubject($_POST['sbjUnact_chk']);

        } else {
            echo json_encode(array(
                "message" => "Error: Fill up all the required fields.",
                "status"  => "error"
            ));
        }
    }

    function printSubject() {
        require_once('../class/Controller.php');
        require_once('../class/Subject.php');
        $sbjObj = new Subject();
        $result = $sbjObj->printAllSubject();
        $inc = 1;

        if (is_array($result) || is_object($result)
        ) { 
            foreach ($result as $row) {
                echo '
                    <tr>
                    <td class="px-5 py-5 text-sm">'.$inc++.'</td>
                    <td class="px-5 py-5 text-sm">'.$row['subject_name'].'</td>
                    <td class="px-5 py-5 text-sm">'.$row['discription_subject'].'</td>
                    <td class="px-5 py-5 text-sm">'.$row['grade_level'].'</td>
                    </tr>
                ';
            }
        } else {
            echo '<tr><td colspan="2" class="text-center font-extrabold">Data Not Found...</td></tr>';
        }
    }

    function Classes() {
        $clsjObj = new Classes();
        if(isset($_GET['view'])
        ) {
            $clsjObj->getAllClasses();

        } elseif((isset($_POST['data']) && trim($_POST['data'])!= '')
        ) {
            $clsjObj->SeachClass($_POST['data']);

        } elseif((isset($_POST['clsFormVal']) && $_POST['clsFormVal']!= '')
        ) {
            foreach($_POST['clsFormVal'] as $value) {
                if((isset($value) && trim($value)!= '')
                ) { 
                    $clsjObj->insertClass($_POST['clsFormVal']);
                    die();

                } else {
                    echo json_encode(array(
                        "message" => "Error: Fill up all the required fields.",
                        "status"  => "error"
                    ));
                    die();
                }
            }
        } elseif((isset($_POST['cls_chk']) && $_POST['cls_chk']!= '')
        ) {
            $clsjObj->removeClass($_POST['cls_chk']);

        } elseif (isset($_GET['print'])
        ) {
            $clsjObj->printAllClass();

            echo json_encode(array(
                "status"  => "success"
            )); 

        } elseif ((isset($_GET['clssort']) && trim($_GET['clssort'])!= '') 
        ) {
            $clsjObj->sortClass(intval($_GET['clssort']));

        } elseif(isset($_GET['totalpage'])
        ) {
            $clsjObj->classtotalPages();

        } elseif ((isset($_GET['pagenum']) && trim($_GET['pagenum'])!= '')) {
            $newnum = 0;
            ($_GET['pagenum'] == 0) ? $newnum=1 : $newnum=$_GET['pagenum'];
            $clsjObj->paginateClass($newnum);

        } elseif((isset($_POST['clsid']) && trim($_POST['clsid'])!= '')
        ) { 
            $clsjObj->updateValueClass($_POST['clsid']);

        } elseif (
            (isset($_POST['clsNewFormVal']) && $_POST['clsNewFormVal'] != '')
            ) {
            foreach($_POST['clsNewFormVal'] as $value) {
                if((isset($value) && trim($value)!= '')
                ) { 
                    $clsjObj->updateClass($_POST['clsNewFormVal']);
                    die();
                } else {
                    echo json_encode(array(
                        "message" => "Error: Fill up all the required fields.",
                        "status"  => "error"
                    ));
                }
            }
        } elseif(isset($_GET['viewUnact'])
        ) {
            $clsjObj->getAllUnactClasses();

        } elseif((isset($_POST['dataUnact']) && trim($_POST['dataUnact'])!= '')
        ) {
            $clsjObj->SeachUnactClass($_POST['dataUnact']);

        } elseif((isset($_POST['clsUnact_chk']) && $_POST['clsUnact_chk']!= '')
        ) {
            $clsjObj->removeUnactClass($_POST['clsUnact_chk']);

        } else {
            echo json_encode(array(
                "message" => "Error: Fill up all the required fields.",
                "status"  => "error"
            ));
        }
    }

    function printClass() {
        require_once('../class/Controller.php');
        require_once('../class/Classes.php');
        $clsObj = new Classes();
        $result = $clsObj->printAllClass();
        $inc = 1;

        if (is_array($result) || is_object($result)
        ) { 
            foreach ($result as $row) {
                echo '
                    <tr>
                    <td class="px-5 py-5 text-sm">'.$inc++.'</td>
                    <td class="px-5 py-5 text-sm">'.$row['classname'].'</td>
                    <td class="px-5 py-5 text-sm">'.$row['schoolyear'].'</td>
                    <td class="px-5 py-5 text-sm">'.$row['grade_level'].'</td>
                    </tr>
                ';
            }
        } else {
            echo '<tr><td colspan="4" class="text-center font-extrabold">Data Not Found...</td></tr>';
        }
    }

    function StudentClass() {
        $stdclsObj = new StudentClass();
        if(isset($_GET['view'])
        ) {
            $stdclsObj->getAllStdClasses();

        } elseif((isset($_POST['data']) && trim($_POST['data'])!= '')
        ) {
            $stdclsObj->SeachSdtClass($_POST['data']);

        } elseif((isset($_POST['stdClassFormVal']) && $_POST['stdClassFormVal']!= '')
        ) {
            foreach($_POST['stdClassFormVal'] as $value) {
                if((isset($value) && trim($value)!= '')
                ) { 
                    $stdclsObj->insertStudentClass($_POST['stdClassFormVal']);
                    die();

                } else {
                    echo json_encode(array(
                        "message" => "Error: Fill up all the required fields.",
                        "status"  => "error"
                    ));
                    die();
                }
            }

        } elseif (isset($_GET['print'])
        ) {
            $stdclsObj->printAllStudentClass();

            echo json_encode(array(
                "status"  => "success"
            )); 

        } elseif ((isset($_GET['stdclasssort']) && trim($_GET['stdclasssort'])!= '') 
        ) {
            $stdclsObj->sortStudentClass(intval($_GET['stdclasssort']));

        } elseif(isset($_GET['totalpage'])
        ) {
            $stdclsObj->studentClassTotalPages();
        
        } elseif ((isset($_GET['pagenum']) && trim($_GET['pagenum'])!= '')) {
            $newnum = 0;
            ($_GET['pagenum'] == 0) ? $newnum=1 : $newnum=$_GET['pagenum'];
            $stdclsObj->paginateStudentClass($newnum);

        } elseif((isset($_POST['stdclass_chk']) && $_POST['stdclass_chk']!= '')
        ) {
            $stdclsObj->removeStudentClass($_POST['stdclass_chk']);

        } elseif((isset($_POST['stdclassid']) && trim($_POST['stdclassid'])!= '')
        ) { 
            $stdclsObj->updateValueStudentClass($_POST['stdclassid']);

        } elseif (
            (isset($_POST['stdClassNewFormVal']) && $_POST['stdClassNewFormVal'] != '')
            ) {
            foreach($_POST['stdClassNewFormVal'] as $value) {
                if((isset($value) && trim($value)!= '')
                ) { 
                    $stdclsObj->updateStudentClass($_POST['stdClassNewFormVal']);
                    die();
                } else {
                    echo json_encode(array(
                        "message" => "Error: Fill up all the required fields.",
                        "status"  => "error"
                    ));
                }
            }   

        } elseif(isset($_GET['viewUnactive'])
        ){
            $stdclsObj->getAllUnactiveStdClass();

        } elseif((isset($_POST['unactdata']) && trim($_POST['unactdata'])!= '')
        ) {
            $stdclsObj->SeachUnactSdtClass($_POST['unactdata']);

        } elseif((isset($_POST['unactstdclass_chk']) && $_POST['unactstdclass_chk']!= '')
        ) {
            $stdclsObj->removeUnactStudentClass($_POST['unactstdclass_chk']);
        
        } else {
            echo json_encode(array(
                "message" => "Error: Fill up all the required fields.",
                "status"  => "error"
            ));
        }
    }

    function TeacherAdvisory() {

        $tchrAdvObj = new TeacherAdvisory();
        if(isset($_GET['view'])
        ) {
            $tchrAdvObj->getAllStdTeacherAdvisory();

        } elseif((isset($_POST['data']) && trim($_POST['data'])!= '')
        ) {
            $tchrAdvObj->SeachTeacherAdvisory($_POST['data']);

        } elseif((isset($_POST['tchrAdvFormVal']) && $_POST['tchrAdvFormVal']!= '')
        ) {
            foreach($_POST['tchrAdvFormVal'] as $value) {
                if((isset($value) && trim($value)!= '')
                ) { 
                    $tchrAdvObj->insertTeacherAdvisory($_POST['tchrAdvFormVal']);
                    die();

                } else {
                    echo json_encode(array(
                        "message" => "Error: Fill up all the required fields.",
                        "status"  => "error"
                    ));
                    die();
                }
            }

        } elseif (isset($_GET['print'])
        ) {
            $tchrAdvObj->printAllTeacherAdvisory();

            echo json_encode(array(
                "status"  => "success"
            )); 
        } elseif((isset($_POST['tchrAdv_chk']) && $_POST['tchrAdv_chk']!= '')
        ) {
            $tchrAdvObj->removeTeacherAdvisory($_POST['tchrAdv_chk']);

        } elseif ((isset($_GET['tchradvsort']) && trim($_GET['tchradvsort'])!= '') 
        ) {
            $tchrAdvObj->sortStudentTeacherAdvisory(intval($_GET['tchradvsort']));

        } elseif(isset($_GET['totalpage'])
        ) {
            $tchrAdvObj->tecaherAdvisoryTotalPages();

        } elseif ((isset($_GET['pagenum']) && trim($_GET['pagenum'])!= '')) {
            $newnum = 0;
            ($_GET['pagenum'] == 0) ? $newnum=1 : $newnum=$_GET['pagenum'];
            $tchrAdvObj->paginateTeacherAdvisory($newnum);

        } elseif((isset($_POST['tchradvid']) && trim($_POST['tchradvid'])!= '')
        ) { 
            $tchrAdvObj->updateValueTeacherAdvisory($_POST['tchradvid']);

        } elseif (
            (isset($_POST['tchrAdvNewFormVal']) && $_POST['tchrAdvNewFormVal'] != '')
            ) {
            foreach($_POST['tchrAdvNewFormVal'] as $value) {
                if((isset($value) && trim($value)!= '')
                ) { 
                    $tchrAdvObj->updateTeacherAdvisory($_POST['tchrAdvNewFormVal']);
                    die();
                } else {
                    echo json_encode(array(
                        "message" => "Error: Fill up all the required fields.",
                        "status"  => "error"
                    ));
                }
            }

        } elseif(isset($_GET['viewUnact'])
        ) {
            $tchrAdvObj->getAllUnactStdTeacherAdvisory();

        } elseif((isset($_POST['dataUnact']) && trim($_POST['dataUnact'])!= '')
        ) {
            $tchrAdvObj->SeachUnactTeacherAdvisory($_POST['dataUnact']);

        } elseif((isset($_POST['UnactTchrAdvsy_chk']) && $_POST['UnactTchrAdvsy_chk']!= '')
        ) {
            $tchrAdvObj->removeUnactTeacherAdvisory($_POST['UnactTchrAdvsy_chk']);

        } else {
            echo json_encode(array(
                "message" => "Error: Fill up all the required fields.",
                "status"  => "error"
            ));
        }
    }

    function printTeacherAdvisory() {
        require_once('../class/Controller.php');
        require_once('../class/TeacherAdvisory.php');
        $tchrAdvObj = new TeacherAdvisory();
        $result = $tchrAdvObj->printAllTeacherAdvisory();
        $inc = 1;

        if (is_array($result) || is_object($result)
        ) { 
            foreach ($result as $row) {
                echo '
                    <tr>
                    <td class="px-5 py-5 text-sm">'.$inc++.'</td>
                    <td>
                        <div class="relative mx-auto w-20 h-20 rounded-full border-gray-300 border-2">
                            <img class="w-full h-full rounded-full" src="'.$row['avatar'].'" alt="avatar" />
                        </div>
                    </td>
                    <td class="px-5 py-5 text-sm">'.$row['classname'].'</td>
                    <td class="px-5 py-5 text-sm">'.$row['fname'] .' '. strtoupper(substr($row['mname'], 0 , 1)) . ', '.$row['lname'].'</td>
                    <td class="px-5 py-5 text-sm">'.$row['subject_name'].' - '.$row['discription_subject'].'</td>
                    </tr>
                ';
            }
        } else {
            echo '<tr><td colspan="4" class="text-center font-extrabold">Data Not Found...</td></tr>';
        }
    }

    function printStudentClass() {
        require_once('../class/Controller.php');
        require_once('../class/StudentClass.php');
        $stdclsObj = new StudentClass();
        $result = $stdclsObj->printAllStudentClass();
        $inc = 1;

        if (is_array($result) || is_object($result)
        ) { 
            foreach ($result as $row) {
                echo '
                    <tr>
                    <td class="px-5 py-5 text-sm">'.$inc++.'</td>
                    <td>
                        <div class="relative mx-auto w-20 h-20 rounded-full border-gray-300 border-2">
                            <img class="w-full h-full rounded-full" src="'.$row['avatar'].'" alt="avatar" />
                        </div>
                    </td>
                    <td class="px-5 py-5 text-sm">'.$row['classname'].'</td>
                    <td class="px-5 py-5 text-sm">'.$row['fname'] .' '. strtoupper(substr($row['mname'], 0 , 1)) . ', '.$row['lname'].'</td>
                    <td class="px-5 py-5 text-sm">'.$row['subject_name'].' - '.$row['discription_subject'].'</td>
                    </tr>
                ';
            }
        } else {
            echo '<tr><td colspan="4" class="text-center font-extrabold">Data Not Found...</td></tr>';
        }
    }

    function CsvFile() {
        session_start();
        $tempcsvObj = new TemplateCsvFile();
    
        if ((isset($_GET['syid']) && trim($_GET['syid'])!= '') 
        && (isset($_GET['subid']) && trim($_GET['subid'])!= '')
        && (isset($_GET['cid']) && trim($_GET['cid'])!= '')
        && (isset($_GET['tcid']) && trim($_GET['tcid'])!= '')
        ) {
            $tempcsvObj->getAllAddedTemplate($_GET);
            
        } elseif(isset($_GET['downloadcsvfile'])
        ) {
            $tempcsvObj->downloadCsvFile();
            
        } else {
            echo json_encode(array(
                "message" => "Error: Fill up all the required fields.",
                "status"  => "error"
            ));
        }
    }

    function TeacherAccount() {
        session_start();
        $tchraccObj = new TeacherAccount($_SESSION['userid']);

        if(isset($_GET['viewprofile'])) {
            $tchraccObj->getAllUser();

        } elseif (isset($_POST['formTeacherVal'])
        ) {
            if(strlen($_POST['formTeacherVal'][10]) < 8 ) {

                $response = json_encode(array(
                    "message" => "Invalid password must 8 characters!",
                    "status"  => "error"
                ));

            } elseif($_POST['formTeacherVal'][9] !== $_POST['formTeacherVal'][10]) {

                $response = json_encode(array(
                    "message" => "Password does not match!",
                    "status"  => "error"
                ));

            } else {
            
                foreach($_POST['formTeacherVal'] as $value) {
                    if((isset($value) && trim($value)!= '')
                    ) {  
                        $fileUpload = ''; 
                        if($_FILES["file"]["error"] != 4) {
                            require_once('fileUploader.php');
                
                            $fileUpload = upload($_FILES['file'], './uploads/');
                
                            if($fileUpload['status'] == 'error') {
                            echo json_encode($fileUpload);
                            die();
                            }
                        } else {
                            $fileUpload = array(
                            "message" => "Empty file.",
                            "status" => "error",
                            "avatar" => NULL,
                            );
                        }

                        $defaultAvatar = '../assets/images/account.png';
                        $fileUpload = '../uploads/'.$fileUpload['avatar'];
                
                        $_POST['formTeacherVal'][] = (strlen($_FILES['file']['name']) > 0 ) 
                                    ? $fileUpload 
                                    : $defaultAvatar;

                        $tchraccObj->updateTeacherProfile($_POST['formTeacherVal']);
                        die();
                        
                    } else {
                        echo json_encode(array(
                            "message" => "Error: Fill up all the required fields.",
                            "status"  => "error"
                        ));
                        die();
                    }
                }
            }
            echo $response;
            
        } elseif (isset($_GET['widgetstudent'])
        ) {
            $tchraccObj->widgetStudent();

        } elseif (isset($_GET['widgetstudentgrades'])
        ) {
            $tchraccObj->widgetStudentGrades();

        } elseif (isset($_GET['widgetattlog'])
        ) {
            $tchraccObj->widgetAttendaceLog();
        } elseif (isset($_GET['view'])) {
            $tchraccObj->getAllStudent();

        } elseif((isset($_POST['datastudentlist']) && trim($_POST['datastudentlist'])!= '')
        ) {
            $tchraccObj->SeachStudentList($_POST['datastudentlist']);

        } elseif (isset($_GET['print'])
        ) {
            $tchraccObj->printAllStudentList();

            echo json_encode(array(
                "status"  => "success"
            )); 

        } elseif ((isset($_GET['stdlistsort']) && trim($_GET['stdlistsort'])!= '') 
        ) {
            $tchraccObj->sortStudentList(intval($_GET['stdlistsort']));

        } elseif ((isset($_GET['pagenum']) && trim($_GET['pagenum'])!= '')) {
            $newnum = 0;
            ($_GET['pagenum'] == 0) ? $newnum=1 : $newnum=$_GET['pagenum'];
            $tchraccObj->paginateStudentList($newnum);

        } elseif ((isset($_GET['viewLog'])) 
        ) {
            $tchraccObj->viewAttendanceLogs();

        } elseif((isset($_POST['dataattlog']) && trim($_POST['dataattlog'])!= '')
        ) {
            $dateVal = json_decode($_POST['dataattlog'], true);
            $tchraccObj->trackDateAttendaceLogs($dateVal);
        
        } elseif (isset($_GET['print'])
        ) {
        $tchraccObj->printAllAttendanceLogs();

            echo json_encode(array(
                "status"  => "success"
            )); 

        } elseif ((isset($_GET['attlogssort']) && trim($_GET['attlogssort'])!= '') 
        ) {
            $tchraccObj->sortAttendanceLogs(intval($_GET['attlogssort']));

        } elseif(isset($_GET['totalpageattlogs'])
        ) {
            $tchraccObj->totalPagesAttendanceLogs();

        } elseif ((isset($_GET['pagenumattlogs']) && trim($_GET['pagenumattlogs'])!= '')) {
            $newnum = 0;
            ($_GET['pagenumattlogs'] == 0) ? $newnum=1 : $newnum=$_GET['pagenumattlogs'];
            $tchraccObj->paginateAttendanceLogs($newnum);

        } elseif(isset($_GET['viewStudentGrades'])
        ) {
            $tchraccObj->getAllStudentGrades();

        }elseif ((isset($_GET['clsid']) && trim($_GET['clsid'])!= '')
            && (isset($_GET['yrid']) && trim($_GET['yrid'])!= '')
            && (isset($_GET['subid']) && trim($_GET['subid'])!= '')
            ) {
            $tchraccObj->filterOptionGrades($_GET);

        } elseif((isset($_POST['yrid']) && trim($_POST['yrid'])!= '')
        ) {
            $yearVal = json_decode($_POST['yrid'], true);
            $tchraccObj->getValueClass($yearVal);

        } elseif((isset($_POST['cid']) && trim($_POST['cid'])!= '')
        ) {
            $classVal = json_decode($_POST['cid'], true);
            $tchraccObj->getValueStudent($classVal);

        } elseif((isset($_POST['subid']) && trim($_POST['subid'])!= '')
        ) {
            $studentVal = json_decode($_POST['subid'], true);
            $tchraccObj->getValueSubject($studentVal);

        } elseif((isset($_POST['addGradeValForm']) && $_POST['addGradeValForm']!= '')
        ) {
            foreach($_POST['addGradeValForm'] as $value) {
                if((isset($value) && trim($value)!= '')
                ) { 
                    $tchraccObj->insertStudentGrades($_POST['addGradeValForm']);
                    die();

                } else {
                    echo json_encode(array(
                        "message" => "Error: Fill up all the required fields.",
                        "status"  => "error"
                    ));
                    die();
                }
            }

        } elseif (
            (isset($_POST['newStudentGradesVal']) && $_POST['newStudentGradesVal'] != '')
            ) {
            foreach($_POST['newStudentGradesVal'] as $value) {
                if((isset($value) && trim($value)!= '')
                ) { 
                    $tchraccObj->updateStudentGrades($_POST['newStudentGradesVal']);
                    die();
                } else {
                    echo json_encode(array(
                        "message" => "Error: Fill up all the required fields.",
                        "status"  => "error"
                    ));
                }
            }

        } elseif((isset($_POST['sg_chk']) && $_POST['sg_chk']!= '')
        ) {
            $tchraccObj->removeStudentGrades($_POST['sg_chk']);
    
        } elseif ((isset($_GET['sgsort']) && trim($_GET['sgsort'])!= '') 
        ) {
            $tchraccObj->sortStudentGrades(intval($_GET['sgsort']));

        } elseif(isset($_GET['totalpageStdGrades'])
        ) {
            $tchraccObj->widgetStudentGrades();

        } elseif ((isset($_GET['pagenumstdGrades']) && trim($_GET['pagenumstdGrades'])!= '')) {
            $newnum = 0;
            ($_GET['pagenumstdGrades'] == 0) ? $newnum=1 : $newnum=$_GET['pagenumstdGrades'];
            $tchraccObj->paginateStudentGrades($newnum);

        } elseif ((isset($_POST[1]) && trim($_POST[1])!= '')
        ) { 

            $tchraccObj->uploadCsvFile($_POST);

        } elseif(isset($_GET['viewUnactStudentGrades'])
        ) {
            $tchraccObj->getAllUnactStudentGrades();

        }elseif ((isset($_GET['clsidUnact']) && trim($_GET['clsidUnact'])!= '')
        && (isset($_GET['yridUnact']) && trim($_GET['yridUnact'])!= '')
        && (isset($_GET['subidUnact']) && trim($_GET['subidUnact'])!= '')
        ) {
            $tchraccObj->filterOptionUnactGrades($_GET);

        } elseif((isset($_POST['sgUnact_chk']) && $_POST['sgUnact_chk']!= '')
        ) {
            $tchraccObj->removeUnactiveStudentGrades($_POST['sgUnact_chk']);

        } elseif ((isset($_GET['clsidPrint']) && trim($_GET['clsidPrint'])!= '') &&
        (isset($_GET['subid']) && trim($_GET['subid'])!= '') &&
        (isset($_GET['yridPrint']) && trim($_GET['yridPrint'])!= '')
        ) {
            $tchraccObj->printStudentRecords($_GET);

        } elseif(isset($_GET['printRecords'])
        ) {
            echo json_encode(array(
                "status" => "success"
            ));

        } elseif(isset($_GET['unsetPrint'])
        ) {
            $tchraccObj->unsetPrint();

        } elseif (isset($_GET['listClass']) && isset($_GET['ListYearLevel']) 
        ) { 
            $tchraccObj->optionSortStudentList(
                $_GET['listClass'],
                $_GET['ListYearLevel']
            );

        } else {
            echo json_encode(array(
                "message" => "Error: Fill up all the required fields.",
                "status"  => "error"
            ));
        }
    }

    function printStudentListTeacher() {
        require_once('../class/Controller.php');
        require_once('../class/TeacherAccount.php');
        $stdObj = new TeacherAccount($_SESSION['userid']);
        $result = $stdObj->printAllStudentList();
        $inc = 1;

        if (is_array($result) || is_object($result)
        ) { 
            foreach ($result as $result) {
                if (is_array($result) || is_object($result)
                ) { 
                    foreach ($result as $row) {
                        echo '
                            <tr>
                                <td class="px-5 py-5 text-sm">'.$inc++.'</td>
                                <td>
                                    <div class="relative mx-auto w-20 h-20 rounded-full border-gray-300 border-2">
                                        <img class="w-full h-full rounded-full" src="'.$row['avatar'].'" alt="avatar" />
                                    </div>
                                </td>
                                <td class="px-5 py-5 text-sm">'.$row['fname'] .' '. strtoupper(substr($row['mname'], 0 , 1)) . ', '.$row['lname'].'</td>

                                <td class="px-5 py-5 text-sm">'.$row['classname'].'</td>

                                <td class="px-5 py-5 text-sm">'.$row['grade_level'].' - '.$row['discription'].'</td>
                            </tr>
                        ';
                    }

                } else {
                    echo '<tr><td colspan="5" class="text-center font-extrabold">Data Not Found...</td></tr>';
                }
            }

        } else {
            echo '<tr><td colspan="5" class="text-center font-extrabold">Data Not Found...</td></tr>';
        }
    }

    function printLogsTeacher() {
        require_once('../class/Controller.php');
        require_once('../class/TeacherAccount.php');
        $logObj = new TeacherAccount($_SESSION['userid']);
        $result = $logObj->printAllAttendanceLogs();
        $inc = 1;

        if (!$result) {
            echo '<tr><td colspan="12" class="text-center font-extrabold">Data Not Found...</td></tr>';
            die();
        }

        if (is_array($result) || is_object($result)) { 
            foreach ($result as $row) {
                $date = date("D F d Y", strtotime($row['created_date']));
                $time = date("H:i:s A", strtotime($row['created_date']));
                $logtype = ($row['log_type'] <= 1) 
                ? '<span
                    class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                    <span aria-hidden
                        class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                    <span class="relative">In</span>
                </span>' 
                : '<span class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                    <span aria-hidden
                        class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                    <span class="relative">Out</span>
                </span>';

                echo '
                    <tr>
                    <td class="px-5 py-5 text-sm">'.$inc++.'</td>
                    <td class="px-5 py-5 text-sm">
                        <div class="relative mx-auto w-20 h-20 rounded-full border-gray-300 border-2">
                            <img class="w-full h-full rounded-full" src="'.$row['avatar'].'" alt="avatar" />
                        </div>
                    </td>
                    <td class="px-5 py-5 text-sm">'.$row['fname'] .' '. strtoupper(substr($row['mname'], 0 , 1)) . ', '.$row['lname'].'</td>
                    <td class="px-5 py-5 text-sm">'.$row['type'].'</td>                
                    <td class="px-5 py-5 text-sm">' .$logtype.'</td>
                    <td class="px-5 py-5 text-sm">
                        <div class="text-red-400 text-xl">'.$date.'</div> 
                        <div class="text-blue-400 text-lg">'.$time.'</div>
                    </td>
                    </tr>
                ';
            }
        }
    }

    function DynamicComponent() {
        $dyObj = new DynamicComponent();

        if(isset($_GET['leftLogo'])
        ) {
            $dyObj->getLeftLogo();
            
        } elseif(isset($_GET['rightLogo'])
        ) {
            $dyObj->getRightLogo();

        } elseif(isset($_GET['tableTitle'])
        ) {
            $dyObj->getAllTableTittle();

        } elseif(isset($_GET['title'])
        ) {
            $dyObj->getAllTittle();

        } elseif(isset($_GET['slideshow'])
        ) {
            $dyObj->getAllSlideShow();

        } elseif((isset($_GET['viewSlider']))
        ) {
            $dyObj->getAllSlider();

        } elseif((isset($_POST['type']) && $_POST['type']='type_upload_slider')
        ) {
            $fileUpload  = ''; 
            if($_FILES["file"]["error"] != 4) {
                require_once './php/fileUploader.php';

                $fileUpload = uploadComponent($_FILES['file'], './uploads/', 'slideshow_');

                if($fileUpload['status'] == 'error') {
                    echo json_encode($fileUpload);
                    die();
                }
            } else {
                echo json_encode(array(
                    "message" => "Empty file.",
                    "status" => "error",
                    "components" => NULL,
                ));
                die();
            }
            $dyObj->addSlider($fileUpload['components']);

        } elseif((isset($_POST['sldr_chk']) && $_POST['sldr_chk']!= '')
        ) {
            $dyObj->removeSlider($_POST['sldr_chk']);

        } elseif ((isset($_GET['sydrsort']) && trim($_GET['sydrsort'])!= '') 
        ) {
            $dyObj->sortSlider(intval($_GET['sydrsort']));

        } elseif(isset($_GET['totalpage'])
        ) {
            $dyObj->totalPagesSlider();

        } elseif ((isset($_GET['pagenumSlider']) && trim($_GET['pagenumSlider'])!= '')) {
            $newnum = 0;
            ($_GET['pagenumSlider'] == 0) ? $newnum=1 : $newnum=$_GET['pagenumSlider'];
            $dyObj->paginateSlider($newnum);

        } elseif ((isset($_POST['sliderVal']) && $_POST['sliderVal'] != '')
            ) {
            foreach($_POST['sliderVal'] as $value) {
                if((isset($value) && trim($value)!= '')
                ) { 
                    $fileUpload  = ''; 
                    if($_FILES["file"]["error"] != 4) {
                        require_once './php/fileUploader.php';

                        $fileUpload = uploadComponent($_FILES['file'], './uploads/', 'slideshow_');

                        if($fileUpload['status'] == 'error') {
                            echo json_encode($fileUpload);
                            die();
                        }
                    } else {
                        $fileUpload = array(
                            "message" => "Empty file.",
                            "status" => "error",
                            "components" => NULL,
                        );
                    }

                    $defaultAvatar = $_POST['sliderVal'][1];
                    $fileUpload = '../uploads/'.$fileUpload['components'];

                    $_POST['formNewVal'][] = (strlen($_FILES['file']['name']) > 0) 
                                ? $fileUpload 
                                : $defaultAvatar;
                    $dyObj->updateSlider($_POST['sliderVal']);
                    die();
                
                } else {
                    echo json_encode(array(
                        "message" => "Error: Fill up all the required fields.",
                        "status" => "error"
                    ));
                    die();
                }
            }

        } elseif((isset($_POST['idleftlogo']) && trim($_POST['idleftlogo']) !='') && (isset($_POST['idrightlogo']) && trim($_POST['idrightlogo']) !='') 
        ) { 
            $fileUpload = ''; 
            require_once('fileUploader.php');

            if($_FILES["fileL"]["error"] != 4) {

                $fileL = uploadComponent($_FILES['fileL'], './uploads/', 'logo_');

                if($fileL['status'] == 'error') {
                    echo json_encode($fileL);
                    die();
                }

                $dyObj->uploadLogoLeft(
                    './uploads/'.$fileL['components'],
                    $_POST['idleftlogo']
                );

                echo json_encode($fileL);

            } elseif($_FILES["fileR"]["error"] != 4) {

                $fileR = uploadComponent($_FILES['fileR'], './uploads/', 'logo_');

                if($fileR['status'] == 'error') {
                    echo json_encode($fileR);
                    die();
                }

                $dyObj->uploadRightLogo(
                    './uploads/'.$fileR['components'],
                    $_POST['idrightlogo']
                );

                echo json_encode($fileR);

            } else {
                echo json_encode(array(
                "message" => "Empty file.",
                "status" => "error",
                "components" => NULL,
                ));
            }

        } elseif ((isset($_POST['idTitle']) && trim($_POST['idTitle'])!= '') 
        && (isset($_POST['titleInput']) && trim($_POST['titleInput'])!= '')
        ){
            $dyObj->updateTitle(
                $_POST['idTitle'],
                $_POST['titleInput']
            );

        } elseif ((isset($_POST['idTableTitle']) && trim($_POST['idTableTitle'])!= '') 
        && (isset($_POST['tableTitle']) && trim($_POST['tableTitle'])!= '')
        && (isset($_POST['region']) && trim($_POST['region'])!= '')
        && (isset($_POST['division']) && trim($_POST['division'])!= '')
        ){
            $dyObj->updateTableTitle(
                $_POST['idTableTitle'],
                $_POST['tableTitle'],
                $_POST['region'],
                $_POST['division']
            );

        } elseif (isset($_GET['viewNews'])
        ) {
            $dyObj->getAllNews();

        } elseif((isset($_POST['dataNews']) && trim($_POST['dataNews'])!= '')
        ) {
            $dyObj->SeachNews($_POST['dataNews']);

        } elseif((isset($_POST['newsFormVal']) && $_POST['newsFormVal']!= '')
        ) {
            foreach($_POST['newsFormVal'] as $value) {
                if((isset($value) && trim($value)!= '')
                ) { 
                    $fileUpload  = ''; 
                    if($_FILES["file"]["error"] != 4) {
                        require_once './php/fileUploader.php';

                        $fileUpload = uploadComponent($_FILES['file'], './uploads/', 'News_');

                        if($fileUpload['status'] == 'error') {
                            echo json_encode($fileUpload);
                            die();
                        }
                    } else {
                        echo json_encode(array(
                            "message" => "Empty file.",
                            "status" => "error",
                            "components" => NULL,
                        ));
                    }

                    $defaultPic = './assets/slideShowImg/defaultImg.jpg';
                    $fileUpload = './uploads/'.$fileUpload['components'];

                    $_POST['newsFormVal'][] = (strlen($_FILES['file']['name']) > 0 ) 
                                ? $fileUpload 
                                : $defaultPic;
                    $dyObj->insertNews($_POST['newsFormVal']);
                    die();

                } else {
                    echo json_encode(array(
                        "message" => "Error: Fill up all the required fields.",
                        "status"  => "error"
                    ));
                    die();
                }
            }

        } elseif((isset($_POST['news_chk']) && $_POST['news_chk']!= '')
        ) {
            $dyObj->removeNews($_POST['news_chk']);

        } elseif ((isset($_GET['newssort']) && trim($_GET['newssort'])!= '') 
        ) {
            $dyObj->sortNews(intval($_GET['newssort']));

        } elseif(isset($_GET['totalPageNews'])
        ) {
            $dyObj->newsTotalPages();

        } elseif ((isset($_GET['pageNumNews']) && trim($_GET['pageNumNews'])!= '')
        ) {
            $newnum = 0;
            ($_GET['pageNumNews'] == 0) ? $newnum=1 : $newnum=$_GET['pageNumNews'];
            $dyObj->paginateNews($newnum);

        } elseif (
            (isset($_POST['newsUpdateFormVal']) && $_POST['newsUpdateFormVal'] != '')
            ) {
            foreach($_POST['newsUpdateFormVal'] as $value) {
                if((isset($value) && trim($value)!= '')
                ) { 
                    $fileUpload  = ''; 
                    if($_FILES["file"]["error"] != 4) {
                        require_once './php/fileUploader.php';

                        $fileUpload = uploadComponent($_FILES['file'], './uploads/', 'News_');
                        
                        if($fileUpload['status'] == 'error') {
                            echo json_encode($fileUpload);
                            die();
                        }
                    } else {
                        $fileUpload = array(
                            "message" => "Empty file.",
                            "status" => "error",
                            "components" => NULL,
                        );
                    }

                    $defaultAvatar = $_POST['newsUpdateFormVal'][1];
                    $fileUpload = './uploads/'.$fileUpload['components'];

                    $_POST['newsUpdateFormVal'][] = (strlen($_FILES['file']['name']) > 0) 
                                ? $fileUpload 
                                : $defaultAvatar;
                    $dyObj->updateNews($_POST['newsUpdateFormVal']);
                    die();
                }
            }
        } elseif((isset($_POST['newsUpdateValue']) && trim($_POST['newsUpdateValue'])!= '')
        ) {
            $dyObj->addValueUpdate($_POST['newsUpdateValue']);

        } elseif(isset($_GET['viewDepedLeader'])
        ) {
            $dyObj->getDepedLeader();

        } elseif((isset($_POST['numPosition']) && trim($_POST['numPosition'])!= '')
        ) {
            $dyObj->addValueUModal($_POST['numPosition']);

        } elseif((isset($_POST['depedLeadersFormVal']) && $_POST['depedLeadersFormVal']!= '')
        ) {
            foreach($_POST['depedLeadersFormVal'] as $value) {
                if((isset($value) && trim($value)!= '')
                ) {  
                    $fileUpload = ''; 
                    if($_FILES["file"]["error"] != 4) {
                        require_once './php/fileUploader.php';
            
                        $fileUpload = upload($_FILES['file'], './uploads/');
            
                        if($fileUpload['status'] == 'error') {
                            echo json_encode($fileUpload);
                        die();
                        }
                    } else {
                        $fileUpload = array(
                        "message" => "Empty file.",
                        "status" => "error",
                        "avatar" => NULL,
                        );
                    }

                    $defaultAvatar = $_POST['depedLeadersFormVal'][1];
                    $fileUpload = './uploads/'.$fileUpload['avatar'];
            
                    $_POST['depedLeadersFormVal'][] = (strlen($_FILES['file']['name']) > 0 ) 
                                ? $fileUpload 
                                : $defaultAvatar;

                    $dyObj->updateDepedLeaders($_POST['depedLeadersFormVal']);
                    die();

                } else {
                    echo json_encode(array(
                        "message" => "Error: Fill up all the required fields.",
                        "status"  => "error"
                    ));
                }
            }
        } elseif ((isset($_POST['title']) && trim($_POST['title'])!= '')
        && (isset($_POST['color']) && trim($_POST['color'])!= '')
        && (isset($_POST['start']) && trim($_POST['start'])!= '')
        && (isset($_POST['end']) && trim($_POST['end'])!= '')
        ) {
            $dyObj->addEvents($_POST);

        } elseif ((isset($_POST['eventsDrop']) && trim($_POST['eventsDrop'])!= '')
        ) {
            $parts = explode(',', $_POST['eventsDrop']);
            $dyObj->updateDropEvents($parts);

        } elseif ((isset($_POST['updateTitle']) && trim($_POST['updateTitle'])!= '') &&
        (isset($_POST['evenst_id']) && trim($_POST['evenst_id'])!= '')
        && (isset($_POST['updateColor']) && trim($_POST['updateColor'])!= '')
        && (isset($_POST['updateStart']) && trim($_POST['updateStart'])!= '')
        && (isset($_POST['updateEnd']) && trim($_POST['updateEnd'])!= '')
        ) {
            if(isset($_POST['delete'])
            ){
                $dyObj->deleteEvents($_POST['evenst_id']);
            }
             else {
                $dyObj->updateEvents($_POST);
            }

        } elseif (isset($_GET['EventsLandingPageview'])
        ) {
            $dyObj->getDisplayAllEvents();

        } elseif (isset($_GET['getDateNow'])
        ) {
            $dyObj->getDateNow();

        } elseif (isset($_GET['updateEvents'])
        ) {
            $dyObj->updateExpiredEvents($_GET['updateEvents']);

        } else {
            echo json_encode(array(
                "message" => "Error: Fill up all the required fields.",
                "status"  => "error"
            ));
        }
    }

    function GalleryView() {
        require_once('./class/Controller.php');
        require_once('./class/DynamicComponent.php');
        $dyObj = new DynamicComponent();
        $result = $dyObj->showGallery();

        if (is_array($result) || is_object($result)
        ) { 
            foreach ($result as $image) {
                $filename = $image['filename'];
                echo "
                    <div class='col-sm-6 col-md-4'>
                        <a class='lightbox' href='$filename'>
                            <img class='object-fill h-60 w-full border-8 border-double border-red-900' src='$filename' alt='Gallery'>
                        </a>
                    </div>
                ";
            }
        }
    }

    function UploadSchoolGallery() {
        $dyObj = new DynamicComponent();

        if (isset($_GET['galleryView'])
        ) {
            $dyObj->getGallery();

        } elseif((isset($_POST['type_gallery']) && trim($_POST['type_gallery'])!= '')
        ) {
            $fileUpload  = ''; 
            if($_FILES["file"]["error"] != 4) {
                require_once './php/fileUploader.php';

                $fileUpload = uploadComponent($_FILES['file'], './uploads/', 'SchoolGallery_');

                $dyObj->uploadSchoolGallery(
                    './uploads/'.$fileUpload['components']
                );
                
                if($fileUpload['status'] == 'error') {
                    echo json_encode($fileUpload);
                    die();
                }    
            } else {
                echo array(
                    "message" => "Empty file.",
                    "status"  => "error",
                    "components" => NULL,
                );
            }

        } elseif(isset($_POST['gallery_chk'])
        ) {
            $dyObj->removeSchoolGallery($_POST['gallery_chk']);

        } elseif ((isset($_GET['gallerysort']) && trim($_GET['gallerysort'])!= '') 
        ) {
            $dyObj->sortSchoolGallery(intval($_GET['gallerysort']));

        } elseif(isset($_GET['totalpage'])
        ) {
            $dyObj->galleryTotalPages();

        } elseif ((isset($_GET['pagenumGallery']) && trim($_GET['pagenumGallery'])!= '')) {
            $newnum = 0;
            ($_GET['pagenumGallery'] == 0) ? $newnum=1 : $newnum=$_GET['pagenumGallery'];
            $dyObj->paginateSchoolGallery($newnum);

        } elseif (
            (isset($_POST['updateGalleryValForm']) && $_POST['updateGalleryValForm'] != '')
            ) {
            foreach($_POST['updateGalleryValForm'] as $value) {
                if((isset($value) && trim($value)!= '')
                ) { 
                    $fileUpload  = ''; 
                    if($_FILES["file"]["error"] != 4) {
                        require_once './php/fileUploader.php';

                        $fileUpload = uploadComponent($_FILES['file'], './uploads/', 'SchoolGallery_');
                        
                        if($fileUpload['status'] == 'error') {
                            echo json_encode($fileUpload);
                            die();
                        }
                    } else {
                        $fileUpload = array(
                            "message" => "Empty file.",
                            "status" => "error",
                            "components" => NULL,
                        );
                    }

                    $defaultAvatar = $_POST['updateGalleryValForm'][1];
                    $fileUpload = './uploads/'.$fileUpload['components'];

                    $_POST['updateGalleryValForm'][] = (strlen($_FILES['file']['name']) > 0) 
                                ? $fileUpload 
                                : $defaultAvatar;

                    $dyObj->updateSchoolGallery($_POST['updateGalleryValForm']);
                    die();
                }
            }
        
        } else {
            echo json_encode(array(
                "message" => "Error: Fill up all the required fields.",
                "status"  => "error"
            ));
        }
    }

    function UploadingVideo() {
        $Obj = new HeaderVideo();

        if(isset($_GET['viewVideo'])
        ) {
            $Obj->getHeaderVideo();

        } elseif((isset($_POST['type_video']) && trim($_POST['type_video'])!= '')) {

            $fileUpload  = ''; 
            if($_FILES["file"]["error"] != 4) {
                require_once './php/fileUploader.php';

                $fileUpload = uploadVideo($_FILES['file'], './uploads/', 'HeaderVideo_');

                $Obj->updateHeaderVideo('./uploads/'.$fileUpload['components']);
                
                if($fileUpload['status'] == 'error') {
                    echo json_encode($fileUpload);
                    die();
                }    
            } else {
                echo array(
                    "message" => "Empty file.",
                    "status"  => "error",
                    "components" => NULL,
                );
            }

        } else {
            echo json_encode(array(
                "message" => "Error: Fill up all the required fields.",
                "status"  => "error"
            ));
        }
    }

    function ViewScanGrades() {
        $gradesObj = new StudentGrades();

        if ((isset($_POST['passCode']) && trim($_POST['passCode'])!= '')
        ){
            $gradesObj->confirmStudent($_POST['passCode']);

        } elseif ((isset($_POST['credential']) && trim($_POST['credential'])!= '')
        ){
            $gradesObj->getPinCode(
                json_decode($_POST['credential'], true)
            );

        } elseif ((isset($_POST['validateConfirm']) && trim($_POST['validateConfirm'])!= '')
        ){
            $gradesObj->getThisStudentCode($_POST['validateConfirm']);

        } elseif ((isset($_POST['email']) && trim($_POST['email'])!= '')
        ){
            if($data = $gradesObj->validatePinCode($_POST)
            ) {
                require_once('sendEmail.php');
            }

        } else {
            echo json_encode(array(
                "message" => "Error: Fill up all the required fields.",
                "status"  => "error"
            ));
        } 
    }

    function ViewTeachersLogs() {
        $viewTechObj = new ViewTeachersLogs();

        if(isset($_GET['view'])
        ) {
            $viewTechObj->getAllViewTeachersLogs();

        } elseif(isset($_GET['totalLogsTeacher'])
        ) {
            $viewTechObj->totalViewTeachersLogs();

        } elseif ((isset($_POST['data']) && trim($_POST['data'])!= '')
        ){
            $viewTechObj->searchViewTeachersLogs($_POST['data']);

        } elseif ((isset($_GET['pagenum']) && trim($_GET['pagenum'])!= '')) {
            $newnum = 0;
            ($_GET['pagenum'] == 0) ? $newnum=1 : $newnum=$_GET['pagenum'];
            $viewTechObj->paginateVeiwTeacherLogs($newnum);

        } else {
            echo json_encode(array(
                "message" => "Error: Fill up all the required fields.",
                "status"  => "error"
            ));
        }
    }

    function FeedBack() {
        $obj = new Feedback();
        
        if ((isset($_POST['yearLevel']) && trim($_POST['yearLevel'])!= '')
        && (isset($_POST['message']) && trim($_POST['message'])!= '')
        ){
            if(!isset($_POST['fullname'])
            ) {
                $_POST['fullname'] = 'Anonymous';
            }

            $obj->addFeedBack(
                $_POST['fullname'],
                $_POST['yearLevel'], 
                $_POST['message']
            );

        } elseif (isset($_GET['countNewMsg'])
        ) {
            $obj->countAllNewMsg();

        } elseif (isset($_GET['viewNewMsg'])
        ) {
            $obj->getAllNewMsg();

        } elseif (isset($_GET['viewOldMsg'])
        ) {
            $obj->getAllOldMsg();

        } elseif ((isset($_POST['updateToOldMsg']) && trim($_POST['updateToOldMsg'])!= '')
        ){
            $obj->UpdateToOldMsg($_POST['updateToOldMsg']);

        } elseif ((isset($_POST['data']) && trim($_POST['data'])!= '')
        ){
            $obj->SearchAlldMsg($_POST['data']);

        } else {
            echo json_encode(array(
                "message" => "Error: Fill up all the required fields.",
                "status"  => "error"
            ));
        }
    }

    function Guard() {
        session_start();
        $obj = new Guard();

        if(isset($_GET['view'])
        ) {
            $obj->getAllGaurd();

        } elseif (isset($_POST['formGuardVal']) 
        ) {
            foreach($_POST['formGuardVal'] as $value) {
                if((isset($value) && trim($value)!= '')
                ) { 
                    if(strlen($_POST['formGuardVal'][8]) < 8 ) {

                        echo json_encode(array(
                            "message" => "Invalid password must 8 characters!",
                            "status"  => "error"
                        ));
                        die();
            
                    } elseif($_POST['formGuardVal'][8] !== $_POST['formGuardVal'][9]) {
            
                        echo json_encode(array(
                            "message" => "Password does not match!",
                            "status"  => "error"
                        ));
                        die();
                    } 
                        
                    $fileUpload  = ''; 
                    if($_FILES["file"]["error"] != 4) {
                        require_once './php/fileUploader.php';

                        $fileUpload = upload($_FILES['file'], './uploads/');

                        if($fileUpload['status'] == 'error') {
                            echo json_encode($fileUpload);
                            die();
                        }
                    } else {
                        $fileUpload = array(
                            "message" => "Empty file.",
                            "status" => "error",
                            "avatar" => NULL,
                        );
                    }

                    $defaultAvatar = '../assets/images/account.png';
                    $fileUpload = '../uploads/'.$fileUpload['avatar'];

                    $_POST['formGuardVal'][] = (strlen($_FILES['file']['name']) > 0 ) 
                                ? $fileUpload 
                                : $defaultAvatar;
                    $obj->addGuard($_POST['formGuardVal']);
                    die();
                
                } else {
                    echo json_encode(array(
                        "message" => "Error: Fill up all the required fields.",
                        "status" => "error"
                    ));
                    die();
                }
            }

        } elseif((isset($_POST['dataSearch']) && trim($_POST['dataSearch'])!= '')
        ) {
            $obj->seachGuard($_POST['dataSearch']);

        } elseif(isset($_GET['print'])
        ) {
            $obj->printAllGuard();

            echo json_encode(array(
                "status" => "success"
            ));

        } elseif(isset($_GET['gaurdsort'])
        ) {
            $obj->limitGuard(intval($_GET['gaurdsort']));

        } elseif(isset($_GET['totalpage'])
        ) {
            $obj->gaurdTotalPages();

        } elseif ((isset($_GET['pagenum']) && trim($_GET['pagenum'])!= '')) {

            $newnum = 0;
            ($_GET['pagenum'] == 0) ? $newnum=1 : $newnum=$_GET['pagenum'];
            $obj->paginateGuard($newnum);

        } elseif ((isset($_POST['gaurdid']) && trim($_POST['gaurdid'])!= '')) {
            $obj->addValueUpdateGuard($_POST['gaurdid']);

        } elseif (
            (isset($_POST['formNewVal']) && $_POST['formNewVal'] != '')
            ) {
                if(strlen($_POST['formNewVal'][11]) < 8) {

                    echo json_encode(array(
                        "message" => "Invalid password must 8 characters!",
                        "status"  => "error"
                    ));
                    die();
        
                } elseif($_POST['formNewVal'][10] !== $_POST['formNewVal'][11]) {
        
                    echo json_encode(array(
                        "message" => "Password does not match!",
                        "status"  => "error"
                    ));
                    die();
                } 

                foreach($_POST['formNewVal'] as $value) {
                    if((isset($value) && trim($value)!= '')
                    ) { 
                        $fileUpload  = ''; 
                        if($_FILES["file"]["error"] != 4) {
                            require_once './php/fileUploader.php';

                            $fileUpload = upload($_FILES['file'], './uploads/');

                            if($fileUpload['status'] == 'error') {
                                echo json_encode($fileUpload);
                                die();
                            }
                        } else {
                            $fileUpload = array(
                                "message" => "Empty file.",
                                "status"  => "error",
                                "avatar"  => NULL,
                            );
                        }

                        $defaultAvatar = $_POST['formNewVal'][1];
                        $fileUpload = '../uploads/'.$fileUpload['avatar'];

                        $_POST['formNewVal'][] = (strlen($_FILES['file']['name']) > 0) 
                                    ? $fileUpload 
                                    : $defaultAvatar;

                        $obj->updateGuard($_POST['formNewVal']);
                        die();
                    
                    } else {
                        echo json_encode(array(
                            "message" => "Error: Fill up all the required fields.",
                            "status" => "error"
                        ));
                        die();
                    }
                }

        } elseif (
            (isset($_POST['formGuardProfileVal']) && $_POST['formGuardProfileVal'] != '')
            ) {
                if(strlen($_POST['formGuardProfileVal'][11]) < 8) {

                    echo json_encode(array(
                        "message" => "Invalid password must 8 characters!",
                        "status"  => "error"
                    ));
                    die();
        
                } elseif($_POST['formGuardProfileVal'][10] !== $_POST['formGuardProfileVal'][11]) {
        
                    echo json_encode(array(
                        "message" => "Password does not match!",
                        "status"  => "error"
                    ));
                    die();
                } 

                foreach($_POST['formGuardProfileVal'] as $value) {
                    if((isset($value) && trim($value)!= '')
                    ) { 
                        $fileUpload  = ''; 
                        if($_FILES["file"]["error"] != 4) {
                            require_once './php/fileUploader.php';

                            $fileUpload = upload($_FILES['file'], './uploads/');

                            if($fileUpload['status'] == 'error') {
                                echo json_encode($fileUpload);
                                die();
                            }
                        } else {
                            $fileUpload = array(
                                "message" => "Empty file.",
                                "status"  => "error",
                                "avatar"  => NULL,
                            );
                        }

                        $defaultAvatar = $_POST['formGuardProfileVal'][1];
                        $fileUpload = '../uploads/'.$fileUpload['avatar'];

                        $_POST['formGuardProfileVal'][] = (strlen($_FILES['file']['name']) > 0) 
                                    ? $fileUpload 
                                    : $defaultAvatar;

                        $obj->updateProfileGuard($_POST['formGuardProfileVal']);
                        die();
                    
                    } else {
                        echo json_encode(array(
                            "message" => "Error: Fill up all the required fields.",
                            "status" => "error"
                        ));
                        die();
                    }
                }

        } elseif ((isset($_POST['gaurd_chk']) && $_POST['gaurd_chk'] != '')
        ) {
            $obj->removeGaurd($_POST['gaurd_chk']);

        } elseif(isset($_GET['viewInact'])
        ) {
            $obj->getAllInactive();

        } elseif ((isset($_POST['gaurdInact_chk']) && $_POST['gaurdInact_chk'] != '')
        ) {
            $obj->removeInactGaurd($_POST['gaurdInact_chk']);

        } elseif ((isset($_POST['dataInactSearch']) && $_POST['dataInactSearch'] != '')
        ) {
            $obj->searchInactGaurd($_POST['dataInactSearch']);

        } elseif(isset($_GET['viewProfile'])
        ) {
            $obj->guardProfile($_SESSION['guardid']);

        } else {
            echo json_encode(array(
                "message" => "Error: Fill up all the required fields.",
                "status"  => "error"
            ));
        }
    }

    function printGuard() {
        require_once('../class/Controller.php');
        require_once('../class/Guard.php');
        $Obj = new Guard();
        $result = $Obj->printAllGuard(); 
        
        $inc = 1;

        if (is_array($result) || is_object($result)) { 
            foreach ($result as $row) {
                echo '
                    <tr>
                        <td class="px-5 py-5 text-sm">'.$inc++.'</td>
                        <td class="px-5 py-5 text-sm">
                        <div class="relative mx-auto w-20 h-20 rounded-full border-gray-300 border-2">
                            <img class="w-full h-full rounded-full" src="'.$row['avatar'].'" alt="avatar" />
                        </div>
                    </td>
                    <td class="px-5 py-5 text-sm">'.$row['fname'] .' '. strtoupper(substr($row['mname'], 0 , 1)) . ', '.$row['lname'].'</td>
                    <td class="px-5 py-5 text-sm">'.$row['dob'].'</td>
                    <td class="px-5 py-5 text-sm">'.$row['gender'].'</td>                
                    <td class="px-5 py-5 text-sm">'.$row['address'].'</td>
                    <td class="px-5 py-5 text-sm">'.$row['email'].'</td>
                    <td class="px-5 py-5 text-sm">'.$row['contact_no'].'</td>
                    </tr>
                ';
            }
        } else {
            echo '<tr><td colspan="10" class="text-center font-extrabold">Data Not Found...</td></tr>';
        }
    }

    function ViewFilesReport() {
        $objReportFiles = new ReportFile();

        if(isset($_GET['view'])
        ) {
            $objReportFiles->getAllFilesReport();

        } elseif ((isset($_POST['folderName']) && $_POST['folderName'] != '')
        ) {
            $objReportFiles->addNewFolder($_POST['folderName']);

        } elseif ((isset($_POST['dataSearch']) && $_POST['dataSearch'] != '')
        ) {
            $objReportFiles->searchFolderName($_POST['dataSearch']);

        } elseif ((isset($_POST['idFoderName']) && $_POST['idFoderName'] != '')
        ) {
            $objReportFiles->addValueUpdateFolder($_POST['idFoderName']);

        } elseif ((isset($_POST['newfolderName']) && $_POST['newfolderName'] != '') 
        && (isset($_POST['id']) && $_POST['id'] != '')
        ) {
            $objReportFiles->updateFolder($_POST);

        } elseif ((isset($_POST['removeFolder']) && $_POST['removeFolder'] != '')
        ) {
            $objReportFiles->removeFolder($_POST['removeFolder']);

        } elseif (isset($_GET['viewFile'])
        ) {
            $objReportFiles->viewFiles($_GET['viewFile']);

        } elseif ((isset($_POST['reportFile']) && $_POST['reportFile'] != '')
        ) {
            $objReportFiles->searchFileReport($_POST['reportFile']);

        } elseif ((isset($_POST['type_file']) && $_POST['type_file'] != '') && (isset($_POST['folder_id']) && $_POST['folder_id'] != '')
        ) {
            $file_extensions = array_reverse(explode(".", basename($_FILES['file']["name"])))[0];

            $fileUpload  = ''; 
            if($_FILES["file"]["error"] != 4) {
                require_once './php/fileUploader.php';

                $fileUpload = uploadFile($_FILES['file'], './uploads/', 'FileReport_');

                if($fileUpload['status'] == 'error') {
                    echo json_encode($fileUpload);
                    die();
                }
            } else {
                echo json_encode(array(
                    "message" => "Empty file.",
                    "status" => "error",
                    "components" => NULL,
                ));
                die();
            }
            $objReportFiles->saveUploadFile(
                $fileUpload['fileReport'],
                $file_extensions,
                $_FILES['file']['size'],
                $_POST['folder_id']
            );

        } elseif ((isset($_POST['file_chk']) && $_POST['file_chk'] != '')
        ) {
            $objReportFiles->removeReportFile($_POST['file_chk']);

        } else {
            echo json_encode(array(
                "message" => "Error: Fill up all the required fields.",
                "status"  => "error"
            ));
        }
    }
?>