<?php 

class CheckLogs extends Controller {

    public function setStudent($codeType, $userType) {
        try { 
            $sql = "SELECT * FROM tbl_student WHERE status='active' AND id_pass=:id_pass LIMIT 1";
            $paramType = ":placeholder";
            $paramValue = array(
                "id_pass" => $codeType
            );
            
            if(!$row = $this->runSql($sql, $paramType, $paramValue)
            ) {
                echo json_encode(array(
                    "message" => "Qrcode ".$userType." Not Found!...",
                    "status"  => "error"
                ));
                die();
            } else {
                $result = $this->getAllIdNumLogs();
                $logType = 0;

                if (is_array($result) || is_object($result)
                ) { 
                    foreach($result as $val) {
                        if($val['id_num'] == $row['student_id']) {
                            $logType = ($val['log_type'] == 1) ? 2 : 1;
                        }else{
                            $logType = 1;
                        }
                    }
                }
                $this->AddLogs(  
                    $userType, 
                    $row['student_id'], 
                    ($logType == 0) ? 1 : $logType, 
                    $row['fname'],
                    $row['mname'],
                    $row['lname'],
                    $row['avatar']
                );
            }

        } catch(Exception $e) {
            echo json_encode(array(
                "message" => "Error: " . $e->getMessage(),
                "status"  => "error"
            ));
        }
    }

    public function setTeacher($codeType, $userType) {
        try {
            $sql = "SELECT * FROM tbl_teacher WHERE status='active' AND id_pass=:id_pass LIMIT 1";
            $paramType = ":placeholder";
            $paramValue = array(
                "id_pass" => $codeType, 
            );
            
            if(!$row = $this->runSql($sql, $paramType, $paramValue)
            ) {
                echo json_encode(array(
                    "message" => "Qrcode ".$userType." Not Found!...",
                    "status"  => "error"
                ));
                die();
            } else {
                $result = $this->getAllIdNumLogs();
                $logType = 0;

                if (is_array($result) || is_object($result)
                ) { 
                    foreach($result as $val) {
                        if($val['id_num'] == $row['teacher_id']) {
                            $logType = ($val['log_type'] == 1) ? 2 : 1;
                        }else{
                            $logType = 1;
                        }
                    }
                }
                $this->AddLogs(  
                    $userType, 
                    $row['teacher_id'], 
                    ($logType == 0) ? 1 : $logType, 
                    $row['fname'],
                    $row['mname'],
                    $row['lname'],
                    $row['avatar']
                );
            }

        } catch(Exception $e) {
            echo json_encode(array(
                "message" => "Error: " . $e->getMessage(),
                "status"  => "error"
            ));
        }
    }

    public function setVisitors($codeType, $userType) {
        try {
            
            $sql = "SELECT * FROM tbl_visitors WHERE status='active' AND id_pass=:id_pass LIMIT 1";
            $paramType = ":placeholder";
            $paramValue = array(
                "id_pass" => $codeType
            );
            
            if(!$row = $this->runSql($sql, $paramType, $paramValue)
            ) {
                echo json_encode(array(
                    "message" => "Hi Welcome ".$userType." Kindly Fillup Form",
                    "status"  => "option"
                ));
                die();
            } else {
                $result = $this->getAllIdNumLogs();
                $logType = 0;
                $defaultAvatar = '../assets/images/account.png';

                if (is_array($result) || is_object($result)
                ) { 
                    foreach($result as $val) {
                        if($val['id_num'] == $row['visitors_id']) {
                            $logType = ($val['log_type'] == 1) ? 2 : 1;
                        }else{
                            $logType = 1;
                        }
                    }
                }
                $this->AddLogs(  
                    $userType, 
                    $row['visitors_id'], 
                    ($logType == 0) ? 1 : $logType, 
                    $row['fname'],
                    $row['mname'],
                    $row['lname'],
                    $defaultAvatar
                );
            }

        } catch(Exception $e) {
            echo json_encode(array(
                "message" => "Error: " . $e->getMessage(),
                "status"  => "er ror"
            ));
        }
    }

    public function AddLogs($type, $idNum, $logtype, $fname, $mname, $lname, $avatar) {
        try {

            $sql = "INSERT INTO tbl_logs (type, id_num, log_type, fname, mname, lname, avatar)
                    VALUES(:type, :id_num, :log_type, :fname, :mname, :lname, :avatar)";
            $paramType = ":placeholder";
            $paramValue = array(
                "type"     => $type,
                "id_num"   => $idNum,
                "log_type" => $logtype,
                "fname"    => $fname,
                "mname"    => $mname,
                "lname"    => $lname,
                "avatar"   => $avatar,
            );

            $this->insert($sql, $paramType, $paramValue);

            switch($logtype) {
                case '1':
                    echo json_encode(array(
                        "fname"  => $fname,
                        "mname"  => $mname,
                        "lname"  => $lname,
                        "avatar"  => $avatar,
                        "message" => "Hi Welcome " . $type,
                        "status"  => "success"
                    ));
                break;
                case '2':
                    echo json_encode(array(
                        "fname"  => $fname,
                        "mname"  => $mname,
                        "lname"  => $lname,
                        "avatar" => $avatar,
                        "message" => "Thank you " . $type . " Come Again..",
                        "status"  => "success"
                    ));
                break;
            }
            
        } catch(Exception $e) {
            echo json_encode(array(
                "message" => "Error: " . $e->getMessage(),
                "status"  => "error"
            ));
        }
    }

    public function getAllIdNumLogs() {
        try {
            $sql = "SELECT * FROM tbl_logs WHERE id_num";                
            $result = $this->runBaseSql($sql);

            return $result;

        } catch(Exception $e) {
            echo json_encode(array(
                "message" => "Error: " . $e->getMessage(),
                "status"  => "error"
            ));
        }
    }

    public function cleanStr($string){

        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
        $string = preg_replace('/-+/', '-', $string);
        
        return $string;
    }
}
?>