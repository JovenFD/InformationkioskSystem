<?php
    class TeacherAccount extends Controller {
        public $userid;

        public function __construct($userid) {
            $this->userid = $userid;
        }

        public function getAllUser() {
            try {
                $sql = "SELECT * FROM tbl_teacher WHERE status=:status 
                AND teacher_id=:teacher_id LIMIT 1";
                $paramType = ":placeholder";
                $paramValue = array(
                    "status"     => 'active',
                    "teacher_id" => $this->userid
                );

                if($result = $this->runSql($sql, $paramType, $paramValue)
                ){
                    $response = json_encode(array(
                        "message" => $result,
                        "status"  => "success"
                    )); 
                }
                
            } catch(Exception $e) {
                $response = json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status"  => "error"
                ));
            }
            echo $response;
        }

        public function updateTeacherProfile($data) {
            $usertype = 1;
            try {
                $sql = "UPDATE tbl_teacher SET 
                fname=:fname, 
                mname=:mname,
                lname=:lname, 
                gender=:gender,
                dob=:dob, 
                email=:email, 
                contact_no=:contact_no, 
                address=:address, 
                password=:password, 
                role_id=:role_id,
                avatar=:avatar
                WHERE teacher_id=:teacher_id";
    
                $paramType = ":placeholder";
                $paramValue = array(
                    "teacher_id" => $data[0],
                    "fname"      => $data[1],
                    "mname"      => $data[2],
                    "lname"      => $data[3],
                    "email"      => $data[4],
                    "dob"        => $data[5],
                    "contact_no" => $data[6],
                    "gender"     => $data[7],
                    "address"    => $data[8],
                    "password"   => $this->custom_hash($data[10]),
                    "avatar"     => $data[11],
                    "role_id"    => $usertype
                );
    
               if($this->insert($sql, $paramType, $paramValue)
               ){
                    $rsponse = json_encode(array(
                        "message" => "Successfully Update Teacher",
                        "status"  => "success"
                    ));
               }
    
           } catch(Exception $e) {
               $rsponse = json_encode(array(
                   "message" => "Error: " . $e->getMessage(),
                   "status" => "error"
               ));
           }
    
           echo $rsponse;
        }
        
        public function custom_hash($str) {
            $salt  = "WOXVENHITTY";
            $md5   = md5($str . $salt);
            $sha1  = sha1($salt . $md5);
            $hash  = md5($md5 . $sha1);
    
            for ($i=0; $i < strlen($str); $i++) { 
                $hash = md5($hash) . sha1($hash);
            }
            $hash = strtoupper(md5($hash));
    
            return $hash;
        } 

        public function checkUserId() {

            try {
                $sql = "SELECT * FROM tbl_teacheradvisory WHERE teacherid=:teacherid LIMIT 1";
                $paramType = ":placeholder";
                $paramValue = array(
                    "teacherid" => $this->userid
                );

                if($row = $this->runSql($sql, $paramType, $paramValue)
                ) {
                    return $row['classid'];
                }

            } catch(Exception $e) {
                echo json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status"  => "error"
                ));
            }
        } 

        public function widgetStudent() {
            try {
                $counter = 0;
                
                $sql = "SELECT * FROM tbl_teacheradvisory WHERE teacherid=".$this->userid;

                if($result = $this->runBaseSql($sql)
                ){
                    if (is_array($result) || is_object($result)
                    ) {                         
                        foreach ($result as $row) {
                            $classId = $row['classid'];

                            $sql = "SELECT * FROM tbl_student s 
                            LEFT JOIN tbl_studentclass sc ON sc.studentid = s.student_id
                            LEFT JOIN tbl_subject sb ON sc.subjectid = sb.subject_id
                            LEFT JOIN tbl_class c ON sc.classid = c.class_id 
                            LEFT JOIN tbl_gradelevel y ON c.level_id = y.level_id
                            WHERE s.status='active' 
                            AND s.status='active'
                            AND sc.status='active'
                            AND sb.status='active' 
                            AND c.status='active'
                            AND y.status='active'
                            AND c.class_id = $classId";
            
                            if($result = $this->runBaseSql($sql)
                            ){
                                if (is_array($result) || is_object($result)
                                ) { 
                                    foreach ($result as $value) {
                                        $counter++;
                                    }
                                }
                            } 
                        }  
                    }
                    echo json_encode(array(
                        "message" => $counter,
                        "status"  => "success"
                    ));
                    die();
                }

            } catch(Exception $e) {
                echo json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status"  => "error"
                ));
            }
        }

        public function widgetStudentGrades() {
            try {
                $userid = $this->userid;

                $sql = "SELECT *,sg.grade_id as sgid, 
                CONCAT(t.lname, ', ', t.fname, ' ', t.mname) as tname,
                CONCAT(s.lname, ', ', s.fname, ' ', s.mname) as sname FROM tbl_grades sg 
                LEFT JOIN tbl_studentclass sc ON sg.classid = sc.classid 
                AND sg.studentid = sc.studentid AND sg.subjectid = sc.subjectid 
                LEFT JOIN tbl_student s ON sg.studentid = s.student_id 
                LEFT JOIN tbl_teacheradvisory ta ON sg.classid = ta.teacheradvisory_id 
                LEFT JOIN tbl_teacher t ON sg.adviserid = t.teacher_id 
                LEFT JOIN tbl_class c ON sg.classid = c.class_id 
                LEFT JOIN tbl_schoolyear sy ON sg.schoolyearid = sy.id 
                LEFT JOIN tbl_subject sb on sg.subjectid = sb.subject_id WHERE sg.status='active'
                AND sg.adviserid=$userid";
                
                $result = $this->runBaseSql($sql);
                $counter = 0;

                if (is_array($result) || is_object($result)) { 
                    foreach($result as $value) {
                        $counter++;
                    }
                }

                $response = json_encode(array(
                    "message" => $counter,
                    "status"  => "success"
                ));
                
            } catch(Exception $e) {
                $response = json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status"  => "error"
                ));
            }
            echo $response;
        }

        public function widgetAttendaceLog() {
            try {
                $userid = $this->userid;

                $sql = "SELECT COUNT(*) FROM tbl_logs WHERE id_num = $userid";                
                $result = $this->runBaseSql($sql);

                $response = json_encode(array(
                    "message" => $result[0]['COUNT(*)'],
                    "status"  => "success"
                ));
                
            } catch(Exception $e) {
                $response = json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status"  => "error"
                ));
            }
            echo $response;
        }

        public function getAllStudent() {
            try {
                $arr = array();
                if(!empty($this->checkUserId())
                ) {
                    $sql = "SELECT * FROM tbl_teacheradvisory WHERE teacherid=".$this->userid;

                    if($result = $this->runBaseSql($sql)
                    ){
                        if (is_array($result) || is_object($result)
                        ) { 
                            foreach ($result as $row) {
                                $classId = $row['classid'];
                    
                                $sql = "SELECT * FROM tbl_student s 
                                LEFT JOIN tbl_studentclass sc ON sc.studentid = s.student_id
                                LEFT JOIN tbl_subject sb ON sc.subjectid = sb.subject_id
                                LEFT JOIN tbl_class c ON sc.classid = c.class_id 
                                LEFT JOIN tbl_gradelevel y ON c.level_id = y.level_id
                                WHERE s.status='active'
                                AND sc.status='active'
                                AND sb.status='active'
                                AND c.status='active'
                                AND y.status='active'
                                AND c.class_id = $classId ORDER BY s.student_id DESC";

                                if($result = $this->runBaseSql($sql)
                                ) {
                                    $arr[] = $result;
                                }
                            }
                        }
                    }
                }

                if(count($arr) == 0) {
                    echo json_encode(array(
                        "message" => true,
                        "status"  => "success"
                    ));
                    die();
                }

                echo json_encode(array(
                    "message" => $arr,
                    "status"  => "success"
                ));
                    
            } catch(Exception $e) {
                echo json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status"  => "error"
                ));
            }
        }

        public function SeachStudentList($key) {
            try { 
                if(!empty($this->checkUserId())
                ) {
                    $newkey = $this->cleanStr($key);
                    $arr = array();

                    $sql = "SELECT * FROM tbl_teacheradvisory WHERE teacherid=".$this->userid;

                    if($result = $this->runBaseSql($sql)
                    ){
                        if (is_array($result) || is_object($result)
                        ) { 
                            foreach ($result as $row) {
                                $classId = $row['classid'];
                
                                $sql = "SELECT * FROM tbl_student s 
                                LEFT JOIN tbl_studentclass sc ON sc.studentid = s.student_id
                                LEFT JOIN tbl_subject sb ON sc.subjectid = sb.subject_id
                                LEFT JOIN tbl_class c ON sc.classid = c.class_id 
                                LEFT JOIN tbl_gradelevel y ON c.level_id = y.level_id
                                WHERE c.class_id = $classId 
                                AND s.status='active'
                                AND sc.status='active'
                                AND sb.status='active' 
                                AND c.status='active'
                                AND y.status='active'
                                AND CONCAT(
                                    student_id,
                                    fname,
                                    mname,
                                    lname,
                                    classname,
                                    grade_level,
                                    discription
                                ) LIKE '%$newkey%'";

                            if($result = $this->runBaseSql($sql)
                            ) {
                                $arr[] = $result;
                            }
                        }
                    }
                }

                echo json_encode(array(
                    "message" => $arr,
                    "status"  => "success"
                ));
                die();
            }

            echo json_encode(array(
                "message" => true,
                "status"  => "success"
            ));

            } catch(Exception $e) {
                echo json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status"  => "error"
                ));
            }
        }

        public function printAllStudentList() {
            try {
                if(!empty($this->checkUserId())
                ) {
                    $arr = array();
                    $sql = "SELECT * FROM tbl_teacheradvisory WHERE teacherid=".$this->userid;

                    if($result = $this->runBaseSql($sql)
                    ){
                        if (is_array($result) || is_object($result)
                        ) { 
                            foreach ($result as $row) {
                                $classId = $row['classid'];
                                
                                $sql = "SELECT * FROM tbl_student s 
                                LEFT JOIN tbl_studentclass sc ON sc.studentid = s.student_id
                                LEFT JOIN tbl_subject sb ON sc.subjectid = sb.subject_id
                                LEFT JOIN tbl_class c ON sc.classid = c.class_id 
                                LEFT JOIN tbl_gradelevel y ON c.level_id = y.level_id
                                WHERE c.class_id = $classId
                                AND s.status='active'
                                AND sc.status='active'
                                AND sb.status='active' 
                                AND c.status='active'
                                AND y.status='active'
                                ORDER BY s.student_id DESC";
                
                                if($result = $this->runBaseSql($sql)
                                ){
                                    $arr[]=$result;
                                }
                            }
                        }
                    }

                    return $arr;
    
                    die();
                }

            } catch(Exception $e) {
                echo json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status"  => "error"
                ));
            }
        }

        public function sortStudentList($number) {
            try {
                if(!empty($this->checkUserId())
                ) {
                    $arr = array();
                    $sql = "SELECT * FROM tbl_teacheradvisory WHERE teacherid=".$this->userid;

                    if($result = $this->runBaseSql($sql)
                    ){
                        if (is_array($result) || is_object($result)
                        ) { 
                            foreach ($result as $row) {
                                $classId = $row['classid'];

                                $sql = "SELECT * FROM tbl_student s 
                                LEFT JOIN tbl_studentclass sc ON sc.studentid = s.student_id
                                LEFT JOIN tbl_subject sb ON sc.subjectid = sb.subject_id
                                LEFT JOIN tbl_class c ON sc.classid = c.class_id 
                                LEFT JOIN tbl_gradelevel y ON c.level_id = y.level_id
                                WHERE c.class_id = $classId
                                AND s.status='active'
                                AND sc.status='active'
                                AND sb.status='active' 
                                AND c.status='active'
                                AND y.status='active'
                                ORDER BY s.student_id DESC LIMIT ".$number;
                                    
                                if($result = $this->runBaseSql($sql)
                                ) {
                                    $arr[]=$result;
                                }
                            }
                        }
                    }
    
                    echo json_encode(array(
                        "message" => $arr,
                        "status"  => "success"
                    ));
                    die();
                } 

                echo json_encode(array(
                    "message" => true,
                    "status"  => "success"
                ));

            } catch(Exception $e) {
                echo json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status"  => "error"
                ));
            }
        }

        public function paginateStudentList($pagenum) {
            $num_per_page = 05;
            $start_from   = ($this->cleanStr($pagenum-1))*05;
    
            try {
                if(!empty($this->checkUserId())
                ) {
                    $arr = array();
                    $sql = "SELECT * FROM tbl_teacheradvisory WHERE teacherid=".$this->userid;

                    if($result = $this->runBaseSql($sql)
                    ){
                        if (is_array($result) || is_object($result)
                        ) { 
                            foreach ($result as $row) {
                                $classId = $row['classid'];

                                $sql = "SELECT * FROM tbl_student s 
                                LEFT JOIN tbl_studentclass sc ON sc.studentid = s.student_id
                                LEFT JOIN tbl_subject sb ON sc.subjectid = sb.subject_id
                                LEFT JOIN tbl_class c ON sc.classid = c.class_id 
                                LEFT JOIN tbl_gradelevel y ON c.level_id = y.level_id
                                WHERE c.class_id = $classId
                                AND s.status='active'
                                AND sc.status='active'
                                AND sb.status='active' 
                                AND c.status='active'
                                AND y.status='active'
                                ORDER BY s.student_id DESC LIMIT $start_from, $num_per_page";

                                if($result = $this->runBaseSql($sql)
                                ) {
                                    $arr[]=$result;
                                }
                            }
                        }
                    }
    
                    echo json_encode(array(
                        "message" => $arr,
                        "status"  => "success"
                    ));
                    die();
                } 

                echo json_encode(array(
                    "message" => true,
                    "status"  => "success"
                ));
                
            } catch(Exception $e) {
                echo json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status"  => "error"
                ));
            }
        }

        public function optionSortStudentList($classId, $YearId) {
            try {
                if(!empty($this->checkUserId())
                ) {
                    $arr = array();
                    $sql = "SELECT * FROM tbl_student s 
                    LEFT JOIN tbl_studentclass sc ON sc.studentid = s.student_id
                    LEFT JOIN tbl_subject sb ON sc.subjectid = sb.subject_id
                    LEFT JOIN tbl_class c ON sc.classid = c.class_id 
                    LEFT JOIN tbl_gradelevel y ON c.level_id = y.level_id
                    WHERE s.status='active'
                    AND sc.status='active'
                    AND sb.status='active'
                    AND c.status='active'
                    AND y.status='active'
                    AND y.status='active'
                    AND y.level_id = $YearId
                    AND c.class_id = $classId ORDER BY s.student_id DESC";

                    if($result = $this->runBaseSql($sql)
                    ) {
                        $arr[] = $result;
                    }
        
                    echo json_encode(array(
                        "message" => $arr,
                        "status"  => "success"
                    ));
                    die();
                } 

            } catch(Exception $e) {
                echo json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status"  => "error"
                ));
            }
        } 

        public function viewAttendanceLogs() {
            try { 
                $newkey = $this->userid;
       
                $sql = "SELECT * FROM tbl_logs WHERE type='Teacher' AND id_num = $newkey  LIMIT 5";
    
                if($result = $this->runBaseSql($sql)
                ) {
                    $response = json_encode(array(
                        "message" => $result,
                        "status"  => "success"
                    )); 
                } 
    
            } catch(Exception $e) {
                $response = json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status"  => "error"
                ));
            }
            echo $response;
        }

        public function trackDateAttendaceLogs($date) {
            $newkey = $this->cleanStr($this->userid);
            $datefrom = $date['datefrom'];
            $dateto   = $date['dateto'];
            
            try {
    
                $sql = "SELECT * FROM `tbl_logs` WHERE id_num=$newkey AND `created_date` BETWEEN '$datefrom' AND '$dateto'"; 
    
                $result = $this->runBaseSql($sql);
    
                $response = json_encode(array(
                    "message" => $result,
                    "status"  => "success"
                ));
    
            } catch(Exception $e) {
                $response = json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status"  => "error"
                ));
            }
            echo $response;
        }

        public function printAllAttendanceLogs() {
            try { 
                $userid = $this->cleanStr($this->userid);
       
                $sql = "SELECT * FROM tbl_logs WHERE id_num = $userid LIMIT 5";
    
                if($result = $this->runBaseSql($sql)) {
                    return $result; 
                } 
    
            } catch(Exception $e) {
                echo json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status"  => "error"
                ));
            }
        }

        public function sortAttendanceLogs($number) {
            try {

                $userid = $this->cleanStr($this->userid);
       
                $sql = "SELECT * FROM tbl_logs WHERE id_num = $userid LIMIT " . $this->cleanStr($number);
                                
                if($result = $this->runBaseSql($sql)
                ){
                    $response = json_encode(array(
                        "message" => $result,
                        "status"  => "success"
                    ));
                }
    
            } catch(Exception $e) {
                $response = json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status" => "error"
                ));
            }
            echo $response;
        }

        public function totalPagesAttendanceLogs() {
            try {
                $userid = $this->cleanStr($this->userid);
                $counter = 0;
       
                $sql = "SELECT * FROM tbl_logs WHERE id_num = $userid ORDER BY id_num DESC";
    
                if($result = $this->runBaseSql($sql)) {
                    if (is_array($result) || is_object($result)) { 
                        foreach($result as $value) {
                            $counter++;
                        }
                    }
                    
                    $response = json_encode(array(
                        "message" => $counter,
                        "status" => "success"
                    ));
                } 

            } catch(Exception $e) {
                $response = json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status" => "error"
                ));
            }
            echo $response;
        }

        public function paginateAttendanceLogs($pagenum) {
            $num_per_page = 05;
            $start_from   = ($this->cleanStr($pagenum-1))*05;
            $userid = $this->cleanStr($this->userid);
    
            try {
                $sql = "SELECT * FROM tbl_logs WHERE id_num = $userid ORDER BY id_num DESC LIMIT $start_from, $num_per_page";  

                if($result = $this->runBaseSql($sql)
                ){
                    $response = json_encode(array(
                        "message" => $result,
                        "status"  => "success"
                    ));
                }
                
            } catch(Exception $e) {
                $response = json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status"  => "error"
                ));
            }
            echo $response;
        }

        public function getAllStudentGrades() {
            try {
                $userid = $this->cleanStr($this->userid);

                $sql = "SELECT *,sg.grade_id as sgid, 
                CONCAT(t.lname, ', ', t.fname, ' ', t.mname) as tname,
                CONCAT(s.lname, ', ', s.fname, ' ', s.mname) as sname FROM tbl_grades sg 
                LEFT JOIN tbl_studentclass sc ON sg.classid = sc.classid 
                AND sg.studentid = sc.studentid AND sg.subjectid = sc.subjectid 
                LEFT JOIN tbl_student s ON sg.studentid = s.student_id 
                LEFT JOIN tbl_teacheradvisory ta ON sg.classid = ta.teacheradvisory_id 
                LEFT JOIN tbl_teacher t ON sg.adviserid = t.teacher_id 
                LEFT JOIN tbl_class c ON sg.classid = c.class_id 
                LEFT JOIN tbl_schoolyear sy ON sg.schoolyearid = sy.id 
                LEFT JOIN tbl_subject sb on sg.subjectid = sb.subject_id WHERE sg.status='active' 
                AND sg.adviserid = $userid";

                if($result = $this->runBaseSql($sql)
                ){
                    $response = json_encode(array(
                        "message" => $result,
                        "status"  => "success"
                    )); 
                }
                
            } catch(Exception $e) {
                $response = json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status"  => "error"
                ));
            }
            echo $response;
        }

        public function filterOptionGrades($data) {

            try {
                $userid = $this->cleanStr($this->userid);
                $cid   = intval($data['clsid']);
                $yrid  = intval($data['yrid']);
                $subid = intval($data['subid']);

                $sql = "SELECT *,sg.grade_id as sgid, 
                CONCAT(t.lname, ', ', t.fname, ' ', t.mname) as tname,
                CONCAT(s.lname, ', ', s.fname, ' ', s.mname) as sname FROM tbl_grades sg 
                LEFT JOIN tbl_studentclass sc ON sg.classid = sc.classid 
                AND sg.studentid = sc.studentid AND sg.subjectid = sc.subjectid 
                LEFT JOIN tbl_student s ON sg.studentid = s.student_id 
                LEFT JOIN tbl_teacheradvisory ta ON sg.classid = ta.teacheradvisory_id 
                LEFT JOIN tbl_teacher t ON sg.adviserid = t.teacher_id 
                LEFT JOIN tbl_class c ON sg.classid = c.class_id 
                LEFT JOIN tbl_schoolyear sy ON sg.schoolyearid = sy.id 
                LEFT JOIN tbl_subject sb on sg.subjectid = sb.subject_id WHERE sg.status='active'
                AND sg.classid = $cid
                AND sg.schoolyearid = $yrid
                AND sg.subjectid = $subid
                AND sg.adviserid = $userid ORDER BY sg.grade_id DESC";

                if($result = $this->runBaseSql($sql)
                ){
                    $response = json_encode(array(
                        "message" => $result,
                        "status"  => "success"
                    )); 
                }
                
            } catch(Exception $e) {
                $response = json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status"  => "error"
                ));
            }
            echo $response;
        }

        public function getValueClass($yrid) {
            try {
                $sql = "SELECT * FROM tbl_class WHERE schoolyear_id=".$yrid;

                if($result = $this->runBaseSql($sql)
                ){
                    $response = json_encode(array(
                        "message" => $result,
                        "status"  => "success"
                    )); 
                }
                
            } catch(Exception $e) {
                $response = json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status"  => "error"
                ));
            }
            echo $response;
        }

        public function getValueStudent($cid) {
            try {
                $userid = $this->userid;

                $sql = "SELECT *,s.student_id as studID from tbl_studentclass sc 
                left join tbl_student s on sc.studentid = s.student_id where sc.classid=:classid";
    
                $paramType = ":placeholder";
                $paramValue = array(
                    "classid" => $cid, 
                );

                if($this->runSql($sql, $paramType, $paramValue)
                ){
                    $sql = "SELECT * FROM `tbl_teacheradvisory` WHERE teacherid=:teacherid LIMIT 1";

                    $paramType = ":placeholder";
                    $paramValue = array(
                        "teacherid" => $userid, 
                    );
                    
                    if($this->runSql($sql, $paramType, $paramValue)
                    ) {

                        $sql = "SELECT *,s.student_id as studID from tbl_studentclass sc 
                        left join tbl_student s on sc.studentid = s.student_id
                        GROUP BY student_id, student_id";
            
                        if($result = $this->runBaseSql($sql)
                        ) {
                            echo json_encode(array(
                                "message" => $result,
                                "status"  => "success"
                            )); 
                            die();
                        } 
                    }
                }

                echo json_encode(array(
                    "message" => true,
                    "status"  => "success"
                )); 
                die();
                
            } catch(Exception $e) {
                echo json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status"  => "error"
                ));
            }
        }

        public function getValueSubject($subid) {
            try {

                $sql = "SELECT *,s.subject_id as subjID from tbl_studentclass sc 
                left join tbl_subject s on sc.subjectid = s.subject_id
                WHERE sc.studentid = :studentid";

                $paramType = ":placeholder";
                $paramValue = array(
                    "studentid" => $subid, 
                );

                if($this->runSql($sql, $paramType, $paramValue)
                ){

                    $sql = "SELECT *,s.subject_id as subjID from tbl_studentclass sc 
                    left join tbl_subject s on sc.subjectid = s.subject_id
                    GROUP BY s.subject_id, s.subject_id";
        
                    if($result = $this->runBaseSql($sql)
                    ){
                        echo json_encode(array(
                            "message" => $result,
                            "status"  => "success"
                        ));
                        die();
                    } 
                }

                echo json_encode(array(
                    "message" => true,
                    "status"  => "success"
                )); 
                die();
                
            } catch(Exception $e) {
                echo json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status"  => "error"
                ));
            }
        }

        public function insertStudentGrades($data) {
            $yearid     = $data[0];
            $classid    = $data[1];
            $stundentid = $data[2];
            $subjectid  = $data[3];
            $firstQ  = $data[4];
            $secondQ = $data[5];
            $thirdQ  = $data[6];
            $fourtQ  = $data[7];

            try {
                if($firstQ  != 0  && $secondQ != 0 && $thirdQ  != 0 && $fourtQ  != 0
                ){
                    $result = (($firstQ + $secondQ + $thirdQ + $fourtQ) / 4);
                    $average = round($result);
        
                    if($average >= 75) {
                        $remarks = "PASSED";
                    } else {
                        $remarks = "FAILED";
                    }
        
                } else {
                    $result = (($firstQ + $secondQ + $thirdQ + $fourtQ) / 4) ;
                    $average = round($result);
                    $remarks = "No Final Remarks";
                }

                $sql = "SELECT * FROM `tbl_grades` WHERE `studentid`=:studentid AND `schoolyearid`=:schoolyearid AND `subjectid`=:subjectid AND `classid`=:classid";

                $paramType = ":placeholder";
                $paramValue = array(
                    "studentid"   => $stundentid, 
                    "schoolyearid"=> $yearid, 
                    "subjectid"   => $subjectid,
                    "classid"     => $classid 
                );
                
                if(!$this->runSql($sql, $paramType, $paramValue)
                ){

                    $sql = "INSERT INTO `tbl_grades`(`studentid`, `schoolyearid`, `subjectid`, `classid`, `adviserid`, `firstquarter`, `secondquarter`, `thirthquarter`, `fourthquarter`, `gradeaverage`, `remarks`)
                    VALUES (:studentid, :schoolyearid, :subjectid, :classid, :adviserid, :firstquarter, :secondquarter, :thirthquarter, :fourthquarter, :gradeaverage, :remarks)";
                    $paramType = ":placeholder";

                    $paramValue = array(
                        "studentid"     => $stundentid, 
                        "schoolyearid"  => $yearid, 
                        "subjectid"     => $subjectid,
                        "classid"       => $classid,
                        "adviserid"     => $this->userid,
                        "firstquarter"  => $firstQ,
                        "secondquarter" => $secondQ,
                        "thirthquarter" => $thirdQ,
                        "fourthquarter" => $fourtQ,
                        "gradeaverage"  => $average,
                        "remarks"       => $remarks
                    );

                    if($this->insert($sql, $paramType, $paramValue)) {
                        echo json_encode(array(
                            "message" => "Successfully Insert Student Grades",
                            "status"  => "success"
                        ));
                        die();
                    } 
                } else {
                    echo json_encode(array(
                        "message" => "Student Grade Already Exist",
                        "status"  => "error"
                    ));
                    die();
                }
            
            } catch(Exception $e) {
                echo json_encode(array(
                    "message" => "Error :" .$e->getMessage(),
                    "status"  => "error"
                ));
            }
        }

        public function updateStudentGrades($data) {
            try {

                if($data[1] != 0 && $data[2] != 0 && $data[3] != 0 && $data[4] != 0
                ){
                    $result = (( $data[1]+ $data[2]+ $data[3] + $data[4] ) / 4) ;
                    $average = round($result);
        
                    if($average >= 75) {
                        $remarks = "PASSED";
                    } else {
                        $remarks = "FAILED";
                    }
        
                } else {
                    $result  = (($data[1]+$data[2]+$data[3]+$data[4]) / 4) ;
                    $average = round($result);
                    $remarks = "No Final Remarks";
                }

                $sql = "UPDATE `tbl_grades` SET `firstquarter`=:firstquarter, `secondquarter`=:secondquarter, `thirthquarter`=:thirthquarter, `fourthquarter`=:fourthquarter, `gradeaverage`=:gradeaverage, `remarks`=:remarks WHERE `grade_id`=:grade_id";

                $paramType = ":placeholder";
                $paramValue = array(
                    "grade_id"       => $data[0],
                    "firstquarter"   => $data[1],
                    "secondquarter"  => $data[2],
                    "thirthquarter"  => $data[3],
                    "fourthquarter"  => $data[4],
                    "gradeaverage"   => $average,
                    "remarks"        => $remarks,
                );
    
                if($this->update($sql, $paramType, $paramValue)){
                    echo json_encode(array(
                        "message" => "Successfully Update Student Grade",
                        "status" => "success"
                    ));
                }
    
            } catch(Exception $e) {
                echo json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status" => "error"
                ));
            }
        }

        public function removeStudentGrades($data) {
            try {
                foreach($data as $value) {
    
                    $sql="UPDATE tbl_grades SET status='unactive' WHERE grade_id =:grade_id ";
                    $paramType = ":placeholder";
                    $paramValue = array(
                        "grade_id" => $value,
                    );
                    $this->update($sql, $paramType, $paramValue);
                }
                    
                $reponse = json_encode(array(
                    "message" => "Successfully set Inactive Student Grade",
                    "status"  => "success"
                ));
                
            } catch(Exception $e) {
                $reponse = json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status" => "error"
                ));
            }
            echo $reponse;
        }

        public function sortStudentGrades($number) {
            try {
                $userid = $this->cleanStr($this->userid);

                $sql = "SELECT *,sg.grade_id as sgid, 
                CONCAT(t.lname, ', ', t.fname, ' ', t.mname) as tname,
                CONCAT(s.lname, ', ', s.fname, ' ', s.mname) as sname FROM tbl_grades sg 
                LEFT JOIN tbl_studentclass sc ON sg.classid = sc.classid 
                AND sg.studentid = sc.studentid AND sg.subjectid = sc.subjectid 
                LEFT JOIN tbl_student s ON sg.studentid = s.student_id 
                LEFT JOIN tbl_teacheradvisory ta ON sg.classid = ta.teacheradvisory_id 
                LEFT JOIN tbl_teacher t ON sg.adviserid = t.teacher_id 
                LEFT JOIN tbl_class c ON sg.classid = c.class_id 
                LEFT JOIN tbl_schoolyear sy ON sg.schoolyearid = sy.id 
                LEFT JOIN tbl_subject sb on sg.subjectid = sb.subject_id WHERE sg.status='active' 
                AND sg.adviserid = $userid ORDER BY sg.grade_id DESC 
                LIMIT " . $this->cleanStr($number);
                                
                if($result = $this->runBaseSql($sql)
                ){
                    $response = json_encode(array(
                        "message" => $result,
                        "status"  => "success"
                    ));
                }
    
            } catch(Exception $e) {
                $response = json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status" => "error"
                ));
            }
            echo $response;
        }

        public function paginateStudentGrades($pagenum) {
            $num_per_page = 05;
            $start_from   = ($this->cleanStr($pagenum-1))*05;
    
            try {
                $userid = $this->cleanStr($this->userid);

                $sql = "SELECT *,sg.grade_id as sgid, 
                CONCAT(t.lname, ', ', t.fname, ' ', t.mname) as tname,
                CONCAT(s.lname, ', ', s.fname, ' ', s.mname) as sname FROM tbl_grades sg 
                LEFT JOIN tbl_studentclass sc ON sg.classid = sc.classid 
                AND sg.studentid = sc.studentid AND sg.subjectid = sc.subjectid 
                LEFT JOIN tbl_student s ON sg.studentid = s.student_id 
                LEFT JOIN tbl_teacheradvisory ta ON sg.classid = ta.teacheradvisory_id 
                LEFT JOIN tbl_teacher t ON sg.adviserid = t.teacher_id 
                LEFT JOIN tbl_class c ON sg.classid = c.class_id 
                LEFT JOIN tbl_schoolyear sy ON sg.schoolyearid = sy.id 
                LEFT JOIN tbl_subject sb on sg.subjectid = sb.subject_id WHERE sg.status='active' 
                AND sg.adviserid = $userid ORDER BY sg.grade_id DESC 
                LIMIT $start_from, $num_per_page";  

                if($result = $this->runBaseSql($sql)
                ){
                    $response = json_encode(array(
                        "message" => $result,
                        "status"  => "success"
                    ));
                }
                
            } catch(Exception $e) {
                $response = json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status"  => "error"
                ));
            }
            echo $response;
        }
        
        public function uploadCsvFile($data) {

            $yearid     = $data[6];
            $classid    = $data[8];
            $stundentid = $data[0];
            $subjectid  = $data[7];
            $firstQ  = $data[2];
            $secondQ = $data[3];
            $thirdQ  = $data[4];
            $fourtQ  = $data[5];

            try {
                if($firstQ  != 0  && $secondQ != 0 && $thirdQ  != 0 && $fourtQ  != 0
                ){
                    $result = (($firstQ + $secondQ + $thirdQ + $fourtQ) / 4);
                    $average = round($result);
        
                    if($average >= 75) {
                        $remarks = "PASSED";
                    } else {
                        $remarks = "FAILED";
                    }
        
                } else {
                    $result = (($firstQ + $secondQ + $thirdQ + $fourtQ) / 4) ;
                    $average = round($result);
                    $remarks = "No Final Remarks";
                }

                $sql = "SELECT * FROM `tbl_grades` WHERE `studentid`=:studentid AND `schoolyearid`=:schoolyearid AND `subjectid`=:subjectid AND `classid`=:classid";

                $paramType = ":placeholder";
                $paramValue = array(
                    "studentid"   => $stundentid, 
                    "schoolyearid"=> $yearid, 
                    "subjectid"   => $subjectid,
                    "classid"     => $classid 
                );
                
                if(!$this->runSql($sql, $paramType, $paramValue)
                ){

                    $sql = "INSERT INTO `tbl_grades`(`studentid`, `schoolyearid`, `subjectid`, `classid`, `adviserid`, `firstquarter`, `secondquarter`, `thirthquarter`, `fourthquarter`, `gradeaverage`, `remarks`)
                    VALUES (:studentid, :schoolyearid, :subjectid, :classid, :adviserid, :firstquarter, :secondquarter, :thirthquarter, :fourthquarter, :gradeaverage, :remarks)";
                    $paramType = ":placeholder";

                    $paramValue = array(
                        "studentid"     => $stundentid, 
                        "schoolyearid"  => $yearid, 
                        "subjectid"     => $subjectid,
                        "classid"       => $classid,
                        "adviserid"     => $this->userid,
                        "firstquarter"  => $firstQ,
                        "secondquarter" => $secondQ,
                        "thirthquarter" => $thirdQ,
                        "fourthquarter" => $fourtQ,
                        "gradeaverage"  => $average,
                        "remarks"       => $remarks
                    );

                    if($this->insert($sql, $paramType, $paramValue)) {
                        echo json_encode(array(
                            "message" => "Successfully Upload Student Grade",
                            "status"  => "success"
                        ));
                    } 
                } else {
                    echo json_encode(array(
                        "message" => "Already Exist",
                        "status"  => "error"
                    ));
                    die();
                } 
            
            } catch(Exception $e) {
                echo json_encode(array(
                    "message" => $e->getMessage(),
                    "status"  => "error"
                ));
            }
        }

        public function getAllUnactStudentGrades() {
            try {
                $userid = $this->cleanStr($this->userid);

                $sql = "SELECT *,sg.grade_id as sgid, 
                    CONCAT(t.lname, ', ', t.fname, ' ', t.mname) as tname,
                    CONCAT(s.lname, ', ', s.fname, ' ', s.mname) as sname FROM tbl_grades sg 
                    LEFT JOIN tbl_studentclass sc ON sg.classid = sc.classid 
                    AND sg.studentid = sc.studentid AND sg.subjectid = sc.subjectid 
                    LEFT JOIN tbl_student s ON sg.studentid = s.student_id 
                    LEFT JOIN tbl_teacheradvisory ta ON sg.classid = ta.teacheradvisory_id 
                    LEFT JOIN tbl_teacher t ON sg.adviserid = t.teacher_id 
                    LEFT JOIN tbl_class c ON sg.classid = c.class_id 
                    LEFT JOIN tbl_schoolyear sy ON sg.schoolyearid = sy.id 
                    LEFT JOIN tbl_subject sb on sg.subjectid = sb.subject_id WHERE sg.status='unactive' 
                    AND sg.adviserid = $userid
                ";

                if($result = $this->runBaseSql($sql)
                ){
                    $response = json_encode(array(
                        "message" => $result,
                        "status"  => "success"
                    )); 
                }
                
            } catch(Exception $e) {
                $response = json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status"  => "error"
                ));
            }
            echo $response;
        }

        public function filterOptionUnactGrades($data) {

            try {
                $userid = $this->cleanStr($this->userid);
                $cid   = intval($data['clsidUnact']);
                $yrid  = intval($data['yridUnact']);
                $subid = intval($data['subidUnact']);

                $sql = "SELECT *,sg.grade_id as sgid, 
                CONCAT(t.lname, ', ', t.fname, ' ', t.mname) as tname,
                CONCAT(s.lname, ', ', s.fname, ' ', s.mname) as sname FROM tbl_grades sg 
                LEFT JOIN tbl_studentclass sc ON sg.classid = sc.classid 
                AND sg.studentid = sc.studentid AND sg.subjectid = sc.subjectid 
                LEFT JOIN tbl_student s ON sg.studentid = s.student_id 
                LEFT JOIN tbl_teacheradvisory ta ON sg.classid = ta.teacheradvisory_id 
                LEFT JOIN tbl_teacher t ON sg.adviserid = t.teacher_id 
                LEFT JOIN tbl_class c ON sg.classid = c.class_id 
                LEFT JOIN tbl_schoolyear sy ON sg.schoolyearid = sy.id 
                LEFT JOIN tbl_subject sb on sg.subjectid = sb.subject_id WHERE sg.status='unactive'
                AND sg.classid = $cid
                AND sg.schoolyearid = $yrid
                AND sg.subjectid = $subid
                AND sg.adviserid = $userid ORDER BY sg.grade_id DESC";

                if($result = $this->runBaseSql($sql)
                ){
                    $response = json_encode(array(
                        "message" => $result,
                        "status"  => "success"
                    )); 
                }
                
            } catch(Exception $e) {
                $response = json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status"  => "error"
                ));
            }
            echo $response;
        }

        public function removeUnactiveStudentGrades($data) {
            try {
                foreach($data as $value) {
    
                    $sql="UPDATE tbl_grades SET status='active' WHERE grade_id =:grade_id ";
                    $paramType = ":placeholder";
                    $paramValue = array(
                        "grade_id" => $value,
                    );
                    $this->update($sql, $paramType, $paramValue);
                }
                    
                $reponse = json_encode(array(
                    "message" => "Successfully set Active Student Grade",
                    "status"  => "success"
                ));
                
            } catch(Exception $e) {
                $reponse = json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status" => "error"
                ));
            }
            echo $reponse;
        }

        public function printStudentRecords($data) {
            try {
                $userid = $this->cleanStr($this->userid);
                $cid   = intval($data['clsidPrint']);
                $subid = intval($data['subid']);
                $yrid  = intval($data['yridPrint']);
    
                $sql = "SELECT *,sg.grade_id as sgid, 
                CONCAT(t.lname, ', ', t.fname, ' ', t.mname) as tname,
                CONCAT(s.lname, ', ', s.fname, ' ', s.mname) as sname FROM tbl_grades sg 
                LEFT JOIN tbl_studentclass sc ON sg.classid = sc.classid 
                AND sg.studentid = sc.studentid AND sg.subjectid = sc.subjectid 
                LEFT JOIN tbl_student s ON sg.studentid = s.student_id 
                LEFT JOIN tbl_teacheradvisory ta ON sg.classid = ta.teacheradvisory_id 
                LEFT JOIN tbl_teacher t ON sg.adviserid = t.teacher_id 
                LEFT JOIN tbl_class c ON sg.classid = c.class_id 
                LEFT JOIN tbl_schoolyear sy ON sg.schoolyearid = sy.id 
                LEFT JOIN tbl_subject sb on sg.subjectid = sb.subject_id WHERE sg.status='active'
                AND sg.subjectid = $subid
                AND sg.classid   = $cid
                AND sg.schoolyearid = $yrid
                AND sg.adviserid = $userid ORDER BY sg.grade_id DESC";
    
                if($result = $this->runBaseSql($sql)
                ){
                    if (is_array($result) || is_object($result)
                    ) {
                        foreach($result as $value) {
                            $sql = "SELECT * FROM tbl_gradelevel WHERE level_id =:level_id LIMIT 1";
                            $paramType = ":placeholder";
                            $paramValue = array(
                                "level_id" => $value['level_id']
                            );
                        }

                        if($level = $this->runSql($sql, $paramType, $paramValue)
                        ) {
                            unset($_SESSION['printRecords']);
                            unset($_SESSION['gradeLevel']);
                            unset($_SESSION['section']);
                            unset($_SESSION['section']);

                            $_SESSION['printRecords'] = $result;
                            $_SESSION['gradeLevel']   = $level['grade_level'];
                            $_SESSION['section'] = $level['discription'];

                            echo json_encode(array(
                                "level"   => $level['grade_level'],
                                "section" => $level['discription'],
                                "message" => $result, 
                                "status"  => "success"
                            )); 
                        }
                    } else {
                        echo json_encode(array(
                            "message" => true, 
                            "status"  => "success"
                        )); 
                    }    
                }
                
            } catch(Exception $e) {
                echo json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status"  => "error"
                ));
            }
        }

        public function unsetPrint(){
            unset($_SESSION['printRecords']);
            unset($_SESSION['gradeLevel']);
            unset($_SESSION['section']);
            unset($_SESSION['section']);

            echo json_encode(array(
                "status" => "success"
            ));
        }

        public function cleanStr($string){
            $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
            $string = preg_replace('/-+/', '-', $string);
            
            return $string;
        } 
    }
?>