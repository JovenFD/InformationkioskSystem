<?php
    class Feedback extends Controller {

        public function addFeedBack($fullname, $yearLevel_id, $message) {

            try {
                $sql = "INSERT INTO tbl_feedback(fullname, yearLevel_id, feedback) 
                VALUES (:fullname, :yearLevel_id, :feedback)";
                $paramType = ":placeholder";
    
                $paramValue = array(
                    "fullname"     => $fullname,
                    "yearLevel_id" => $yearLevel_id,
                    "feedback"     => $this->cleanStr($message)
                );

                if($this->insert($sql, $paramType, $paramValue)
                ){
                    echo json_encode(array(
                        "message" => "Successfully Send Message",
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

        public function countAllNewMsg() {
            try {
                $counter = 0;
                $sql = "SELECT * FROM tbl_feedback WHERE status='new'"; 

                if($result = $this->runBaseSql($sql)
                ) {

                    if (is_array($result) || is_object($result)) { 
                        foreach($result as $value) {
                            $counter++;
                        }
                    }

                    $reponse =  json_encode(array(
                        "message" => $counter,
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

        public function getAllNewMsg() {
            try {
                $sql = "SELECT * FROM tbl_feedback WHERE status='new' ORDER BY feedback_id DESC"; 

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

        public function UpdateToOldMsg($data) {
            try {
                $sql = "UPDATE tbl_feedback SET status=:status WHERE feedback_id =:feedback_id";

                $paramType  = ":placeholder";
                $paramValue = array(
                    "feedback_id" => $data,
                    "status"  => 'old'
                );
    
               if($this->insert($sql, $paramType, $paramValue)
               ){
                    $sql = "SELECT * FROM tbl_feedback WHERE feedback_id=:feedback_id LIMIT 1";
                    $paramType = ":placeholder";
                    $paramValue = array(
                        "feedback_id" => $data, 
                    );

                    if($result = $this->runSql($sql, $paramType, $paramValue)
                    ) { 
                        $sql = "SELECT * FROM tbl_gradelevel WHERE level_id IN (SELECT level_id FROM tbl_feedback WHERE feedback_id=:feedback_id)";
                        $paramType = ":placeholder";
                        $paramValue = array(
                            "feedback_id" => $data, 
                        );

                        if($yearLevel = $this->runSql($sql, $paramType, $paramValue)
                        ) { 
                            $response = json_encode(array(
                                "message"   => $result,
                                "levelYear" => $yearLevel,
                                "status"    => "success"
                            ));
                        }
                    }    
               }
    
           } catch(Exception $e) {
               $response = json_encode(array(
                   "message" => "Error: " . $e->getMessage(),
                   "status" => "error"
               ));
           }
           echo $response;
        }

        public function getAllOldMsg() {
            try {
                $sql = "SELECT *,f.feedback_id as fid, y.level_id as fid from tbl_feedback f left join tbl_gradelevel y on y.level_id = y.level_id WHERE f.status = 'old'"; 

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

        public function SearchAlldMsg($key) {
            try {
                $newkey = $this->cleanStr($key);
                $sql = "SELECT *,f.feedback_id as fid, y.level_id as fid from tbl_feedback f left join tbl_gradelevel y on y.level_id = y.level_id WHERE f.status = 'old' AND concat(
                    feedback_id,
                    fullname,
                    feedback,
                    level_id,
                    grade_level,
                    discription
                    ) LIKE '%$newkey%'";

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

        public function cleanStr($string){
            $string = str_replace("'", '-', $string);
            $string = preg_replace('/-+/', '-', $string);
            
            return $string;
        } 
    }
?>