<?php 
    class Classes extends Controller {

        public function getAllClasses() {
            try {
                $sql = "SELECT *,c.class_id as cid, 
                y.level_id as yid, s.id as sid from tbl_class c
                left join tbl_schoolyear s on c.schoolyear_id = s.id 
                left join tbl_gradelevel y on c.level_id = y.level_id WHERE c.status = 'active' ORDER BY c.class_id DESC LIMIT 5";

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

        public function SeachClass($key) {
            try { 
                $newkey = $this->cleanStr($key);
       
                $sql = "SELECT *,c.class_id as cid, 
                y.level_id as yid, s.id as sid from tbl_class c
                left join tbl_schoolyear s on c.schoolyear_id = s.id 
                left join tbl_gradelevel y on c.level_id = y.level_id WHERE c.status = 'active' AND 
                concat(
                    classname,
                    schoolyear,
                    grade_level
                    ) LIKE '%$newkey%' 
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
                    "status" => "error"
                ));
            }
            echo $response;
        }

        public function insertClass($data) {
            try {
                $sql = "INSERT INTO tbl_class(classname, schoolyear_id, level_id) VALUES (:classname, :schoolyear_id, :level_id)";

                $paramType = ":placeholder";
                $paramValue = array(
                    "classname"     => $data[0], 
                    "schoolyear_id" => $data[1], 
                    "level_id"      => $data[2]
                );

                if($this->insert($sql, $paramType, $paramValue)) {
                    $response = json_encode(array(
                        "message" => "Successfully Add Class",
                        "status"  => "success"
                    ));
                } 
    
            } catch(Exception $e) {
                $response = json_encode(array(
                    "message" => "Error ". $e->getMessage(),
                    "status"  => "error"
                ));
            }
            echo $response;
        }

        public function removeClass($data) {
            try {
                foreach($data as $value) {

                    $sql = "SELECT * FROM tbl_studentclass WHERE classid =:classid AND status='active' LIMIT 1";
                    $paramType  = ":placeholder";
                    $paramValue = array(
                        "classid" => $value 
                    );
    
                    if($this->runSql($sql, $paramType, $paramValue)
                    ) {
                        echo json_encode(array(
                            "message" => "Unable To Set Inactive Class Have Assign In Student Class",
                            "status"  => "error"
                        ));
                        die();
                        
                    } else {

                        $sql = "SELECT * FROM tbl_teacheradvisory WHERE classid =:classid AND status='active' LIMIT 1";
                        $paramType  = ":placeholder";
                        $paramValue = array(
                            "classid" => $value 
                        );
        
                        if($this->runSql($sql, $paramType, $paramValue)
                        ) {
                            echo json_encode(array(
                                "message" => "Unable To Set Inactive Class Have Assign In Teacher Advisory",
                                "status"  => "error"
                            ));
                            die();
                            
                        } else {

                        $sql="UPDATE tbl_class SET status='unactive' WHERE class_id=:class_id";
                        $paramType = ":placeholder";
                        $paramValue = array(
                            "class_id" => $value,
                        );

                        if($this->update($sql, $paramType, $paramValue)
                            ){
                            
                                $reponse = json_encode(array(
                                    "message" => "Successfully Set Inactive Class",
                                    "status" => "success"
                                )); 
                            }
                        }
                    }
                }
                
            } catch(Exception $e) {
                $reponse = json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status" => "error"
                ));
            }
            echo $reponse;
        }

        public function printAllClass() {
            try {
                $sql = "SELECT *,c.class_id as cid, 
                y.level_id as yid, s.id as sid from tbl_class c
                left join tbl_schoolyear s on c.schoolyear_id = s.id 
                left join tbl_gradelevel y on c.level_id = y.level_id WHERE c.status = 'active'";

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

        public function sortClass($number) {
            try {
                $sql = "SELECT *,c.class_id as cid, 
                y.level_id as yid, s.id as sid from tbl_class c
                left join tbl_schoolyear s on c.schoolyear_id = s.id 
                left join tbl_gradelevel y on c.level_id = y.level_id WHERE c.status = 'active' ORDER BY c.class_id DESC LIMIT " . $this->cleanStr($number);   

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

        public function classtotalPages() {
            try {
                $sql = "SELECT * FROM tbl_class WHERE status = 'active' ORDER BY class_id";                
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

        public function paginateClass($pagenum) {
            $num_per_page = 05;
            $start_from   = ($this->cleanStr($pagenum-1))*05;
    
            try {
                $sql = "SELECT *,c.class_id as cid, 
                y.level_id as yid, s.id as sid from tbl_class c
                left join tbl_schoolyear s on c.schoolyear_id = s.id 
                left join tbl_gradelevel y on c.level_id = y.level_id WHERE c.status = 'active' ORDER BY c.class_id DESC LIMIT $start_from, $num_per_page";  

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

        function updateValueClass($sbjid) {
            try {
                $sql = "SELECT *,c.class_id as cid, 
                y.level_id as yid, s.id as sid from tbl_class c
                left join tbl_schoolyear s on c.schoolyear_id = s.id 
                left join tbl_gradelevel y on c.level_id = y.level_id WHERE s.status=:status AND c.class_id=:class_id";

                $paramType  = ":placeholder";
                $paramValue = array(
                    "status"     => 'active',
                    "class_id"   => $sbjid
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

        public function updateClass($data) {
            try {
                $sql = "UPDATE tbl_class SET 
                classname      =:classname,
                schoolyear_id  =:schoolyear_id,
                level_id       =:level_id
                WHERE class_id =:class_id";
    
                $paramType  = ":placeholder";
                $paramValue = array(
                    "class_id"      => $data[0],
                    "classname"     => $data[1],
                    "schoolyear_id" => $data[2],
                    "level_id"      => $data[3]
                );
    
               if($this->insert($sql, $paramType, $paramValue)
               ){
                $rsponse = json_encode(array(
                    "message" => "Successfully Update Class",
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

        public function getAllUnactClasses() {
            try {
                $sql = "SELECT *,c.class_id as cid, 
                    y.level_id as yid, s.id as sid from tbl_class c
                    left join tbl_schoolyear s on c.schoolyear_id = s.id 
                    left join tbl_gradelevel y on c.level_id = y.level_id WHERE c.status = 'unactive' ORDER BY c.class_id DESC
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

        public function SeachUnactClass($key) {
            try { 
                $newkey = $this->cleanStr($key);
       
                $sql = "SELECT *,c.class_id as cid, 
                y.level_id as yid, s.id as sid from tbl_class c
                left join tbl_schoolyear s on c.schoolyear_id = s.id 
                left join tbl_gradelevel y on c.level_id = y.level_id WHERE c.status = 'unactive' AND 
                concat(
                    classname,
                    schoolyear,
                    grade_level
                    ) LIKE '%$newkey%' 
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
                    "status" => "error"
                ));
            }
            echo $response;
        }

        public function removeUnactClass($data) {
            try {
                foreach($data as $value) {
    
                    $sql="UPDATE tbl_class SET status='active' WHERE class_id=:class_id";
                    $paramType = ":placeholder";
                    $paramValue = array(
                        "class_id" => $value,
                    );
                    $this->update($sql, $paramType, $paramValue);
                }
                    
                $reponse = json_encode(array(
                    "message" => "Successfully Set Active Class",
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

        public function cleanStr($string){
            
            $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
            $string = preg_replace('/-+/', '-', $string);
            
            return $string;
        } 
    }
?>