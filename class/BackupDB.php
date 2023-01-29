<?php
    class BackupDB extends Controller {

        public function tbl_feedback() {
            $tableName = 'tbl_feedback';
            try {
                $sql = "SELECT * FROM " . $tableName . "";
                $output = '';

                if($result = $this->runBaseSql($sql)
                ) {
                    foreach($result as $single_result){
                        $table_column_array = array_keys($single_result);
                        $table_value_array = array_values($single_result);

                        $output .= "\nINSERT INTO $tableName (";
                        $output .= "" . implode(", ", $table_column_array) . ") VALUES (";
                        $output .= "'" . implode("','", $table_value_array) . "');\n";
                    }
                }

                $handle = fopen('backup/'.strtoupper($tableName).' ('.date('Y-m-d').').sql',"w+");
                fwrite($handle, $output);
                fclose($handle);

                return true;

                
            } catch(Exception $e) {
                echo json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status"  => "error"
                ));
            }
        }

        public function tbl_grades() {
            $tableName = 'tbl_grades';
            try {
                $sql = "SELECT * FROM " . $tableName . "";
                $output = '';

                if($result = $this->runBaseSql($sql)
                ) {
                    foreach($result as $single_result){
                        $table_column_array = array_keys($single_result);
                        $table_value_array = array_values($single_result);

                        $output .= "\nINSERT INTO $tableName (";
                        $output .= "" . implode(", ", $table_column_array) . ") VALUES (";
                        $output .= "'" . implode("','", $table_value_array) . "');\n";
                    }
                }

                $handle = fopen('backup/'.strtoupper($tableName).' ('.date('Y-m-d').').sql',"w+");
                fwrite($handle, $output);
                fclose($handle);

                return true;
                
            } catch(Exception $e) {
                echo json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status"  => "error"
                ));
            }
        }

        public function tbl_logs() {
            $tableName = 'tbl_logs';
            try {
                $sql = "SELECT * FROM " . $tableName . "";
                $output = '';

                if($result = $this->runBaseSql($sql)
                ) {
                    foreach($result as $single_result){
                        $table_column_array = array_keys($single_result);
                        $table_value_array = array_values($single_result);

                        $output .= "\nINSERT INTO $tableName (";
                        $output .= "" . implode(", ", $table_column_array) . ") VALUES (";
                        $output .= "'" . implode("','", $table_value_array) . "');\n";
                    }
                }

                $handle = fopen('backup/'.strtoupper($tableName).' ('.date('Y-m-d').').sql',"w+");
                fwrite($handle, $output);
                fclose($handle);
                
            } catch(Exception $e) {
                echo json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status"  => "error"
                ));
            }
        }

        public function insertQuery($filename, $dataQuerList) {

            try {

                for ($i=0; $i < count($dataQuerList); $i++) { 

                    $this->runBaseSql($dataQuerList[$i]);
                }

                for ($i=0; $i < count($filename); $i++) { 
                    unlink($filename[$i]);
                }
                    
                echo json_encode(array(
                    "message" => "Successfully Restore Data",
                    "status"  => "success"
                ));
                
            } catch(Exception $e) {
                echo json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status"  => "error"
                ));
            }
        }
    }
?>