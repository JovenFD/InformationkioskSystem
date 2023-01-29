<?php 
    class Year extends Controller {

        public function getAllYear() {
            try {
                $sql = "SELECT * FROM tbl_schoolyear WHERE status='active' ORDER BY id DESC 
                LIMIT 5"; 

                if($result = $this->runBaseSql($sql)
                ) {
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

        public function SeachYear($key) {
            try { 
                $newkey = $this->cleanStr($key);
       
                $sql = "SELECT * FROM tbl_schoolyear WHERE status='active' AND concat(
                    id,
                    schoolyear 
                    ) LIKE '%$newkey%' 
                ";
    
                if($result = $this->runBaseSql($sql)) {
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

        public function addYear($year) {            
            try {
                $date1 = intval(explode('-', $year)[0]);
                $date2 = intval(explode('-', $year)[1]);

                if($date2 > $date1) {
                    $sql = "INSERT INTO tbl_schoolyear(schoolyear) 
                    VALUES (:schoolyear)";
                    $paramType = ":placeholder";
        
                    $paramValue = array(
                        "schoolyear" => $year,
                    );
                    if($this->insert($sql, $paramType, $paramValue)
                    ) {
                        echo json_encode(array(
                            "message" => "Successfully Add School Year",
                            "status"  => "success"
                        ));
                    } 
                } else {
                    echo json_encode(array(
                        "message" => "Invalid Date " . $date1 . '-' . $date2,
                        "status"  => "error"
                    ));
                }
                
            } catch(Exception $e) {
                echo json_encode(array(
                    "message" => "Error :" .$e->getMessage(),
                    "status" => "error"
                ));
            }
        }

        public function removeYear($data) {
            try {
                foreach($data as $value) {

                    $sql = "SELECT * FROM tbl_class WHERE schoolyear_id =:schoolyear_id AND status='active' LIMIT 1";
                    $paramType  = ":placeholder";
                    $paramValue = array(
                        "schoolyear_id" => $value 
                    );
    
                    if($this->runSql($sql, $paramType, $paramValue)
                    ) {
                        echo json_encode(array(
                            "message" => "Unable To Set Inactive School Year Have Assign In Class",
                            "status"  => "error"
                        ));
                        die();
                        
                    } else {
    
                        $sql="UPDATE tbl_schoolyear SET status='unactive' WHERE id=:id";
                        $paramType = ":placeholder";
                        $paramValue = array(
                            "id" => $value,
                        );
                        if($this->update($sql, $paramType, $paramValue)
                        ) {
                            $reponse = json_encode(array(
                                "message" => "Successfully Set Inactive School Year",
                                "status" => "success"
                            ));
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

        public function printAllYear() {
            try {
                $sql = "SELECT * FROM tbl_schoolyear WHERE status = 'active' ORDER BY id DESC ";                
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

        public function sortYear($number) {
            try {
                $sql = "SELECT * FROM tbl_schoolyear WHERE status = 'active' ORDER BY id DESC 
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

        public function yeartotalPages() {
            try {
                $sql = "SELECT * FROM tbl_schoolyear WHERE status = 'active' ORDER BY id";                
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

        public function paginateYear($pagenum) {
            $num_per_page = 05;
            $start_from   = ($this->cleanStr($pagenum-1))*05;
    
            try {
                $sql = "SELECT * FROM tbl_schoolyear WHERE status = 'active' ORDER BY id DESC LIMIT $start_from, $num_per_page";  

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

        function updateValueYear($yrid) {
            try {
                $sql="SELECT * FROM tbl_schoolyear WHERE status=:status AND id=:id";
                $paramType = ":placeholder";
                $paramValue = array(
                    "status" => 'active',
                    "id"     => $yrid
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

        public function updateYear($data) {
            try {
                $sql = "UPDATE tbl_schoolyear SET 
                schoolyear =:schoolyear
                WHERE id   =:id";
    
                $paramType  = ":placeholder";
                $paramValue = array(
                    "id"         => $data[0],
                    "schoolyear" => $data[1],
                );
    
               if($this->insert($sql, $paramType, $paramValue)
               ) {
                    $rsponse = json_encode(array(
                        "message" => "Successfully Update School Year",
                        "status"  => "success"
                    ));
               }
    
           } catch(Exception $e) {
               $rsponse = json_encode(array(
                   "message" => "Error: " . $e->getMessage(),
                   "status"  => "error"
               ));
           }
           echo $rsponse;
        }

        public function getAllUnactiveYear() {
            try {
                $sql = "SELECT * FROM tbl_schoolyear WHERE status='unactive' ORDER BY id DESC 
                "; 

                if($result = $this->runBaseSql($sql)
                ) {
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

        public function SeachUnactYear($key) {
            try { 
                $newkey = $this->cleanStr($key);
       
                $sql = "SELECT * FROM tbl_schoolyear WHERE status='unactive' AND concat(
                    id,
                    schoolyear 
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
                    "status"  => "error"
                ));
            }
            echo $response;
        }

        public function removeUnactYear($data) {
            try {
                foreach($data as $value) {
    
                    $sql="UPDATE tbl_schoolyear SET status='active' WHERE id=:id";
                    $paramType = ":placeholder";
                    $paramValue = array(
                        "id" => $value,
                    );
                    $this->update($sql, $paramType, $paramValue);
                }
                    
                $reponse = json_encode(array(
                    "message" => "Successfully Set Active School Year",
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
