<?php 
    class StudentGrades extends Controller {

        public function confirmStudent($studentPass) {
            try {
                $sql = "SELECT * FROM tbl_student WHERE id_pass=:id_pass LIMIT 1";
                $paramType = ":placeholder";
                $paramValue = array(
                    "id_pass" => $studentPass
                );

                if($result = $this->runSql($sql, $paramType, $paramValue)
                ) {
                    echo json_encode(array(
                        "message" => $result,
                        "status"  => "success"
                    ));
                    
                } else {
                    echo json_encode(array(
                        "message" => "Qrcode Not Found!",
                        "status"  => "error"
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

        public function getPinCode($credential) {

            try {
                $sql = "SELECT * FROM tbl_student WHERE pinCode=:pinCode AND id_pass=:id_pass LIMIT 1";
                $paramType = ":placeholder";
                $paramValue = array(
                    "pinCode" => $this->custom_hash($credential['pincode']),
                    "id_pass" => $credential['passcode']
                );

                if($result = $this->runSql($sql, $paramType, $paramValue)
                ) {
                    echo json_encode(array(
                        "message" => $result,
                        "status"  => "success"
                    ));
                    
                } else {
                    echo json_encode(array(
                        "message" => "Pin Code Not Found!",
                        "status"  => "error"
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

        public function validatePinCode($credential) {

            try {
                $arr = array();

                $sql = "SELECT * FROM tbl_student WHERE email=:email  AND id_pass=:id_pass LIMIT 1";
                $paramType = ":placeholder";
                $paramValue = array(
                    "email" => $credential['email'],
                    "id_pass" => $credential['passCodeForget']
                );

                if($result = $this->runSql($sql, $paramType, $paramValue)
                ) {
                    $pinCode = rand(1, 10000);

                    $arr[] = $pinCode;
                    $arr[] = $result['fname'];
                    $arr[] = $result['mname'];
                    $arr[] = $result['lname'];

                    $saltPinCode = $this->custom_hash($pinCode);
                    
                    $sql="UPDATE tbl_student SET pinCode=:pinCode";
                    $paramType = ":placeholder";
                    $paramValue = array(
                        "pinCode" => $saltPinCode,
                    );

                    if($this->update($sql, $paramType, $paramValue)
                    ){
                       return $arr;
                    }
                    
                } else {
                    echo json_encode(array(
                        "message" => "Email Cannot Recognize!",
                        "status"  => "error"
                    ));
                    die();
                }
            
            } catch(Exception $e) {
                echo json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status"  => "error"
                ));
                die();
            }
        }

        public function getThisStudentCode($studentPass) {
            try {
                $sql = "SELECT * FROM tbl_student WHERE id_pass=:id_pass LIMIT 1";
                $paramType = ":placeholder";
                $paramValue = array(
                    "id_pass" => $studentPass
                );

                if($result = $this->runSql($sql, $paramType, $paramValue)
                ) {
                    $this->getStudentGrades($studentPass, $result);
                    
                } else {
                    echo json_encode(array(
                        "message" => "Qrcode Not Found!",
                        "status"  => "error"
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

        public function getStudentGrades($studentPass, $studentName) {
            try { 
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
                    LEFT JOIN tbl_subject sb on sg.subjectid = sb.subject_id WHERE sg.status='active' AND s.id_pass='$studentPass' AND  year(sg.add_date) = year(now())
                ";
    
                if($result = $this->runBaseSql($sql)
                ) { 
                    $response = json_encode(array(
                        "message" => $result,
                        "fname"   => $studentName['fname'],
                        "mname"   => $studentName['mname'],
                        "lname"   => $studentName['lname'],
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
    }
?>