<?php
    class Statitics extends Controller {

        public function studentStatistics() {
            try {
                $sql = "SELECT COUNT(*) FROM tbl_student WHERE status = 'active'";                
                $result = $this->runBaseSql($sql);
                
                $response = json_encode(array(
                    "message" => $result[0]['COUNT(*)'],
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

        public function teachersStatistics() {
            try {
                $sql = "SELECT COUNT(*) FROM tbl_teacher WHERE status = 'active'";                
                $result = $this->runBaseSql($sql);
                
                $response = json_encode(array(
                    "message" => $result[0]['COUNT(*)'],
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

        public function visitorsStatistics() {
            try {
                $sql = "SELECT COUNT(*) FROM tbl_visitors WHERE status = 'active'";                
                $result = $this->runBaseSql($sql);
                
                $response = json_encode(array(
                    "message" => $result[0]['COUNT(*)'],
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

        public function subjectsStatistics() {
            try {
                $sql = "SELECT COUNT(*) FROM tbl_subject WHERE status = 'active'";                
                $result = $this->runBaseSql($sql);
                
                $response = json_encode(array(
                    "message" => $result[0]['COUNT(*)'],
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

        public function classStatistics() {
            try {
                $sql = "SELECT COUNT(*) FROM tbl_class WHERE status = 'active'";                
                $result = $this->runBaseSql($sql);
                
                $response = json_encode(array(
                    "message" => $result[0]['COUNT(*)'],
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

        public function schoolLogsStatistics() {
            try {
                $sql = "SELECT COUNT(*) FROM tbl_logs";                
                $result = $this->runBaseSql($sql);

                $response = json_encode(array(
                    "message" => $result[0]['COUNT(*)'],
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

        public function schoolYearStatistics() {
            try {
                $sql = "SELECT COUNT(*) FROM tbl_schoolyear WHERE status = 'active'";                
                $result = $this->runBaseSql($sql);
                
                $response = json_encode(array(
                    "message" => $result[0]['COUNT(*)'],
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

        public function teacherAdvidoryStatistics() {
            try {
                $sql = "SELECT COUNT(*) FROM tbl_teacheradvisory WHERE status = 'active'";                
                $result = $this->runBaseSql($sql);
                
                $response = json_encode(array(
                    "message" => $result[0]['COUNT(*)'],
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

        public function studentClassStatistics() {
            try {
                $sql = "SELECT COUNT(*) FROM tbl_studentclass WHERE status = 'active'";                
                $result = $this->runBaseSql($sql);

                $response = json_encode(array(
                    "message" => $result[0]['COUNT(*)'],
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

        public function yearLevelStatistics() {
            try {
                $sql = "SELECT COUNT(*) FROM tbl_gradelevel WHERE status = 'active'";                
                $result = $this->runBaseSql($sql);

                $response = json_encode(array(
                    "message" => $result[0]['COUNT(*)'],
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
    }
?>