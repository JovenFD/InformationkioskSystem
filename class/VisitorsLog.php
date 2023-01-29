<?php 
class VisitorsLog extends Controller {

    public function getAllLogs() {
        try {
            $sql = "SELECT * FROM tbl_logs WHERE type='Visitors' ORDER BY logs_id DESC LIMIT 5";                
            $result = $this->runBaseSql($sql);

            $reponse = json_encode(array(
                "message" => $result,
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

    public function searchDataLogs($data) {
        try {     
            $newkey = $this->cleanStr($data);        
            $sql = "SELECT * FROM tbl_logs WHERE logs_id AND type='Visitors' AND concat(
                logs_id,
                fname,
                mname,
                lname,
                type
                ) LIKE '%$newkey%' 
            ";

            if($result = $this->runBaseSql($sql)
            ){
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

    public function limitLogPages($number) {
        try {
            $sql = "SELECT * FROM tbl_logs WHERE type='Visitors' ORDER BY logs_id DESC 
            LIMIT " . $this->cleanStr($number);                
            $result = $this->runBaseSql($sql);
            
            $response = json_encode(array(
                "message" => $result,
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

    public function logsTotalPages() {
        try {
            $sql = "SELECT * FROM tbl_logs WHERE type='Visitors'";                
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

    public function paginateLogs($pagenum) {
        $num_per_page = 05;
        $start_from   = ($this->cleanStr($pagenum-1))*05;

        try {
            $sql = "SELECT * FROM tbl_logs WHERE type='Visitors' ORDER BY logs_id DESC LIMIT $start_from, $num_per_page";                
            $result = $this->runBaseSql($sql);
            
            $response = json_encode(array(
                "message" => $result,
                "status"  => "success"
            ));

        } catch(Exception $e) {
            $response = json_encode(array(
                "message" => "Error: " . $e->getMessage(),
                "status" => "error"
            ));
        }

        echo $response;
    }

    public function trackDateLogs($date) {
        $datefrom = $date['datefrom'];
        $dateto   = $date['dateto'];
        
        try {

            $sql = "SELECT * FROM tbl_logs WHERE type='Visitors' AND DATE(created_date) BETWEEN '$datefrom' AND '$dateto'"; 

            $result = $this->runBaseSql($sql);

            $response = json_encode(array(
                "message" => $result,
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

    public function printAllLogs() {
        try {
            $sql = "SELECT * FROM tbl_logs WHERE type='Visitors' ORDER BY logs_id DESC ";                
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