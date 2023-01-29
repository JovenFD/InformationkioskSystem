<?php 

class AdminProfile extends Controller {

    public function getAllUser() {
        try {
            $sql = "SELECT * FROM tbl_account ORDER BY user_id";                
            
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

    public function updateAdminProfile($data) {

        $setType = 0;
         try {
            $sql = "UPDATE tbl_account SET 
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
            WHERE user_id=:user_id";

            $paramType = ":placeholder";
            $paramValue = array(
                "fname"    => $data[1],
                "mname"    => $data[2],
                "lname"    => $data[3],
                "email"    => $data[4],
                "dob"      => $data[5],
                "contact_no" => $data[6],
                "gender"     => $data[7],
                "address"    => $data[8],
                "password"   => $this->custom_hash($data[10]),
                "role_id"    => $setType,
                "avatar"     => $data[11],
                "user_id"    => $data[0]
            );

            if($this->insert($sql, $paramType, $paramValue)
            ){
                $response = json_encode(array(
                    "message" => "Successfully Update",
                    "status"  => "success"
                ));   
            }

        } catch(Exception $e) {
            $response = json_encode(array(
                "message" => "Error :" . $e->getMessage(),
                "status" => "error"
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
} 
?>