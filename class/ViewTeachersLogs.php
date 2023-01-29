<?php 
    class ViewTeachersLogs extends Controller {


        public function getAllViewTeachersLogs() {

            try {   
                $sql = "SELECT * FROM tbl_logs WHERE type='Teacher' AND DATE(created_date) = date(now()) ORDER BY logs_id DESC LIMIT 0,5";

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

        public function searchViewTeachersLogs($data) {

            try { 
                $newkey = $this->cleanStr($data);

                $sql = "SELECT * FROM tbl_logs WHERE type='Teacher' AND DATE(created_date) = date(now()) AND CONCAT(
                    logs_id,
                    fname,
                    mname,
                    lname 
                    ) LIKE '%$newkey%' 
                    ORDER BY logs_id DESC
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

        public function totalViewTeachersLogs() {
            try {
                $sql = "SELECT * FROM tbl_logs WHERE type='Teacher' AND DATE(created_date) = date(now()) ORDER BY logs_id DESC LIMIT 0,5";

                $result = $this->runBaseSql($sql);
                $counter = 0;
    
                if (is_array($result) || is_object($result)
                ) { 
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

        public function paginateVeiwTeacherLogs($pagenum) {
            $num_per_page = 05;
            $start_from   = ($this->cleanStr($pagenum-1))*05;
    
            try {
                $sql = "SELECT * FROM tbl_logs WHERE type='Teacher' AND DATE(created_date) = date(now()) ORDER BY logs_id DESC LIMIT $start_from, $num_per_page"; 

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

        public function cleanStr($string){
            $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
            $string = preg_replace('/-+/', '-', $string);
            
            return $string;
        } 
    }
?>