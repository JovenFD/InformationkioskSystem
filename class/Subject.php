<?php 
    class Subject extends Controller {
            
        public function getAllSubject() {
            try {

                $sql = "SELECT *,y.level_id as yid FROM tbl_subject s LEFT JOIN tbl_gradelevel y on s.yearlevelid = y.level_id WHERE s.status = 'active' ORDER BY s.subject_id DESC LIMIT 5";  

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

        public function SeachSubject($key) {
            try { 
                $newkey = $this->cleanStr($key);
       
                $sql = "SELECT *,y.level_id as yid FROM tbl_subject s LEFT JOIN tbl_gradelevel y on s.yearlevelid = y.level_id WHERE s.status = 'active' AND concat(
                    subject_name,
                    grade_level,
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
                    "status" => "error"
                ));
            }
            echo $response;
        }

        public function listValDropDown() {
            try {
                $sql = "SELECT *,s.subject_id as subjID from tbl_studentclass sc 
                left join tbl_subject s on sc.subjectid = s.subject_id
                GROUP BY s.subject_id, s.subject_id
                HAVING COUNT(*)>1";
    
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
                    "status" => "er ror"
                ));
            }
            echo $response;
        }

        public function insertSubject($data) {
            try {
                $sql = "INSERT INTO tbl_subject (subject_name, discription_subject, yearlevelid) VALUES (:subject_name, :discription_subject, :yearlevelid)";
                $paramType = ":placeholder";
                $paramValue = array(
                    "subject_name"        => $this->cleanStr($data[0]), 
                    "discription_subject" => $this->cleanStr($data[1]), 
                    "yearlevelid"         => $this->cleanStr($data[2])
                );
    
                if($this->insert($sql, $paramType, $paramValue)) {
                    echo json_encode(array(
                        "message" => "Successfully Add Subject",
                        "status"  => "success"
                    ));
                } 
    
            } catch(Exception $e) {
                echo json_encode(array(
                    "message" => "Error ". $e->getMessage(),
                    "status"  => "error"
                ));
            }
        }

        public function printAllSubject() {
            try {

                $sql = "SELECT *,y.level_id as yid FROM tbl_subject s LEFT JOIN tbl_gradelevel y on s.yearlevelid = y.level_id WHERE s.status = 'active' ORDER BY s.subject_id DESC  LIMIT 5";                
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

        public function removeSubject($data) {
            try {
                foreach($data as $value) {
                    $sql = "SELECT * FROM tbl_studentclass WHERE subjectid =:subjectid AND status='active' LIMIT 1";
                    $paramType  = ":placeholder";
                    $paramValue = array(
                        "subjectid" => $value 
                    );
    
                    if($this->runSql($sql, $paramType, $paramValue)
                    ) {
                        echo json_encode(array(
                            "message" => "Unable to set Inactive Subject Have Assign In Student Class",
                            "status"  => "error"
                        ));
                        die();
                        
                    } else {

                        $sql = "SELECT * FROM tbl_teacheradvisory WHERE subjectid =:subjectid AND status='active' LIMIT 1";
                        $paramType  = ":placeholder";
                        $paramValue = array(
                            "subjectid" => $value 
                        );
        
                        if($this->runSql($sql, $paramType, $paramValue)
                        ) {
                            echo json_encode(array(
                                "message" => "Unable To Set Inactive Subject Have Assign In Teacher Advisory",
                                "status"  => "error"
                            ));
                            die();
                            
                        } else {
                            $sql="UPDATE tbl_subject SET status='unactive' WHERE subject_id=:subject_id";
                            $paramType = ":placeholder";
                            $paramValue = array(
                                "subject_id" => $value,
                            );

                            if($this->update($sql, $paramType, $paramValue)
                            ){
                                $response = json_encode(array(
                                    "message" => "Successfully Set Inactive Subject",
                                    "status"  => "success"
                                ));
                            }
                        }
                    }
                }
                
            } catch(Exception $e) {
                $response = json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status"  => "error"
                ));
            }
            echo $response;
        }

        public function sortSubject($number) {
            try {

                $sql = "SELECT *,y.level_id as yid FROM tbl_subject s LEFT JOIN tbl_gradelevel y on s.yearlevelid = y.level_id WHERE s.status = 'active' ORDER BY s.subject_id DESC  LIMIT ". $this->cleanStr($number); 

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

        public function subjectstotalPages() {
            try {
                $sql = "SELECT * FROM tbl_subject WHERE status = 'active' ORDER BY subject_id";                
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

        public function paginateSubject($pagenum) {
            $num_per_page = 05;
            $start_from   = ($this->cleanStr($pagenum-1))*05;
    
            try {
                $sql = "SELECT *,y.level_id as yid FROM tbl_subject s LEFT JOIN tbl_gradelevel y on s.yearlevelid = y.level_id WHERE s.status = 'active' ORDER BY s.subject_id  DESC LIMIT $start_from, $num_per_page";                
                
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

        function updateValueSubject($sbjid) {
            try {
                $sql = "SELECT *,y.level_id as yid FROM tbl_subject s LEFT JOIN tbl_gradelevel y on s.yearlevelid = y.level_id WHERE s.status=:status AND s.subject_id=:subject_id";

                $paramType  = ":placeholder";
                $paramValue = array(
                    "status"     => 'active',
                    "subject_id" => $sbjid
                );
                
                if($result = $this->runSql($sql, $paramType, $paramValue)){
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

        public function updateSubject($data) {
            try {
                $sql = "UPDATE tbl_subject SET 
                subject_name       =:subject_name,
                discription_subject=:discription_subject,
                yearlevelid        =:yearlevelid
                WHERE subject_id   =:subject_id";
    
                $paramType  = ":placeholder";
                $paramValue = array(
                    "subject_id"   => $data[0],
                    "subject_name" => $data[1],
                    "discription_subject" => $data[2],
                    "yearlevelid"  => $data[3],
                );
    
               if($this->insert($sql, $paramType, $paramValue)
               ){
                    $rsponse = json_encode(array(
                        "message" => "Successfully Update Subject",
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

        public function getAllUnactSubject() {
            try {

                $sql = "SELECT *,y.level_id as yid FROM tbl_subject s   LEFT JOIN tbl_gradelevel y on s.yearlevelid = y.level_id WHERE s.status = 'unactive' ORDER BY s.subject_id DESC ";  

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

        public function SeachUnactSubject($key) {
            try { 
                $newkey = $this->cleanStr($key);
       
                $sql = "SELECT *,y.level_id as yid FROM tbl_subject s LEFT JOIN tbl_gradelevel y on s.yearlevelid = y.level_id WHERE s.status = 'unactive' AND concat(
                    subject_name,
                    grade_level,
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
                    "status" => "error"
                ));
            }
            echo $response;
        }

        public function removeUnactSubject($data) {
            try {
                foreach($data as $value) {
    
                    $sql="UPDATE tbl_subject SET status='active' WHERE subject_id=:subject_id";
                    $paramType = ":placeholder";
                    $paramValue = array(
                        "subject_id" => $value,
                    );
                    $this->update($sql, $paramType, $paramValue);
                }
                    
                $reponse = json_encode(array(
                    "message" => "Successfully Set Active Subject",
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