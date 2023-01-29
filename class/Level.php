<?php 
    class Level extends Controller {

        public function getAllLevel() {
            try {
                $sql = "SELECT * FROM tbl_gradelevel WHERE status='active' ORDER BY level_id  DESC 
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

        public function SeachLevel($key) {
            try { 
                $newkey = $this->cleanStr($key);
    
                $sql = "SELECT * FROM tbl_gradelevel WHERE status='active' AND concat(
                    level_id,
                    grade_level,
                    discription
                    ) LIKE '%$newkey%'";

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

        public function insertLevel($data) {
            try {
                $sql = "INSERT INTO tbl_gradelevel(grade_level, discription) 
                VALUES (:grade_level, :discription)";
                $paramType = ":placeholder";
    
                $paramValue = array(
                    "grade_level" => $this->cleanStr($data[0]),
                    "discription" => $this->cleanStr($data[1])
                );

                if($this->insert($sql, $paramType, $paramValue)
                ){
                    echo json_encode(array(
                        "message" => "Successfully Insert Year Level",
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

        public function removeLevel($data) {
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
    
                        $sql="UPDATE tbl_gradelevel SET status='unactive'
                        WHERE level_id=:level_id";
                        $paramType = ":placeholder";
                        $paramValue = array(
                            "level_id" => $value,
                        );

                        if($this->update($sql, $paramType, $paramValue)
                        ) {
                            $reponse = json_encode(array(
                                "message" => "Successfully Set Unactive Year Level",
                                "status"  => "success"
                            ));
                        }
                    }
                }
                
            } catch(Exception $e) {
                $reponse = json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status"  => "error"
                ));
            }
            echo $reponse;
        }

        public function printAllLevel() {
            try {
                $sql = "SELECT * FROM tbl_gradelevel WHERE status = 'active' ORDER BY level_id DESC ";                
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

        public function sortLevel($number) {
            try {
                $sql = "SELECT * FROM tbl_gradelevel WHERE status = 'active' ORDER BY level_id DESC 
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

        public function leveltotalPages() {
            try {
                $sql = "SELECT * FROM tbl_gradelevel WHERE status = 'active' ORDER BY level_id";                
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
                    "status"  => "error"
                ));
            }
            echo $response;
        }

        public function paginateLevel($pagenum) {
            $num_per_page = 05;
            $start_from   = ($this->cleanStr($pagenum-1))*05;
    
            try {
                $sql = "SELECT * FROM tbl_gradelevel WHERE status = 'active' ORDER BY level_id DESC LIMIT $start_from, $num_per_page";   

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

        function updateValueLevel($lvlid) {
            try {
                $sql="SELECT * FROM tbl_gradelevel WHERE status=:status AND level_id=:level_id";
                $paramType = ":placeholder";
                $paramValue = array(
                    "status"   => 'active',
                    "level_id" => $lvlid
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

        public function updateLevel($data) {
            try {
                $sql = "UPDATE tbl_gradelevel SET 
                grade_level  =:grade_level,
                discription  =:discription
                WHERE level_id =:level_id";
    
                $paramType  = ":placeholder";
                $paramValue = array(
                    "level_id"    => $data[0],
                    "grade_level" => $data[1],
                    "discription" => $data[2],
                );
    
               if($this->insert($sql, $paramType, $paramValue)
               ){
                    $rsponse = json_encode(array(
                        "message" => "Successfully Update Year Level",
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

        public function getAllUnactLevel() {
            try {
                $sql = "SELECT * FROM tbl_gradelevel WHERE status='unactive' ORDER BY level_id  DESC 
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

        public function SeachUnactLevel($key) {
            try { 
                $newkey = $this->cleanStr($key);
    
                $sql = "SELECT * FROM tbl_gradelevel WHERE status='unactive' AND concat(
                    level_id,
                    grade_level,
                    discription
                    ) LIKE '%$newkey%'";

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

        public function removeUnactLevel($data) {
            try {
                foreach($data as $value) {
    
                    $sql="UPDATE tbl_gradelevel SET status='active'
                    WHERE level_id=:level_id";
                    $paramType = ":placeholder";
                    $paramValue = array(
                        "level_id" => $value,
                    );
                    $this->update($sql, $paramType, $paramValue);
                }
                    
                $reponse = json_encode(array(
                    "message" => "Successfully Set Active Year Level",
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