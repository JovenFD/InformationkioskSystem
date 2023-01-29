<?php 

class Teacher extends Controller {

    public function getAllTeacher() {
        try {
            $sql = "SELECT * FROM tbl_teacher WHERE status='active' ORDER BY teacher_id DESC 
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

    public function SeachTeacher($key) {
        $newkey = $this->cleanStr($key);

        try { 
            $sql = "SELECT * FROM tbl_teacher WHERE status='active' AND concat(
                teacher_id,
                contact_no,
                fname,
                mname,
                lname,
                dob,
                gender,
                address,
                email,
                id_pass
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

    public function sortTeacher($number) {
        try {
            $sql = "SELECT * FROM tbl_teacher WHERE status = 'active' ORDER BY teacher_id DESC 
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

    public function teacherTotalPages() {
        try {
            $sql = "SELECT * FROM tbl_teacher WHERE status = 'active' ORDER BY teacher_id";                
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

    public function paginateTeacher($pagenum) {
        $num_per_page = 05;
        $start_from   = ($this->cleanStr($pagenum-1))*05;

        try {
            $sql = "SELECT * FROM tbl_teacher WHERE status = 'active' ORDER BY teacher_id DESC LIMIT $start_from, $num_per_page";  

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

    public function removeTeacher($data) {
        try {
            foreach($data as $value) {

                $sql = "SELECT * FROM tbl_teacheradvisory WHERE teacherid =:teacherid  AND status='active' LIMIT 1";
                $paramType  = ":placeholder";
                $paramValue = array(
                    "teacherid" => $value, 
                );

                if($this->runSql($sql, $paramType, $paramValue)
                ) {
                    echo json_encode(array(
                    "message" => "Unable To Set Inactive Teacher Have Assign In Teacher Advisory",
                        "status" => "error"
                    ));
                    die();
                    
                } else {

                    $sql="UPDATE tbl_teacher SET status='unactive' WHERE teacher_id=:teacher_id";
                    $paramType = ":placeholder";
                    $paramValue = array(
                        "teacher_id" => $value
                    );
                    if($this->update($sql, $paramType, $paramValue)
                    ) {
                        $reponse = json_encode(array(
                            "message" => "Successfully Set Inactive Teacher",
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

    public function printAllTeacher() {
        try {
            $sql = "SELECT * FROM tbl_teacher WHERE status='active' ORDER BY teacher_id DESC ";                
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

    public function addTeacher($data) {
        $usertype = 1;
        try {
            $sql = "INSERT INTO tbl_teacher (fname, mname, lname, gender, dob, email, contact_no, address, id_pass, password, role_id, avatar) 
            VALUES (:fname, :mname, :lname, :gender, :dob, :email, :contact_no, :address, :id_pass, :password, :role_id, :avatar)";
            $paramType = ":placeholder";

            $paramValue = array(
                "id_pass"    => "Teacher_" . uniqid(),
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
                    "message" => "Successfully Insert Teacher",
                    "status"  => "success"
                ));
            }
            
        } catch(Exception $e) {
            $response = json_encode(array(
                "message" => "Warning! Already exist Teacher" .$e->getMessage(),
                "status"  => "error"
            ));
        }
        echo $response;
    }

    public function updateValueTeacher($stdid) {
        try {
            $sql="SELECT * FROM tbl_teacher WHERE status=:status AND teacher_id=:teacher_id";
            $paramType = ":placeholder";
            $paramValue = array(
                "status" => 'active',
                "teacher_id" => $stdid
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

    public function updateTeacher($data) {
        $usertype = 1;
        try {
            $sql = "UPDATE tbl_teacher SET 
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
            WHERE teacher_id=:teacher_id";

            $paramType = ":placeholder";
            $paramValue = array(
                "teacher_id" => $data[1],
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
                    "message" => "Successfully Update Teacher",
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

    public function getAllUnactTeacher() {
        try {
            $sql = "SELECT * FROM tbl_teacher WHERE status='unactive' ORDER BY teacher_id DESC"; 

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

    public function SeachUnactTeacher($key) {
        $newkey = $this->cleanStr($key);

        try { 
            $sql = "SELECT * FROM tbl_teacher WHERE status='unactive' AND concat(
                teacher_id,
                contact_no,
                fname,
                mname,
                lname,
                dob,
                gender,
                address,
                email,
                id_pass
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

    public function removeUnactTeacher($data) {
        try {
            foreach($data as $value) {

                $sql="UPDATE tbl_teacher SET status='active' WHERE teacher_id=:teacher_id";
                $paramType = ":placeholder";
                $paramValue = array(
                    "teacher_id" => $value,
                );
                $this->update($sql, $paramType, $paramValue);
            }
                
            $reponse = json_encode(array(
                "message" => "Successfully Set Active Teacher",
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

    public function testQrCode($code) {
        try {
            $sql = "SELECT * FROM tbl_teacher WHERE id_pass=:id_pass LIMIT 1";
            $paramType = ":placeholder";
            $paramValue = array(
                "id_pass" => $code, 
            );

            if($result = $this->runSql($sql, $paramType, $paramValue)) {

                $response = json_encode(array(
                    "message" => "Teacher Qrcode Is Valid",
                    "status"  => "success"
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
                "status" => "error"
            ));
        }
        echo $response;
    }

    public function uploadTeacherRecords($data) {

        $usertype = 1;
        try {
            $sql = "INSERT INTO tbl_teacher (fname, mname, lname, gender, dob, email, contact_no, address, id_pass, password, role_id, avatar) 
            VALUES (:fname, :mname, :lname, :gender, :dob, :email, :contact_no, :address, :id_pass, :password, :role_id, :avatar)";
            $paramType = ":placeholder";

            $paramValue = array(
                "id_pass"    => "Teacher_" . uniqid(),
                "fname"      => $this->cleanStr($data['FirstName']),
                "mname"      => $this->cleanStr($data['MiddleName']),
                "lname"      => $this->cleanStr($data['LastName']),
                "dob"        => $this->cleanStr($data['Date_of_Birt']),
                "address"    => $this->cleanStr($data['Address']),
                "gender"     => $this->cleanStr($data['Gender']),
                "email"      => $data['Email'],
                "contact_no" => $this->cleanStr($data['Contact_Number']),
                "password"   => $this->custom_hash($data['Password']),
                "role_id"    => $usertype,
                "avatar"     => '../assets/images/account.png'
            );

            if($this->insert($sql, $paramType, $paramValue)
            ){
                $response = json_encode(array(
                    "message" => "Successfully Upload Teacher Record",
                    "status"  => "success"
                ));
            }
            
        } catch(Exception $e) {
            $response = json_encode(array(
                "message" => "Warning! Already Exist Teacher" .$e->getMessage(),
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