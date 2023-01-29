<?php 

class Visitors extends Controller {

    public function getAllVisitors() {
        try {
            $sql = "SELECT * FROM tbl_visitors WHERE status='active' ORDER BY visitors_id DESC 
            LIMIT 5";                
            
            if($result = $this->runBaseSql($sql)
            ){
                $response =  json_encode(array(
                    "message" => $result,
                    "status"  => "success"
                ));
            }
        
        } catch(Exception $e) {
            $response =  json_encode(array(
                "message" => "Error: " . $e->getMessage(),
                "status"  => "error"
            ));
        }
        echo $response;
    }

    public function resetTableData() {
        try {
            $sql = "SELECT date(now())";                
            
            if($result = $this->runBaseSql($sql)
            ){
                $dateNow = date('d', strtotime($result[0]['date(now())']));

                $sql = "SELECT * FROM tbl_visitors WHERE status='active'";                
                
                if($result = $this->runBaseSql($sql)
                ){
                    if (is_array($result) || is_object($result)
                    ) { 
                        foreach ($result as $row) {
                            $addDate = date('d', strtotime($row['create_date']));
                            
                            if($addDate > $dateNow) {
                                $sql = "DELETE FROM tbl_visitors WHERE visitors_id=:visitors_id";                
                                $paramType = ":placeholder";
                                $paramValue = array(
                                    "visitors_id" => $row['visitors_id']
                                );
                
                                if($result = $this->runSql($sql, $paramType, $paramValue)
                                ) {
                                    echo json_encode(array(
                                        "message" => 'Remove '.$row['visitors_id'],
                                        "status"  => "reset"
                                    ));
                                }
                            }
                        }
                    }
                    echo json_encode(array(
                        "message" => 'Running reset query',
                        "status"  => "success"
                    ));
                }
            }
        
        } catch(Exception $e) {
            echo json_encode(array(
                "message" => "Error: " . $e->getMessage(),
                "status"  => "error"
            ));
        }
    }

    public function SeachVisitors($key) {
        try { 
            $newkey = $this->cleanStr($key);
   
            $sql = "SELECT * FROM tbl_visitors WHERE status='active' AND concat(
                visitors_id,
                contactno,
                fname,
                mname,
                lname,
                dob,
                gender,
                address,
                id_pass
                ) LIKE '%$newkey%' 
            ";

            if($result = $this->runBaseSql($sql)
            ){
                $response =  json_encode(array(
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

    public function insertVisitors($data) {
        try {
            $sql = "INSERT INTO tbl_visitors (fname, mname, lname, gender, dob, address, contactno, porpose, id_pass) 
            VALUES (:fname, :mname, :lname, :gender, :dob, :address, :contactno, :porpose, :id_pass)";
            $paramType = ":placeholder";

            if(isset($data[10]) && $data[10]=='type_admin') {
                unset($data[10]);
                $paramValue = array(
                    "fname"  => $this->cleanStr($data[0]),
                    "mname"  => $this->cleanStr($data[1]),
                    "lname"  => $this->cleanStr($data[2]),
                    "dob"    => $this->cleanStr($data[3]),
                    "contactno" => $this->cleanStr($data[4]),
                    "gender"    => $this->cleanStr($data[5]),
                    "address"   => $this->cleanStr($data[7]),
                    "porpose"   => $this->cleanStr($data[8]),
                    "id_pass"   => $data[9]
                );
                    if($this->insert($sql, $paramType, $paramValue)) {
                        echo json_encode(array(
                            "message" => "Successfully Sign Up Visitor",
                            "status"  => "success"
                        ));
                        die();
                    }
            } else {
                $paramValue = array(
                    "id_pass"=> $data[0],
                    "fname"  => $this->cleanStr($data[1]),
                    "mname"  => $this->cleanStr($data[2]),
                    "lname"  => $this->cleanStr($data[3]),
                    "dob"    => $this->cleanStr($data[4]),
                    "contactno" => $this->cleanStr($data[5]),
                    "gender"    => $this->cleanStr($data[6]),
                    "address"   => $this->cleanStr($data[7]),
                    "porpose"   => $this->cleanStr($data[8])
                );
                
                if($this->insert($sql, $paramType, $paramValue)
                ) {
                    echo json_encode(array(
                        "message" => "Successfully Sign Up Visitor",
                        "status"  => "success"
                    ));
                    die();
                }
            }
            
        } catch(Exception $e) {
            echo json_encode(array(
                "message" => "Error :" .$e->getMessage(),
                "status" => "error"
            ));
        }
    }

    public function removeVisitors($data) {
        try {
            foreach($data as $value) {

                $sql="UPDATE tbl_visitors SET status='unactive' WHERE visitors_id=:visitors_id";
                $paramType = ":placeholder";
                $paramValue = array(
                    "visitors_id" => $value,
                );
                $this->update($sql, $paramType, $paramValue);
            }
                
            $reponse = json_encode(array(
                "message" => "Successfully Set Inacctive Visitor",
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

    public function printAllVisitors() {
        try {
            $sql = "SELECT * FROM tbl_visitors WHERE status='active' ORDER BY visitors_id DESC ";                
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

    public function sortVisitors($number) {
        try {
            $sql = "SELECT * FROM tbl_visitors WHERE status = 'active' ORDER BY visitors_id DESC 
            LIMIT " . $this->cleanStr($number);

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

    public function visitorstotalPages() {
        try {
            $sql = "SELECT COUNT(*) FROM tbl_visitors WHERE status = 'active' ORDER BY visitors_id";                
            $result = $this->runBaseSql($sql);

            $response = json_encode(array(
                "message" => $result[0]['COUNT(*)'],
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

    public function paginateVisitors($pagenum) {
        $num_per_page = 05;
        $start_from   = ($this->cleanStr($pagenum-1))*05;

        try {
            $sql = "SELECT * FROM tbl_visitors WHERE status = 'active' ORDER BY visitors_id DESC LIMIT $start_from, $num_per_page";

            if($result = $this->runBaseSql($sql)
            ){
                $response =  json_encode(array(
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

    public function getAllUnactVisitors() {
        try {
            $sql = "SELECT * FROM tbl_visitors WHERE status='unactive' ORDER BY visitors_id DESC 
            ";                
            
            if($result = $this->runBaseSql($sql)
            ){
                $response =  json_encode(array(
                    "message" => $result,
                    "status"  => "success"
                ));
            }
        
        } catch(Exception $e) {
            $response =  json_encode(array(
                "message" => "Error: " . $e->getMessage(),
                "status"  => "error"
            ));
        }
        echo $response;
    }

    public function SeachUnactVisitors($key) {
        try { 
            $newkey = $this->cleanStr($key);
   
            $sql = "SELECT * FROM tbl_visitors WHERE status='unactive' AND concat(
                visitors_id,
                contactno,
                fname,
                mname,
                lname,
                dob,
                gender,
                address,
                id_pass
                ) LIKE '%$newkey%' 
            ";

            if($result = $this->runBaseSql($sql)
            ){
                $response =  json_encode(array(
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

    public function removeUnactVisitors($data) {
        try {
            foreach($data as $value) {

                $sql="UPDATE tbl_visitors SET status='active' WHERE visitors_id=:visitors_id";
                $paramType = ":placeholder";
                $paramValue = array(
                    "visitors_id" => $value,
                );
                $this->update($sql, $paramType, $paramValue);
            }
                
            $reponse = json_encode(array(
                "message" => "Successfully Set Active Visitor",
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

    public function testQrCode($code) {
        try {
            $sql = "SELECT * FROM tbl_visitors WHERE id_pass=:id_pass LIMIT 1";
            $paramType = ":placeholder";
            $paramValue = array(
                "id_pass" => $code, 
            );

            if($this->runSql($sql, $paramType, $paramValue)) {

                $response = json_encode(array(
                    "message" => "Visitor Qrcode Is Valid",
                    "status"  => "success"
                ));
            }  else {
                $response = json_encode(array(
                    "message" => "Invalid QrCode",
                    "status"  => "error"
                ));
            }

        } catch(Exception $e) {
            $response =  json_encode(array(
                "message" => "Error: " . $e->getMessage(),
                "status" => "er ror"
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