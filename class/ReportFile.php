<?php
    class ReportFile extends Controller {

        public function getAllFilesReport() {
            try {
                $sql = "SELECT * FROM tbl_folder ORDER BY folder_id ASC"; 

                if($result = $this->runBaseSql($sql)
                ) {
                    $reponse =  json_encode(array(
                        "message" => $result,
                        "status" => 'success'
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

        public function searchFolderName($key) {
            try { 
                $newkey = $this->cleanStr($key);
       
                $sql = "SELECT * FROM tbl_folder WHERE folder_id AND concat(
                    folder_id,
                    folder_name 
                    ) LIKE '%$newkey%' 
                ";
    
                if($result = $this->runBaseSql($sql)) {
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

        public function addNewFolder($data) { 
            
            try {

                $sql = "INSERT INTO tbl_folder(folder_name) 
                VALUES (:folder_name)";
                $paramType = ":placeholder";
    
                $paramValue = array(
                    "folder_name" => $data
                );
                if($this->insert($sql, $paramType, $paramValue)
                ) {
                    echo json_encode(array(
                        "message" => "Successfully Create Folder",
                        "status"  => "success"
                    ));
                } 

            } catch(Exception $e) {
                echo json_encode(array(
                    "message" => "Error :" .$e->getMessage(),
                    "status" => "error"
                ));
            }
        }

        public function addValueUpdateFolder($id) {
            try {
                $sql = "SELECT * FROM tbl_folder WHERE folder_id=:folder_id LIMIT 01";
                $paramType = ":placeholder";
                $paramValue = array(
                    "folder_id" => $id
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

        public function updateFolder($data) {
            try {
                $sql = "UPDATE tbl_folder SET 
                folder_name =:folder_name
                WHERE folder_id =:folder_id";
    
                $paramType  = ":placeholder";
                $paramValue = array(
                    "folder_id"   => $data['id'],
                    "folder_name" => $data['newfolderName']
                );
    
               if($this->insert($sql, $paramType, $paramValue)
               ) {
                    $rsponse = json_encode(array(
                        "message" => "Successfully Update Rename folder",
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

        public function removeFolder($data) {
            try {
                $sql="DELETE FROM tbl_folder WHERE folder_id=:folder_id ";
                $paramType = ":placeholder";
                $paramValue = array(
                    "folder_id" => $data,
                );

                if($this->update($sql, $paramType, $paramValue)
                ){   
                    $reponse = json_encode(array(
                        "message" => "Successfully Remove Folder",
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

        public function viewFiles($folderId) {
            try {
                $sql = "SELECT * FROM tbl_filereports WHERE folder_id='$folderId' ORDER BY folder_id ASC"; 

                if($result = $this->runBaseSql($sql)
                ) {
                    $reponse =  json_encode(array(
                        "message" => $result,
                        "status" => 'success'
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

        public function searchFileReport($key) {
            try { 
                $newkey = $this->cleanStr($key);
       
                $sql = "SELECT * FROM tbl_filereports WHERE file_id AND concat(
                    file_id,
                    filename,
                    size,
                    create_date 
                    ) LIKE '%$newkey%' 
                ";
    
                if($result = $this->runBaseSql($sql)) {
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

        public function saveUploadFile($name, $type, $size, $folderId) {
            try {

                $sql = "INSERT INTO tbl_filereports(filename, size, Type, folder_id) 
                VALUES (:filename, :size, :Type, :folder_id)";
                $paramType = ":placeholder";
    
                $paramValue = array(
                    "filename"  => $name,
                    "Type"      => $type,
                    "size"      => $this->convert_filesize($size),
                    "folder_id" => $folderId
                );
                if($this->insert($sql, $paramType, $paramValue)
                ) {
                    echo json_encode(array(
                        "message" => "Successfully Upload File",
                        "status"  => "success"
                    ));
                }

            } catch(Exception $e) {
                echo json_encode(array(
                    "message" => "Error :" .$e->getMessage(),
                    "status" => "error"
                ));
            }
        }

        public function removeReportFile($data) {
            try {
                foreach($data as $value) {
            
                    $sql="DELETE FROM tbl_filereports WHERE file_id=:file_id";
                    $paramType = ":placeholder";
                    $paramValue = array(
                        "file_id" => $value,
                    );
                    if($this->update($sql, $paramType, $paramValue)
                    ){
                        echo json_encode(array(
                            "message" => "Successfully Remove Report File",
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

        public function convert_filesize($bytes, $decimals = 2){
            $size = array('B','kB','MB','GB','TB','PB','EB','ZB','YB');
            $factor = floor((strlen($bytes) - 1) / 3);
            return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
        }

        public function cleanStr($string){
            $string = preg_replace('/-+/', '-', $string);
            
            return $string;
        } 
    }
?>