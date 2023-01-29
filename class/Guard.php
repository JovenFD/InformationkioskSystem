<?php 
class Guard extends Controller {

    public function getAllGaurd() {
        try {
            $sql = "SELECT * FROM tbl_gaurd WHERE status='Active' ORDER BY gaurd_id DESC 
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

    public function seachGuard($key) {
        $newkey = $this->cleanStr($key);

        try { 
            $sql = "SELECT * FROM tbl_gaurd WHERE status='Active' AND concat(
                gaurd_id,
                contact_no,
                fname,
                mname,
                lname,
                dob,
                gender,
                address,
                email
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

    public function addGuard($data) {
        $usertype = 2;
        try {
            $sql = "INSERT INTO tbl_gaurd (fname, mname, lname, gender, dob, email, contact_no, address, password, role_id, avatar) 
            VALUES (:fname, :mname, :lname, :gender, :dob, :email, :contact_no, :address, :password, :role_id, :avatar)";
            $paramType = ":placeholder";

            $paramValue = array(
                "fname"      => $this->cleanStr($data[0]),
                "mname"      => $this->cleanStr($data[1]),
                "lname"      => $this->cleanStr($data[2]),
                "dob"        => $this->cleanStr($data[3]),
                "address"    => $this->cleanStr($data[4]),
                "gender"     => $this->cleanStr($data[5]),
                "email"      => $data[6],
                "contact_no" => $this->cleanStr($data[7]),
                "password"   => $this->custom_hash($data[8]),
                "role_id"    => $usertype,
                "avatar"     => $data[10]
            );

            if($this->insert($sql, $paramType, $paramValue)
            ){
                $response = json_encode(array(
                    "message" => "Successfully Add Security Personel",
                    "status"  => "success"
                ));
            }
            
        } catch(Exception $e) {
            $response = json_encode(array(
                "message" => "Warning! Already Exist Security Personel" .$e->getMessage(),
                "status"  => "error"
            ));
        }
        echo $response;
    }

    public function printAllGuard() {
        try {
            $sql = "SELECT * FROM tbl_gaurd WHERE status='Active' ORDER BY gaurd_id DESC ";                
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

    public function limitGuard($number) {
        try {
            $sql = "SELECT * FROM tbl_gaurd WHERE status = 'Active' ORDER BY gaurd_id DESC 
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

    public function gaurdTotalPages() {
        try {
            $sql = "SELECT * FROM tbl_gaurd WHERE status = 'Active' ORDER BY gaurd_id";                
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

    public function paginateGuard($pagenum) {
        $num_per_page = 05;
        $start_from   = ($this->cleanStr($pagenum-1))*05;

        try {
            $sql = "SELECT * FROM tbl_gaurd WHERE status = 'Active' ORDER BY gaurd_id DESC LIMIT $start_from, $num_per_page";  

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

    public function addValueUpdateGuard($gaurdid) {
        try {
            $sql="SELECT * FROM tbl_gaurd WHERE status=:status AND gaurd_id=:gaurd_id";
            $paramType = ":placeholder";
            $paramValue = array(
                "status" => 'Active',
                "gaurd_id" => $gaurdid
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

    public function updateGuard($data) {

        $usertype = 2;
        try {
            $sql = "UPDATE tbl_gaurd SET 
            fname=:fname, 
            mname=:mname,
            lname=:lname, 
            gender=:gender,
            dob=:dob, 
            email=:email, 
            contact_no=:contact_no, 
            address=:address, 
            password=:password, 
            role_id=:role_id,
            avatar=:avatar
            WHERE gaurd_id=:gaurd_id";

            $paramType = ":placeholder";
            $paramValue = array(
                "gaurd_id" => $data[0],
                "fname"      => $this->cleanStr($data[2]),
                "mname"      => $this->cleanStr($data[3]),
                "lname"      => $this->cleanStr($data[4]),
                "dob"        => $this->cleanStr($data[5]),
                "address"    => $this->cleanStr($data[6]),
                "gender"     => $this->cleanStr($data[7]),
                "email"      => $data[8],
                "contact_no" => $this->cleanStr($data[9]),
                "password"   => $this->custom_hash($data[10]),
                "avatar"     => $data[12],
                "role_id"    => $usertype
            );

           if($this->insert($sql, $paramType, $paramValue)
           ){
                $rsponse = json_encode(array(
                    "message" => "Successfully Update Security Personel",
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

    public function removeGaurd($data) {
        try {
            foreach($data as $value) {

                $sql="UPDATE tbl_gaurd SET status='Inactive' WHERE gaurd_id=:gaurd_id";
                $paramType = ":placeholder";
                $paramValue = array(
                    "gaurd_id" => $value
                );

                if($this->update($sql, $paramType, $paramValue)
                ) {
                    $reponse = json_encode(array(
                        "message" => "Successfully Set Inactive Gaurd",
                        "status"  => "success"
                    ));
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

    public function getAllInactive() {
        try {
            $sql = "SELECT * FROM tbl_gaurd WHERE status='Inactive' ORDER BY gaurd_id DESC"; 

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

    public function removeInactGaurd($data) {
        try {
            foreach($data as $value) {

                $sql="UPDATE tbl_gaurd SET status='Active' WHERE gaurd_id=:gaurd_id";
                $paramType = ":placeholder";
                $paramValue = array(
                    "gaurd_id" => $value
                );

                if($this->update($sql, $paramType, $paramValue)
                ) {
                    $reponse = json_encode(array(
                        "message" => "Successfully Set Active Gaurd",
                        "status"  => "success"
                    ));
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

    public function searchInactGaurd($key) {
        $newkey = $this->cleanStr($key);

        try { 
            $sql = "SELECT * FROM tbl_gaurd WHERE status='Inactive' AND concat(
                gaurd_id,
                contact_no,
                fname,
                mname,
                lname,
                dob,
                gender,
                address,
                email
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

    public function guardProfile($guardId) {

        try {
            $sql = "SELECT * FROM tbl_gaurd WHERE gaurd_id =:gaurd_id  LIMIT 01";
            $paramType = ":placeholder";
            $paramValue = array(
                "gaurd_id" => $guardId
            );

            if($result = $this->runSql($sql, $paramType, $paramValue)
            ) {
                echo json_encode(array(
                    "message" => $result,
                    "status"  => "success"
                )); 
            } 

        } catch(Exception $e) {
            echo json_encode(array(
                "message" => "Error: " . $e->getMessage(),
                "status"  => "error"
            ));
        }
    }

    public function updateProfileGuard($data) {

        try {
            $sql = "UPDATE tbl_gaurd SET 
            fname=:fname, 
            mname=:mname,
            lname=:lname, 
            gender=:gender,
            dob=:dob, 
            email=:email, 
            contact_no=:contact_no, 
            address=:address, 
            password=:password, 
            avatar=:avatar
            WHERE gaurd_id=:gaurd_id";

            $paramType = ":placeholder";
            $paramValue = array(
                "gaurd_id" => $data[0],
                "fname"      => $this->cleanStr($data[2]),
                "mname"      => $this->cleanStr($data[3]),
                "lname"      => $this->cleanStr($data[4]),
                "dob"        => $this->cleanStr($data[6]),
                "address"    => $this->cleanStr($data[9]),
                "gender"     => $this->cleanStr($data[8]),
                "email"      => $data[5],
                "contact_no" => $this->cleanStr($data[7]),
                "password"   => $this->custom_hash($data[11]),
                "avatar"     => $data[12]
            );

           if($this->insert($sql, $paramType, $paramValue)
           ){
                $rsponse = json_encode(array(
                    "message" => "Successfully Update Account",
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

    public function cleanStr($string){
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
        $string = preg_replace('/-+/', '-', $string);
        
        return $string;
    } 

    public function custom_hash($str) {
        $salt  = "WOXVENHITTY";
        $md5   = md5($str . $salt);
        $sha1  = sha1($salt . $md5);
        $hash  = md5($md5 . $sha1);

        for ($i=0; $i < strlen($str); $i++) { 
            $hash = md5($hash) . sha1($hash);
        }
        $hash = strtoupper(md5($hash));

        return $hash;
    }    
}
?>