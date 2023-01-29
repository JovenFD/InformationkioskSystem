<?php 
    class HeaderVideo extends Controller {

        public function getHeaderVideo() {
            try {
                $sql = "SELECT * FROM tbl_video";

                if($result = $this->runBaseSql($sql)
                ){
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

        public function updateHeaderVideo($path) {

            try {
                $sql="UPDATE tbl_video SET filename=:filename WHERE video_id=:video_id";
                $paramType = ":placeholder";
                $paramValue = array(
                    "video_id" => 2,
                    "filename" => $path
                );

                if($this->update($sql, $paramType, $paramValue)
                ) {
                    echo json_encode(array(
                        "message" => 'Successfully Upload Video',
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
    }
?>