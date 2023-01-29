<?php 

class Student extends Controller {

    public function getAllStudent() {
        try {
            $sql = "SELECT * FROM tbl_student WHERE status='active' ORDER BY student_id DESC 
            LIMIT 5"; 

            if($result = $this->runBaseSql($sql)
            ) {
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

    public function sortStudent($number) {
        try {
            $sql = "SELECT * FROM tbl_student WHERE status = 'active' ORDER BY student_id DESC 
            LIMIT " . $this->cleanStr($number); 

            if($result = $this->runBaseSql($sql)
            ) {
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

    public function paginateStudent($pagenum) {
        $num_per_page = 05;
        $start_from   = ($this->cleanStr($pagenum-1))*05;

        try {
            $sql = "SELECT * FROM tbl_student WHERE status = 'active' ORDER BY student_id DESC LIMIT $start_from, $num_per_page";    

            if($result = $this->runBaseSql($sql)
            ) {
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

    public function studentTotalPages() {
        try {
            $sql = "SELECT * FROM tbl_student WHERE status = 'active' ORDER BY student_id"; 
                           
            $result = $this->runBaseSql($sql);
            $counter = 0;

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

    public function printAllStudent() {
        try {
            $sql = "SELECT * FROM tbl_student WHERE status = 'active' ORDER BY student_id DESC ";                
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

    public function SeachStudent($key) {
        $newkey = $this->cleanStr($key);
        
        try { 
            $sql = "SELECT * FROM tbl_student WHERE status='active' AND concat(
                student_id,
                contact_no,
                student_no,
                fname,
                mname,
                lname,
                dob,gender,
                address,
                email,
                id_pass
                ) LIKE '%$newkey%' 
            ";

            if($result = $this->runBaseSql($sql)
            ) {
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

    public function addStudent($data) {
        try {
            $sql = "INSERT INTO tbl_student (id_pass, student_no, fname, mname, lname, dob, gender, address, email, contact_no, avatar, pinCode) 
            VALUES (:id_pass, :student_no, :fname, :mname, :lname, :dob, :gender, :address, :email, :contact_no, :avatar, :pinCode)";
            $paramType = ":placeholder";

            $paramValue = array(
                "id_pass"    => "Student_" . uniqid(),
                "fname"      => $this->cleanStr($data[0]),
                "mname"      => $this->cleanStr($data[1]),
                "lname"      => $this->cleanStr($data[2]),
                "student_no" => $this->cleanStr($data[3]),
                "dob"        => $this->cleanStr($data[4]),
                "address"    => $this->cleanStr($data[5]),
                "gender"     => $this->cleanStr($data[6]),
                "email"      => $data[7],
                "contact_no" => $this->cleanStr($data[8]),
                "avatar"     => $data[9],
                "pinCode"    => rand(1, 10000)
            );

            if($this->insert($sql, $paramType, $paramValue)
            ){

                $response = json_encode(array(
                    "message" => "Successfully Insert Student",
                    "status" => "success"
                ));
            } 

        } catch(Exception $e) {
            $response = json_encode(array(
                "message" => "Error: " .$e->getMessage(),
                "status"  => "error"
            ));
        }

        echo $response;
    }

    public function updateValueStudent($stdid) {
        try {
            $sql="SELECT * FROM tbl_student WHERE status=:status AND student_id=:student_id";
            $paramType = ":placeholder";
            $paramValue = array(
                "status" => 'active',
                "student_id" => $stdid
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

    public function updateStudent($data) {
        try {
            $sql = "UPDATE tbl_student SET student_no=:student_no, fname=:fname, mname=:mname, lname=:lname, dob=:dob, gender=:gender, 
            address=:address, email=:email, contact_no=:contact_no, avatar=:avatar WHERE student_id=:student_id";

            $paramType = ":placeholder";
            $paramValue = array(
                "fname"      => $this->cleanStr($data[2]),
                "mname"      => $this->cleanStr($data[3]),
                "lname"      => $this->cleanStr($data[4]),
                "student_no" => $this->cleanStr($data[5]),
                "dob"        => $this->cleanStr($data[6]),
                "address"    => $this->cleanStr($data[7]),
                "gender"     => $this->cleanStr($data[8]),
                "email"      => $data[9],
                "contact_no" => $this->cleanStr($data[10]),
                "avatar"     => $data[11],
                "student_id" => $data[0]
            );

           if($this->insert($sql, $paramType, $paramValue)
           ){
                $rsponse = json_encode(array(
                    "message" => "Successfully Update Student",
                    "status"  => "success"
                ));
           }

       } catch(Exception $e) {
           $rsponse = json_encode(array(
               "message" => "Error :" . $e->getMessage(),
               "status" => "error"
           ));
       }
       echo $rsponse;
    }

    public function deleteStudent($data) {
        try {
            foreach($data as $value) {

                $sql = "SELECT * FROM tbl_studentclass WHERE studentid =:studentid AND status='active' LIMIT 1";
                $paramType = ":placeholder";
                $paramValue = array(
                    "studentid" => $value, 
                );

                if($this->runSql($sql, $paramType, $paramValue)
                ) {
                    echo json_encode(array(
                        "message" => "Unable To Set Inactive Student Have Assign In Student Class",
                        "status" => "error"
                    ));
                    die();
                    
                } else {
                
                    $sql="UPDATE tbl_student SET status='unactive' WHERE student_id=:student_id";
                    $paramType = ":placeholder";
                    $paramValue = array(
                        "student_id" => $value,
                    );

                    if($this->update($sql, $paramType, $paramValue)
                    ){
                        $response = json_encode(array(
                            "message" => "Successfully Set Inactive Student",
                            "status" => "success"
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

    public function getAllUnactiveStudent() {
        try {
            $sql = "SELECT * FROM tbl_student WHERE status='unactive' ORDER BY student_id DESC"; 

            if($result = $this->runBaseSql($sql)
            ) {
                $response =  json_encode(array(
                    "message" => $result,
                    "status"  => "success"
                ));
            }

        } catch(Exception $e) {
            $response =  json_encode(array(
                "message" => "Error: " . $e->getMessage(),
                "status" => "error"
            ));
        }
        echo $response;
    }

    public function SeachUnactiveStudent($key) {
        $newkey = $this->cleanStr($key);
        
        try { 
            $sql = "SELECT * FROM tbl_student WHERE status='unactive' AND concat(
                student_id,
                contact_no,
                student_no,
                fname,
                mname,
                lname,
                dob,gender,
                address,
                email,
                id_pass
                ) LIKE '%$newkey%' 
            ";

            if($result = $this->runBaseSql($sql)
            ) {
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

    public function restoreStudent($data) {
        try {
            foreach($data as $value) {
                $sql="UPDATE tbl_student SET status='active' WHERE student_id=:student_id";
                $paramType = ":placeholder";
                $paramValue = array(
                    "student_id" => $value,
                );

                if($this->update($sql, $paramType, $paramValue)
                ){
                    $reponse = json_encode(array(
                        "message" => "Successfully Set Active Student",
                        "status" => "success"
                    ));
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

    public function testQrCode($code) {
        try {
            $sql = "SELECT * FROM tbl_student WHERE id_pass=:id_pass LIMIT 1";
            $paramType = ":placeholder";
            $paramValue = array(
                "id_pass" => $code, 
            );

            if($result = $this->runSql($sql, $paramType, $paramValue)) {

                $response = json_encode(array(
                    "message" => " Student Qrcode Is Valid",
                    "status" => "success"
                ));
            }  else {
                $response = json_encode(array(
                    "message" => "Invalid QrCode!",
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

    public function uploadStudentRecords($data) {

        try {
            $sql = "INSERT INTO tbl_student (id_pass, student_no, fname, mname, lname, dob, gender, address, email, contact_no, avatar, pinCode) 
            VALUES (:id_pass, :student_no, :fname, :mname, :lname, :dob, :gender, :address, :email, :contact_no, :avatar, :pinCode)";
            $paramType = ":placeholder";

            $paramValue = array(
                "id_pass"    => "Student_" . uniqid(),
                "fname"      => $this->cleanStr($data['FirstName']),
                "mname"      => $this->cleanStr($data['MiddleName']),
                "lname"      => $this->cleanStr($data['LastName']),
                "student_no" => $this->cleanStr($data['Student_No']),
                "dob"        => $this->cleanStr($data['Date_of_Birt']),
                "address"    => $this->cleanStr($data['Address']),
                "gender"     => $this->cleanStr($data['Gender']),
                "email"      => $data['Email'],
                "contact_no" => $this->cleanStr($data['Contact_Number']),
                "avatar"     => '../assets/images/account.png',
                "pinCode"    => $this->custom_hash(rand(1, 10000))
            );

            if($this->insert($sql, $paramType, $paramValue)
            ){
                $response = json_encode(array(
                    "message" => "Successfully Upload Student Record",
                    "status" => "success"
                ));
            } 

        } catch(Exception $e) {
            $response = json_encode(array(
                "message" => "Error: " .$e->getMessage(),
                "status"  => "error"
            ));
        }

        echo $response;
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
    
    public function cleanStr($string){

        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
        $string = preg_replace('/-+/', '-', $string);
        
        return $string;
    } 
} 
?>