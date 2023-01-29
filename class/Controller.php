<?php 
    class Controller {
        private $servername = "localhost";
        private $username = "root";
        private $password = "";
        private $dbname = "db_kiosk_system";

        public function connect() {
            try {
                $pdo = new PDO('mysql:host=' . $this->servername . ';dbname=' . $this->dbname, $this->username, $this->password);
                // set the PDO error mode to exception
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                echo json_encode(array(
                    "message" => "Error: System Not Connected.",
                    "status" => "error"
                ));
                die();
            }
            return $pdo;
        }

        // binding methods
        public function bindParams($stmt, $paramType, $paramValue) {
            foreach ($paramValue as $key => $val){
                $stmt->bindParam($paramType, $val); 
            }
            return $stmt;
        }

        public function runBaseSql($sql) {
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $resultset[] = $row;
            }
            
            if(!empty($resultset)) {
                return $resultset;
            }
            if($stmt) {
                return true;
            }
                return false;
        }
        
        public function runSql($sql, $paramType, $paramValue) {
            $stmt = $this->connect()->prepare($sql);
            $this->bindParams($stmt, $paramType, $paramValue);
            $stmt->execute($paramValue);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result;
        }

        public function insert($sql, $paramType, $paramValue) {
            $stmt = $this->connect()->prepare($sql);
            $this->bindParams($stmt, $paramType, $paramValue);
            if($stmt->execute($paramValue)) {
                return true;
            } else {
                return false;
            }
        }

        public function update($sql, $paramType, $paramValue) {
            $stmt = $this->connect()->prepare($sql);
            $this->bindParams($stmt, $paramType, $paramValue);
            if($stmt->execute($paramValue)) {
                return true;
            } else {
                return false;
            }
        }
    }
?>