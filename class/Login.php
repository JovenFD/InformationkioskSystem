<?php 
    class Login extends Controller {
        public $email;
        public $password;
        public $role;

        public function __construct($email, $password) {
            $this->email = $email;
            $this->password = $password;
        }

        public function checkAdmin() {
            try {
                $sql = "SELECT * FROM tbl_account WHERE email=:email 
                AND password=:password LIMIT 1";
                $paramType = ":placeholder";
                $paramValue = array(
                    "email" => $this->email, 
                    "password" => $this->custom_hash($this->password)
                );

                if($result = $this->runSql($sql, $paramType, $paramValue)
                ) {
                    return $result['role_id'];
                } 

            } catch(Exception $e) {
                echo json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status"  => "error"
                ));
            }
        }

        public function checkTeacher() {
            try {

                $sql = "SELECT * FROM tbl_teacher WHERE email=:email 
                AND password=:password LIMIT 1";
                $paramType = ":placeholder";
                $paramValue = array(
                    "email" => $this->email, 
                    "password" => $this->custom_hash($this->password)
                );

                if($result = $this->runSql($sql, $paramType, $paramValue)
                ) {
                    return $result['role_id'];
                }

            } catch(Exception $e) {
                echo json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status"  => "error"
                ));
            }
        }

        public function checkGuard() {
            try {

                $sql = "SELECT * FROM tbl_gaurd WHERE email=:email 
                AND password=:password LIMIT 1";
                $paramType = ":placeholder";
                $paramValue = array(
                    "email" => $this->email, 
                    "password" => $this->custom_hash($this->password)
                );

                if($result = $this->runSql($sql, $paramType, $paramValue)
                ) {
                    return $result['role_id'];
                }

            } catch(Exception $e) {
                echo json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status"  => "error"
                ));
            }
        }

        public function setLogin() {
            //Admin Login
            if($this->checkAdmin() == 0) {
                try {
                    $sql = "SELECT * FROM tbl_account WHERE email=:email AND password=:password LIMIT 1";
                    $paramType = ":placeholder";
                    $paramValue = array(
                        "email" => $this->email, 
                        "password" => $this->custom_hash($this->password)
                    );
        
                    if($result = $this->runSql($sql, $paramType, $paramValue)
                    ) {
                        $_SESSION['logged_in'] = true;
                        $_SESSION['admin'] = serialize($result['fname'].' '.strtoupper(substr($result['mname'], 0 , 1)).', ' .$result['lname']);
                        $_SESSION['avatar_admin'] = serialize($result['avatar']);

                        echo json_encode(array(
                            "message" => "Successfully logged in.",
                            "status"  => "success_admin"
                        ));
                        die();
                    }

                    $response = json_encode(array(
                        "message" => "Invalid Username Or Password.",
                        "status" => "error"
                    )); 
            
                } catch(Exception $e) {
                    echo json_encode(array(
                        "message" => "Error: " . $e->getMessage(),
                        "status"  => "error"
                    ));
                }
            }

            //Teacher Login
            if($this->checkTeacher() == 1) {
                try {
                    $sql = "SELECT * FROM tbl_teacher WHERE email=:email AND password=:password LIMIT 1";
                    $paramType = ":placeholder";
                    $paramValue = array(
                        "email" => $this->email, 
                        "password" => $this->custom_hash($this->password)
                    );
        
                    if($result = $this->runSql($sql, $paramType, $paramValue)
                    ) {
                        $_SESSION['logged_in'] = true;
                        $_SESSION['user'] = serialize($result['fname']);
                        $_SESSION['email'] = serialize($result['email']);
                        $_SESSION['avatar_user'] = serialize($result['avatar']);
                        $_SESSION['userid'] = $result['teacher_id'];
                            
                        echo json_encode(array(
                            "message" => "Successfully logged in.",
                            "status"  => "success_user"
                        ));
                        die();
                    }

                    $response = json_encode(array(
                        "message" => "Invalid Username Or Password.",
                        "status" => "error"
                    )); 
            
                } catch(Exception $e) {
                    echo json_encode(array(
                        "message" => "Error: " . $e->getMessage(),
                        "status"  => "error"
                    ));
                }
            }

            //Guard Login
            if($this->checkGuard() == 2) {
                try {
                    $sql = "SELECT * FROM tbl_gaurd WHERE email=:email AND password=:password LIMIT 1";
                    $paramType = ":placeholder";
                    $paramValue = array(
                        "email" => $this->email, 
                        "password" => $this->custom_hash($this->password)
                    );
        
                    if($result = $this->runSql($sql, $paramType, $paramValue)
                    ) {
                        $_SESSION['logged_in'] = true;
                        $_SESSION['guard'] = serialize($result['fname']);
                        $_SESSION['email'] = serialize($result['email']);
                        $_SESSION['avatar_guard'] = serialize($result['avatar']);

                        $_SESSION['guardid'] = $result['gaurd_id'];
                            
                        echo json_encode(array(
                            "message" => "Successfully logged in.",
                            "status"  => "success_guard"
                        ));
                        die();
                    }

                    $response = json_encode(array(
                        "message" => "Invalid Username Or Password.",
                        "status" => "error"
                    )); 
            
                } catch(Exception $e) {
                    echo json_encode(array(
                        "message" => "Error: " . $e->getMessage(),
                        "status"  => "error"
                    ));
                }
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