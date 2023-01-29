<?php
    class TemplateCsvFile extends Controller {

        public function getAllAddedTemplate($data) {
            $schoolYearId = $data['syid'];
            $SubjectId    = $data['subid'];
            $TeacherId    = $data['tcid'];
            $ClassId      = $data['cid'];

            try {
                $sql = "SELECT * FROM tbl_teacheradvisory WHERE teacherid =:teacherid  
                AND status=:status LIMIT 1";
                $paramType  = ":placeholder";
                $paramValue = array(
                    "teacherid" => $TeacherId,
                    "status"    => 'active'
                );

                if(!$this->runSql($sql, $paramType, $paramValue)
                ) {
                    echo json_encode(array(
                        'message' =>  true,
                        'status'  => 'success'
                    ));
                    die();
                }  

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
                AND c.class_id = $ClassId";

                if($result = $this->runBaseSql($sql)
                ) {
                    if (is_array($result) || is_object($result)
                    ) {
                        if(isset($_SESSION['arrdata'])
                        ) {
                            unset($_SESSION['arrdata']);
                            unset($_SESSION['Teacher']);
                            unset($_SESSION['topHeader']);
                        }
                        
                        $sql = "SELECT * FROM tbl_teacher WHERE teacher_id  =:teacher_id   
                        AND status=:status LIMIT 1";
                        $paramType  = ":placeholder";
                        $paramValue = array(
                            "teacher_id" => $TeacherId,
                            "status"    => 'active'
                        );
        
                        if($teacher = $this->runSql($sql, $paramType, $paramValue)
                        ) {
                            $_SESSION['Teacher'][] = $teacher;
                        } 

                        foreach($result as $row) { 
                            $_SESSION['arrdata'][] = $row['student_id']. "," . $row['fname'] . " " . $row['mname'] .  " " . $row['lname'] . "," . ",,,,";
                        }
                        $_SESSION['topHeader'][] = $schoolYearId;
                        $_SESSION['topHeader'][] = $SubjectId;
                        $_SESSION['topHeader'][] = $ClassId;
                        $_SESSION['topHeader'][] = $TeacherId;
                    }

                    echo json_encode(array(
                        'message'  => $result,
                        'status'   => 'success'
                    ));
                    die();
                }

            } catch(Exception $e) {
                 echo json_encode(array(
                    'message' => 'Error: ' . $e->getMessage(),
                    'status'  => 'error'
                ));
            }
        }

        public function downloadCsvFile() {
            if(isset($_SESSION['arrdata']) && isset($_SESSION['Teacher']) && isset($_SESSION['topHeader'])
            ){ 

                echo json_encode(array(
                    'heading' => $_SESSION['topHeader'],
                    'message' =>  implode("\n", $_SESSION['arrdata']),
                    'teacher' => $_SESSION['Teacher'],
                    'status'  => 'success'
                ));

            } else {
                echo json_encode(array(
                    'message' => 'Empty Data',
                    'status'  => 'error'
                ));
            }

            unset($_SESSION['arrdata']);
        }
    }
?>