<?php
    class TeacherAdvisory extends Controller {

        public function getAllStdTeacherAdvisory() {
            try {
                $sql = "SELECT *,c.class_id as cid,
                t.teacher_id as tid, sb.subject_id as sbid,
                ta.teacheradvisory_id as taid,CONCAT(t.lname, ', ', t.fname, ' ',t.mname) as tname from tbl_teacheradvisory ta
                left join tbl_teacher t on ta.teacherid = t.teacher_id 
                left join tbl_class c on ta.classid = c.class_id 
                left join tbl_subject sb on ta.subjectid = sb.subject_id WHERE ta.status='active' AND t.status='active'
                ORDER BY ta.teacheradvisory_id DESC    
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

        public function SeachTeacherAdvisory($key) {
            try { 
                $newkey = $this->cleanStr($key);
       
                $sql = "SELECT *,c.class_id as cid,
                t.teacher_id as tid, sb.subject_id as sbid,
                ta.teacheradvisory_id as taid,CONCAT(t.lname, ', ', t.fname, ' ',t.mname) as tname from tbl_teacheradvisory ta
                left join tbl_teacher t on ta.teacherid = t.teacher_id 
                left join tbl_class c on ta.classid = c.class_id 
                left join tbl_subject sb on ta.subjectid = sb.subject_id WHERE ta.status='active' AND t.status='active' AND
                CONCAT(teacheradvisory_id, classname, fname, mname, lname, subject_name, discription_subject)LIKE '%$newkey%'";
    
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

        public function insertTeacherAdvisory($data) {
            try {
                $sql = "INSERT INTO tbl_teacheradvisory(teacherid, classid, subjectid) 
                VALUES (:teacherid, :classid, :subjectid)";
                $paramType = ":placeholder";
    
                $paramValue = array(
                    "teacherid" => $data[0],
                    "classid"   => $data[1],
                    "subjectid" => $data[2]
                );

                if($this->insert($sql, $paramType, $paramValue)) {
                    echo json_encode(array(
                        "message" => "Successfully Add Teacher Advisory",
                        "status"  => "success"
                    ));
                }

            } catch(Exception $e) {
                echo json_encode(array(
                    "message" => "Error :" .$e->getMessage(),
                    "status" => "error"
                ));
            }
        }

        public function printAllTeacherAdvisory() {
            try {
                $sql = "SELECT *,c.class_id as cid,
                t.teacher_id as tid, sb.subject_id as sbid,
                ta.teacheradvisory_id as taid,CONCAT(t.lname, ', ', t.fname, ' ',t.mname) as tname from tbl_teacheradvisory ta
                left join tbl_teacher t on ta.teacherid = t.teacher_id 
                left join tbl_class c on ta.classid = c.class_id 
                left join tbl_subject sb on ta.subjectid = sb.subject_id WHERE ta.status='active' AND t.status='active'
                ORDER BY ta.teacheradvisory_id DESC    
                LIMIT 5";         

                $result = $this->runBaseSql($sql);
                
                return $result;

            } catch(Exception $e) {
                $reponse =  json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status"  => "error"
                ));
            }
            echo $reponse;
        }

        public function removeTeacherAdvisory($data) {
            try {
                foreach($data as $value) {
    
                    $sql="UPDATE tbl_teacheradvisory SET status='unactive' WHERE teacheradvisory_id=:teacheradvisory_id";
                    $paramType  = ":placeholder";
                    $paramValue = array(
                        "teacheradvisory_id" => $value,
                    );
                    $this->update($sql, $paramType, $paramValue);
                }
                    
                $reponse = json_encode(array(
                    "message" => "Successfully set Inactive Teacher Advisory",
                    "status"  => "success"
                ));
                
            } catch(Exception $e) {
                $reponse = json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status"  => "error"
                ));
            }
            echo $reponse;
        }

        public function sortStudentTeacherAdvisory($number) {
            try {
                $sql = "SELECT *,c.class_id as cid,
                t.teacher_id as tid, sb.subject_id as sbid,
                ta.teacheradvisory_id as taid,CONCAT(t.lname, ', ', t.fname, ' ',t.mname) as tname from tbl_teacheradvisory ta
                left join tbl_teacher t on ta.teacherid = t.teacher_id 
                left join tbl_class c on ta.classid = c.class_id 
                left join tbl_subject sb on ta.subjectid = sb.subject_id WHERE ta.status='active' AND t.status='active'
                ORDER BY ta.teacheradvisory_id DESC    
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
                    "status"  => "error"
                ));
            }
            echo $response;
        }

        public function tecaherAdvisoryTotalPages() {
            $counter = 0;

            try {
                $sql = "SELECT *,c.class_id as cid,
                t.teacher_id as tid, sb.subject_id as sbid,
                ta.teacheradvisory_id as taid,CONCAT(t.lname, ', ', t.fname, ' ',t.mname) as tname from tbl_teacheradvisory ta
                left join tbl_teacher t on ta.teacherid = t.teacher_id 
                left join tbl_class c on ta.classid = c.class_id 
                left join tbl_subject sb on ta.subjectid = sb.subject_id WHERE ta.status='active' AND t.status='active'
                ORDER BY ta.teacheradvisory_id DESC ";                

                $result = $this->runBaseSql($sql);
    
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

        public function paginateTeacherAdvisory($pagenum) {
            $num_per_page = 05;
            $start_from   = ($this->cleanStr($pagenum-1))*05;
    
            try {
                $sql = "SELECT *,c.class_id as cid,
                t.teacher_id as tid, sb.subject_id as sbid,
                ta.teacheradvisory_id as taid,CONCAT(t.lname, ', ', t.fname, ' ',t.mname) as tname from tbl_teacheradvisory ta
                left join tbl_teacher t on ta.teacherid = t.teacher_id 
                left join tbl_class c on ta.classid = c.class_id 
                left join tbl_subject sb on ta.subjectid = sb.subject_id WHERE ta.status='active' AND t.status='active'
                ORDER BY ta.teacheradvisory_id DESC    
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

        public function updateValueTeacherAdvisory($tchrAdvid) {
            try {
                $sql="SELECT * FROM tbl_teacheradvisory WHERE status=:status AND teacheradvisory_id=:teacheradvisory_id";
                $paramType = ":placeholder";
                $paramValue = array(
                    "status" => 'active',
                    "teacheradvisory_id" => $tchrAdvid
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

        public function updateTeacherAdvisory($data) {
            try {
                $sql = "UPDATE tbl_teacheradvisory SET 
                teacherid  =:teacherid,
                classid    =:classid,
                subjectid  =:subjectid
                WHERE teacheradvisory_id =:teacheradvisory_id";
    
                $paramType  = ":placeholder";
                $paramValue = array(
                    "teacheradvisory_id" => $data[0],
                    "teacherid" => $data[1],
                    "classid"   => $data[2],
                    "subjectid" => $data[3]
                );
    
               if($this->insert($sql, $paramType, $paramValue)
               ) {
                    $rsponse = json_encode(array(
                        "message" => "Successfully Update Teacher Advisory",
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

        public function getAllUnactStdTeacherAdvisory() {
            try {
                $sql = "SELECT *,c.class_id as cid,
                    t.teacher_id as tid, sb.subject_id as sbid,
                    ta.teacheradvisory_id as taid,CONCAT(t.lname, ', ', t.fname, ' ',t.mname) as tname from tbl_teacheradvisory ta
                    left join tbl_teacher t on ta.teacherid = t.teacher_id 
                    left join tbl_class c on ta.classid = c.class_id 
                    left join tbl_subject sb on ta.subjectid = sb.subject_id WHERE ta.status='unactive' ORDER BY ta.teacheradvisory_id DESC    
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

        public function SeachUnactTeacherAdvisory($key) {
            try { 
                $newkey = $this->cleanStr($key);
       
                $sql = "SELECT *,c.class_id as cid,
                    t.teacher_id as tid, sb.subject_id as sbid,
                    ta.teacheradvisory_id as taid,CONCAT(t.lname, ', ', t.fname, ' ',t.mname) as tname from tbl_teacheradvisory ta
                    left join tbl_teacher t on ta.teacherid = t.teacher_id 
                    left join tbl_class c on ta.classid = c.class_id 
                    left join tbl_subject sb on ta.subjectid = sb.subject_id WHERE ta.status='unactive' AND 
                    CONCAT(teacheradvisory_id, classname, fname, mname, lname, subject_name, discription_subject)LIKE '%$newkey%'
                ";
    
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

        public function removeUnactTeacherAdvisory($data) {
            try {
                foreach($data as $value) {
    
                    $sql="UPDATE tbl_teacheradvisory SET status='active' WHERE teacheradvisory_id=:teacheradvisory_id";
                    $paramType  = ":placeholder";
                    $paramValue = array(
                        "teacheradvisory_id" => $value,
                    );
                    $this->update($sql, $paramType, $paramValue);
                }
                    
                $reponse = json_encode(array(
                    "message" => "Successfully Set Active Teacher Advisory",
                    "status"  => "success"
                ));
                
            } catch(Exception $e) {
                $reponse = json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status"  => "error"
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