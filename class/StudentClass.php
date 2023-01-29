<?php
    class StudentClass extends Controller {

        public function getAllStdClasses() {
            try {
                $sql = "SELECT *,c.class_id AS cid,
                st.student_id AS stid,
                sb.subject_id AS sbid,
                sc.studentclass_id AS sid,
                CONCAT(st.lname, ', ', st.fname, ' ',st.mname) AS sname FROM tbl_studentclass sc
                LEFT JOIN tbl_class c ON sc.classid = c.class_id 
                LEFT JOIN tbl_student st ON sc.studentid = st.student_id 
                LEFT JOIN tbl_subject sb ON sc.subjectid = sb.subject_id WHERE sc.status='active' AND st.status='active' ORDER BY sc.studentclass_id  DESC 
                LIMIT 5";         

                if($result = $this->runBaseSql($sql)
                ){
                    $reponse =  json_encode(array(
                        "message" => $result,
                        "status"  => "success"
                    ));
                }
                
            } catch(Exception $e) {
                $reponse =  json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status"  => "error"
                ));
            }
            echo $reponse;
        }

        public function SeachSdtClass($key) {
            $newkey = $this->cleanStr($key);

            try { 
                $sql = "SELECT *,c.class_id AS cid,
                st.student_id AS stid,
                sb.subject_id AS sbid,
                sc.studentclass_id AS sid,
                CONCAT(st.lname, ', ', st.fname, ' ',st.mname) AS sname FROM tbl_studentclass sc
                LEFT JOIN tbl_class c ON sc.classid = c.class_id 
                LEFT JOIN tbl_student st ON sc.studentid = st.student_id 
                LEFT JOIN tbl_subject sb ON sc.subjectid = sb.subject_id WHERE sc.status='active' AND st.status='active' AND CONCAT(
                    studentclass_id,
                    classname,
                    fname,
                    mname,
                    lname,
                    subject_name,
                    discription_subject
                    ) LIKE '%$newkey%' 
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

        public function insertStudentClass($data) {
            try {
                $sql = "INSERT INTO tbl_studentclass(classid, studentid, subjectid) 
                VALUES (:classid, :studentid, :subjectid)";
                $paramType = ":placeholder";
    
                $paramValue = array(
                    "classid"   => $data[0],
                    "studentid" => $data[1],
                    "subjectid" => $data[2]
                );
                if($this->insert($sql, $paramType, $paramValue)) {
                    echo json_encode(array(
                        "message" => "Successfully Add Student Class",
                        "status"  => "success"
                    ));
                }

            } catch(Exception $e) {
                echo json_encode(array(
                    "message" => "Error :" .$e->getMessage(),
                    "status"  => "error"
                ));
            }
        }

        public function printAllStudentClass() {
            try {
                $sql = "SELECT *,c.class_id AS cid,
                st.student_id AS stid,
                sb.subject_id AS sbid,
                sc.studentclass_id AS sid,
                CONCAT(st.lname, ', ', st.fname, ' ',st.mname) AS sname FROM tbl_studentclass sc
                LEFT JOIN tbl_class c ON sc.classid = c.class_id 
                LEFT JOIN tbl_student st ON sc.studentid = st.student_id 
                LEFT JOIN tbl_subject sb ON sc.subjectid = sb.subject_id WHERE sc.status='active' AND st.status='active' ORDER BY sc.studentclass_id  DESC"; 

                $result = $this->runBaseSql($sql);
                
                return $result;
    
            } catch(Exception $e) {
                $response = json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status"  => "error"
                ));
            }
            echo $response;
        }

        public function sortStudentClass($number) {
            try {
                $sql = "SELECT *,c.class_id AS cid,
                st.student_id AS stid,
                sb.subject_id AS sbid,
                sc.studentclass_id AS sid,
                CONCAT(st.lname, ', ', st.fname, ' ',st.mname) AS sname FROM tbl_studentclass sc
                LEFT JOIN tbl_class c ON sc.classid = c.class_id 
                LEFT JOIN tbl_student st ON sc.studentid = st.student_id 
                LEFT JOIN tbl_subject sb ON sc.subjectid = sb.subject_id WHERE sc.status='active' AND st.status='active' ORDER BY sc.studentclass_id  DESC 
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

        public function studentClassTotalPages() {
            try {
                $sql = "SELECT *,c.class_id AS cid,
                st.student_id AS stid,
                sb.subject_id AS sbid,
                sc.studentclass_id AS sid,
                CONCAT(st.lname, ', ', st.fname, ' ',st.mname) AS sname FROM tbl_studentclass sc
                LEFT JOIN tbl_class c ON sc.classid = c.class_id 
                LEFT JOIN tbl_student st ON sc.studentid = st.student_id 
                LEFT JOIN tbl_subject sb ON sc.subjectid = sb.subject_id WHERE sc.status='active' AND st.status='active'";                
                $result = $this->runBaseSql($sql);
                $counter = 0;
    
                if (is_array($result) || is_object($result)) { 
                    foreach($result as $value) {
                        $counter++;
                    }
                }
                
                $response = json_encode(array(
                    "message" => $counter,
                    "status" => "success"
                ));
    
            } catch(Exception $e) {
                $response = json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status" => "error"
                ));
            }
            echo $response;
        }

        public function paginateStudentClass($pagenum) {
            $num_per_page = 05;
            $start_from   = ($this->cleanStr($pagenum-1))*05;
    
            try {
                $sql = "SELECT *,c.class_id AS cid,
                st.student_id AS stid,
                sb.subject_id AS sbid,
                sc.studentclass_id AS sid,
                CONCAT(st.lname, ', ', st.fname, ' ',st.mname) AS sname FROM tbl_studentclass sc
                LEFT JOIN tbl_class c ON sc.classid = c.class_id 
                LEFT JOIN tbl_student st ON sc.studentid = st.student_id 
                LEFT JOIN tbl_subject sb ON sc.subjectid = sb.subject_id WHERE sc.status='active' AND st.status='active' ORDER BY sc.studentclass_id DESC 
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

        public function removeStudentClass($data) {
            try {
                foreach($data as $value) {
    
                    $sql="UPDATE tbl_studentclass SET status='unactive' WHERE studentclass_id=:studentclass_id";
                    $paramType = ":placeholder";
                    $paramValue = array(
                        "studentclass_id" => $value,
                    );
                    $this->update($sql, $paramType, $paramValue);
                }
                    
                $reponse = json_encode(array(
                    "message" => "Successfully Set Inactive Student Class",
                    "status" => "success"
                ));
                
            } catch(Exception $e) {
                $reponse = json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status" => "error"
                ));
            }
            echo $reponse;
        }

        function updateValueStudentClass($stdclsid) {
            try {
                $sql="SELECT * FROM tbl_studentclass WHERE status=:status AND studentclass_id=:studentclass_id";
                $paramType = ":placeholder";
                $paramValue = array(
                    "status" => 'active',
                    "studentclass_id" => $stdclsid
                );
                
                if($result = $this->runSql($sql, $paramType, $paramValue)) {
                    $reponse = json_encode(array(
                        "message" => $result,
                        "status"  => "success"
                    ));
                }
                    
            } catch(Exception $e) {
                $reponse = json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status"  => "error"
                ));
            }
            echo $reponse;
        }

        public function updateStudentClass($data) {
            try {
                $sql = "UPDATE tbl_studentclass SET 
                classid   =:classid ,
                studentid =:studentid ,
                subjectid =:subjectid
                WHERE studentclass_id =:studentclass_id";
    
                $paramType  = ":placeholder";
                $paramValue = array(
                    "studentclass_id" => $data[0],
                    "classid"   => $data[1],
                    "studentid" => $data[2],
                    "subjectid" => $data[3],
                );
    
               if($this->insert($sql, $paramType, $paramValue)
               ) {
                    $response = json_encode(array(
                        "message" => "Successfully Update Student Classs",
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

        public function getAllUnactiveStdClass() {
            try {
                $sql = "SELECT *,c.class_id AS cid,
                    st.student_id AS stid,
                    sb.subject_id AS sbid,
                    sc.studentclass_id AS sid,
                    CONCAT(st.lname, ', ', st.fname, ' ',st.mname) AS sname FROM tbl_studentclass sc
                    LEFT JOIN tbl_class c ON sc.classid = c.class_id 
                    LEFT JOIN tbl_student st ON sc.studentid = st.student_id 
                    LEFT JOIN tbl_subject sb ON sc.subjectid = sb.subject_id WHERE sc.status='unactive' ORDER BY sc.studentclass_id DESC 
                ";         

                if($result = $this->runBaseSql($sql)
                ){
                    $reponse =  json_encode(array(
                        "message" => $result,
                        "status"  => "success"
                    ));
                }
                
            } catch(Exception $e) {
                $reponse =  json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status"  => "error"
                ));
            }
            echo $reponse;
        }

        public function SeachUnactSdtClass($key) {
            $newkey = $this->cleanStr($key);

            try { 
                $sql = "SELECT *,c.class_id AS cid,
                st.student_id AS stid,
                sb.subject_id AS sbid,
                sc.studentclass_id AS sid,
                CONCAT(st.lname, ', ', st.fname, ' ',st.mname) AS sname FROM tbl_studentclass sc
                LEFT JOIN tbl_class c ON sc.classid = c.class_id 
                LEFT JOIN tbl_student st ON sc.studentid = st.student_id 
                LEFT JOIN tbl_subject sb ON sc.subjectid = sb.subject_id WHERE sc.status='unactive' AND CONCAT(
                    studentclass_id,
                    classname,
                    fname,
                    mname,
                    lname,
                    subject_name,
                    discription_subject
                    ) LIKE '%$newkey%' 
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

        public function removeUnactStudentClass($data) {
            try {
                foreach($data as $value) {
    
                    $sql="UPDATE tbl_studentclass SET status='active' WHERE studentclass_id=:studentclass_id";
                    $paramType = ":placeholder";
                    $paramValue = array(
                        "studentclass_id" => $value,
                    );
                    $this->update($sql, $paramType, $paramValue);
                }
                    
                $reponse = json_encode(array(
                    "message" => "Successfully Set Active Student Class",
                    "status" => "success"
                ));
                
            } catch(Exception $e) {
                $reponse = json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status" => "error"
                ));
            }
            echo $reponse;
        }

        public function cleanStr($string){

            $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
            $string = preg_replace('/-+/', '-', $string);
            
            return $string;
        }
    }
?>