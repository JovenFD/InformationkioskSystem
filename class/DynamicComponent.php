<?php 
    class DynamicComponent extends Controller {

        public function getLogoBar() {
            try {
                $sql = "SELECT * FROM tbl_logo WHERE position='left' LIMIT 1";                
                
                if($result = $this->runBaseSql($sql)    
                ) {
                    return $result;
                }
                
            } catch(Exception $e) {
                $response =  json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status"  => "error"
                ));
            }
            echo $response;
        }

        public function getRightLandingPageLogo() {
            try {
                $sql = "SELECT * FROM tbl_logo WHERE position='right' LIMIT 1";                
                
                if($result = $this->runBaseSql($sql)    
                ) {
                    return $result;
                }
                
            } catch(Exception $e) {
                $reponse =  json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status"  => "error"
                ));
            }
            echo $reponse;
        }

        public function getAllLandingTableTittle() {
            try {
                $sql = "SELECT * FROM tbl_tabletitle LIMIT 1";                
                
                if($result = $this->runBaseSql($sql)    
                ) {
                    return $result;
                }
                
            } catch(Exception $e) {
                $reponse =  json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status"  => "error"
                ));
            }
            echo $reponse;
        }

        public function getLeftLogo() {
            try {
                $sql = "SELECT * FROM tbl_logo WHERE position='left' LIMIT 1";                
                
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

        public function getRightLogo() {
            try {
                $sql = "SELECT * FROM tbl_logo WHERE position='right' LIMIT 1";                
                
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

        public function getAllTableTittle() {
            try {
                $sql = "SELECT * FROM tbl_tabletitle LIMIT 1";                
                
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

        public function getAllTittle() {
            try {
                $sql = "SELECT * FROM tbl_title LIMIT 1";                
                
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

        public function getAllSlideShow() {
            try {
                $sql = "SELECT * FROM tbl_slidehow ORDER BY slidehow_id ASC";                
                
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

        public function getAllSlider() {
            try {
                $sql = "SELECT * FROM tbl_slidehow ORDER BY slidehow_id DESC LIMIT 5";                
                
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

        public function addSlider($img) {            
            try {
                $sql = "INSERT INTO tbl_slidehow(slidehow_img) 
                VALUES (:slidehow_img)";
                $paramType = ":placeholder";
    
                $paramValue = array(
                    "slidehow_img" => './uploads/'.$img,
                );
                if($this->insert($sql, $paramType, $paramValue)
                ) {
                    echo json_encode(array(
                        "message" => "Successfully Upload Image",
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

        public function removeSlider($data) {
            try {
                foreach($data as $value) {
    
                    $sql="DELETE FROM tbl_slidehow WHERE slidehow_id=:slidehow_id";
                    $paramType = ":placeholder";
                    $paramValue = array(
                        "slidehow_id" => $value,
                    );
                    $this->update($sql, $paramType, $paramValue);
                }
                    
                $reponse = json_encode(array(
                    "message" => "Successfully Remove Image",
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

        public function sortSlider($pagenum) {
            try {
                $sql = "SELECT * FROM tbl_slidehow ORDER BY slidehow_id DESC LIMIT ".$this->cleanStr($pagenum);                
                
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

        public function totalPagesSlider() {
            try {
                $sql = "SELECT * FROM tbl_slidehow";                
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
                    "status"  => "error"
                ));
            }
            echo $response;
        }

        public function paginateSlider($pagenum) {
            $num_per_page = 05;
            $start_from   = ($this->cleanStr($pagenum-1))*05;
    
            try {
                $sql = "SELECT * FROM tbl_slidehow ORDER BY slidehow_id DESC LIMIT $start_from, $num_per_page";   

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

        public function updateSlider($data) {
            try {
                $sql = "UPDATE tbl_slidehow SET slidehow_img=:slidehow_img 
                WHERE slidehow_id =:slidehow_id";
    
                $paramType = ":placeholder";
                $paramValue = array(
                    "slidehow_id"   => $data[0],
                    "slidehow_img"  => $data[1]
                );
    
               if($this->insert($sql, $paramType, $paramValue)
               ){
                    $rsponse = json_encode(array(
                        "message" => "Successfully Update Image",
                        "status"  => "success"
                    ));
               }
    
           } catch(Exception $e) {
               $rsponse = json_encode(array(
                   "message" => "Error: " . $e->getMessage(),
                   "status" => "error"
               ));
           }
           echo $rsponse;
        }

        public function uploadLogoLeft($fileL, $idLeft) {
            
            try {
                $sql = "UPDATE tbl_logo SET logo_img=:logo_img, position=:position
                WHERE logo_id =:logo_id";
    
                $paramType = ":placeholder";
                $paramValue = array(
                    "logo_id"  => $idLeft,
                    "logo_img" => $fileL,
                    "position" => 'left'
                );
    
                if($result = $this->insert($sql, $paramType, $paramValue)
                ){
                    return $result;
                } 

           } catch(Exception $e) {
                echo json_encode(array(
                   "message" => "Error: " . $e->getMessage(),
                   "status" => "error"
               ));
           }
        }

        public function uploadRightLogo($fileR, $idRigth) {
            
            try {
                $sql = "UPDATE tbl_logo SET logo_img=:logo_img, position=:position
                WHERE logo_id =:logo_id";
    
                $paramType = ":placeholder";
                $paramValue = array(
                    "logo_id"  => $idRigth,
                    "logo_img" => $fileR,
                    "position" => 'right'
                );
                
                if($result = $this->insert($sql, $paramType, $paramValue)
                ){
                    return $result;
                } 
    
           } catch(Exception $e) {
                echo json_encode(array(
                   "message" => "Error: " . $e->getMessage(),
                   "status" => "error"
               ));
           }
        }

        public function updateTitle($id, $title) {
            
            try {
                $sql = "UPDATE tbl_title SET title=:title
                WHERE title_id =:title_id";
    
                $paramType = ":placeholder";
                $paramValue = array(
                    "title_id"  => $id,
                    "title" => $title,
                );
                
                if($this->insert($sql, $paramType, $paramValue)
                ){
                    echo json_encode(array(
                        "message" => "Successfully Save Title",
                        "status" => "success"
                    ));
                }
    
           } catch(Exception $e) {
                echo json_encode(array(
                   "message" => "Error: " . $e->getMessage(),
                   "status" => "error"
               ));
           }
        }

        public function updateTableTitle($id, $tableTitle, $region, $division) {
            
            try {
                $sql = "UPDATE tbl_tabletitle SET tabletitle=:tabletitle, region=:region,division=:division WHERE title_id =:title_id";
                $paramType = ":placeholder";
                
                $paramValue = array(
                    "tabletitle"=> $tableTitle,
                    "region"    => $region,
                    "division"  => $division,
                    "title_id"  => $id
                );
                
                if($this->insert($sql, $paramType, $paramValue)
                ){
                    echo json_encode(array(
                        "message" => "Successfully Save Table Title",
                        "status" => "success"
                    ));
                }
    
           } catch(Exception $e) {
                echo json_encode(array(
                   "message" => "Error: " . $e->getMessage(),
                   "status" => "error"
               ));
           }
        }

        public function getAllNews() {
            try {
                $sql = "SELECT * FROM tbl_news ORDER BY news_id  DESC";                
                
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

        public function SeachNews($key) {
            try { 
                $newkey = $this->cleanStr($key);
    
                $sql = "SELECT * FROM tbl_news WHERE news_id AND concat(
                    news_id,
                    title,
                    summary,
                    text
                    ) LIKE '%$newkey%'";

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

        public function insertNews($data) {         
            try {
                $sql = "INSERT INTO tbl_news(title, summary, text, newspic) 
                VALUES (:title, :summary, :text, :newspic)";
                $paramType = ":placeholder";
    
                $paramValue = array(
                    "title"   => $data[0],
                    "summary" => $data[1],
                    "text"    => $data[2],
                    "newspic" => $data[3],
                );
                if($this->insert($sql, $paramType, $paramValue)
                ) {
                    $response = json_encode(array(
                        "message" => "Successfully Add News",
                        "status"  => "success"
                    ));
                } 
                
            } catch(Exception $e) {
                $response = json_encode(array(
                    "message" => "Error :" .$e->getMessage(),
                    "status" => "error"
                ));
            }
            echo $response;
        }

        public function removeNews($data) {
            try {
                foreach($data as $value) {
    
                    $sql="DELETE FROM tbl_news WHERE news_id=:news_id";
                    $paramType = ":placeholder";
                    $paramValue = array(
                        "news_id" => $value,
                    );
                    $this->update($sql, $paramType, $paramValue);
                }
                    
                $reponse = json_encode(array(
                    "message" => "Successfully Remove News",
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

        public function sortNews($pagenum) {
            try {
                $sql = "SELECT * FROM tbl_news ORDER BY news_id DESC LIMIT ".$this->cleanStr($pagenum);                
                
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

        public function newsTotalPages() {
            try {
                $sql = "SELECT * FROM tbl_news ORDER BY news_id";                
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
                    "status"  => "error"
                ));
            }
            echo $response;
        }

        public function paginateNews($pagenum) {
            $num_per_page = 05;
            $start_from   = ($this->cleanStr($pagenum-1))*05;
    
            try {
                $sql = "SELECT * FROM tbl_news ORDER BY news_id DESC LIMIT $start_from, $num_per_page";   

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

        public function updateNews($data) {
            try {
                $sql = "UPDATE tbl_news SET title=:title,
                summary=:summary, text=:text, newspic=:newspic
                WHERE news_id=:news_id";
    
                $paramType = ":placeholder";
                $paramValue = array(
                    "news_id" => $data[0],
                    "title"   => $data[2],
                    "summary" => $data[3],
                    "text"    => $data[4],
                    "newspic" => $data[5]
                );
    
               if($this->insert($sql, $paramType, $paramValue)
               ){
                    $rsponse = json_encode(array(
                        "message" => "Successfully Update News",
                        "status"  => "success"
                    ));
               }
    
           } catch(Exception $e) {
               $rsponse = json_encode(array(
                   "message" => "Error: " . $e->getMessage(),
                   "status" => "error"
               ));
           }
           echo $rsponse;
        }

        public function getNewsNumRows() {
            try {
                $sql = "SELECT * FROM tbl_news ORDER BY news_id  DESC";                
                
                if($result = $this->runBaseSql($sql)    
                ) {
                    return $result;
                }
                
            } catch(Exception $e) {
                return $e->getMessage();
            }
        }

        public function getShowLandingPageNews($pagenum) {
            try {
                $num_per_page = 02;
                $start_from   = ($pagenum-1) * 02;
        
                $sql = "SELECT * FROM tbl_news ORDER BY news_id DESC LIMIT $start_from,$num_per_page";  
                
                if($result = $this->runBaseSql($sql)    
                ) {
                    return $result;
                }
                
            } catch(Exception $e) {
                return $e->getMessage();
            }
        }

        public function addValueUpdate($newsId) {
            try {
                $sql = "SELECT * FROM tbl_news WHERE news_id=:news_id 
                LIMIT 1";
                $paramType = ":placeholder";
                $paramValue = array(
                    "news_id" => $newsId
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
                    "status" => "er ror"
                ));
            }
        }

        public function getDepedLeader() {
            try {
                $sql = "SELECT * FROM tbl_organization";                
                
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

        public function addValueUModal($numpos) {
            try {

                $sql = "SELECT * FROM tbl_organization WHERE position=:position";
                $paramType = ":placeholder";
                $paramValue = array(
                    "position" => $numpos, 
                );

                if($result = $this->runSql($sql, $paramType, $paramValue)) {
                    $response =  json_encode(array(
                        "message" => $result,
                        "status"  => "success"
                    ));
                } 

            } catch(Exception $e) {
                $response = json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status" => "er ror"
                ));
            }
            echo $response;
        }

        public function updateDepedLeaders($data) {

            try {
                $sql = "UPDATE tbl_organization SET fname=:fname, mname=:mname, lname=:lname, role=:role, avatar=:avatar WHERE organization_id=:organization_id";
    
                $paramType = ":placeholder";
                $paramValue = array(
                    "organization_id" => $data[0],
                    "fname"    => $data[2],
                    "mname"    => $data[3],
                    "lname"    => $data[4],
                    "role" => $data[5],
                    "avatar"   => $data[6]
                );
    
               if($this->update($sql, $paramType, $paramValue)
               ){
                    $rsponse = json_encode(array(
                        "message" => "Successfully Update DepEd Leader",
                        "status"  => "success"
                    ));
               }
    
           } catch(Exception $e) {
               $rsponse = json_encode(array(
                   "message" => "Error: " . $e->getMessage(),
                   "status" => "error"
               ));
           }
           echo $rsponse;
        }

        public function getAllEvents() {
            try {
                $sql = "SELECT * FROM tbl_events WHERE evenst_id=evenst_id";                
                
                if($result = $this->runBaseSql($sql)    
                ) {
                    foreach($result as $event) {
                        $start = explode(" ", $event['start']);
                        $end = explode(" ", $event['end']);

                        if($start[1] == '00:00:00') {
                            $start = $start[0];
                        }else{
                            $start = $event['start'];
                        }

                        if($end[1] == '00:00:00'){
                            $end = $end[0];
                        }else{
                            $end = $event['end'];
                        }

                        $data[] = array(
                            'evenst_id'=> $event["evenst_id"],
                            'title'    => $event["title"],
                            'start'    => $start,
                            'end'      => $end,
                            'color'    => $event["color"],
                           );
                        }   

                    return json_encode($data);
                }
                
            } catch(Exception $e) {
                $response =  json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status"  => "error"
                ));
            }
            echo $response;
        }

        public function updateDropEvents($data) {

            $start = intval(explode('-', $data[1])[0]);
            $end   = intval(explode('-', $data[2])[0]);
            $currentYear = date('Y');

            if($end > $start || $currentYear != $start || $currentYear != $end) {
                echo json_encode(array(
                    "message" => "Invalid Date Start " . $data[1] . ' -   End ' . $data[2],
                    "status"  => "error"
                ));
                die();
            }
            
            try {
                $sql = "UPDATE tbl_events SET end=:end, start=:start WHERE evenst_id=:evenst_id";
    
                $paramType = ":placeholder";
                $paramValue = array(
                    "evenst_id" => $data[0],
                    "start" => $data[1],
                    "end"   => $data[2]
                );
    
               if($this->update($sql, $paramType, $paramValue)
               ){
                    $rsponse = json_encode(array(
                        "message" => "Successfully Moved Event",
                        "status"  => "success"
                    ));
               }
    
           } catch(Exception $e) {
               $rsponse = json_encode(array(
                   "message" => "Error: " . $e->getMessage(),
                   "status" => "error"
               ));
           }
           echo $rsponse;
        }

        public function addEvents($data) { 

            $start = intval(explode('-', $data['start'])[0]);
            $end   = intval(explode('-', $data['end'])[0]);
            $currentYear = date('Y');

            if($end > $start || $currentYear != $start || $currentYear != $end) {
                echo json_encode(array(
                    "message" => "Invalid Date Start " . $data['start'] . ' -   End ' . $data['end'],
                    "status"  => "error"
                ));
                die();
            }
            
            try {
                $sql = "INSERT INTO tbl_events (color, title, end, start) 
                VALUES (:color, :title, :end, :start)";
                $paramType = ":placeholder";
    
                $paramValue = array(
                    "color" => $data['color'],
                    "title" => $data['title'],
                    "start" => $data['start']." ".$data['startTime'],
                    "end"   => $data['end']." ".$data['endTime']
                );

                if($this->insert($sql, $paramType, $paramValue)
                ) {
                    echo json_encode(array(
                        "message" => "Successfully Add Event",
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

        public function updateEvents($data) {
            try {
                $sql = "UPDATE tbl_events SET title=:title, color=:color, end=:end, start=:start WHERE evenst_id=:evenst_id";
    
                $paramType = ":placeholder";
                $paramValue = array(
                    "evenst_id" => $data['evenst_id'],
                    "title" => $data['updateTitle'],
                    "color" => $data['updateColor'],
                    "start" => $data['updateStart']." ".$data['updateStartTime'],
                    "end"   => $data['updateEnd']." ".$data['updateEndTime']
                );
    
               if($this->update($sql, $paramType, $paramValue)
               ){
                    $rsponse = json_encode(array(
                        "message" => "Successfully Update Event",
                        "status"  => "success"
                    ));
               }
    
           } catch(Exception $e) {
               $rsponse = json_encode(array(
                   "message" => "Error: " . $e->getMessage(),
                   "status" => "error"
               ));
           }
           echo $rsponse;
        }

        public function deleteEvents($id) {
  
            try {
                $sql = "DELETE FROM tbl_events WHERE evenst_id=:evenst_id";
    
                $paramType = ":placeholder";
                $paramValue = array(
                    "evenst_id" => intval($id),
                );
    
               if($this->update($sql, $paramType, $paramValue)
               ){
                    $rsponse = json_encode(array(
                        "message" => "Successfully Remove Event",
                        "status"  => "success"
                    ));
               }
    
           } catch(Exception $e) {
               $rsponse = json_encode(array(
                   "message" => "Error: " . $e->getMessage(),
                   "status" => "error"
               ));
           }
           echo $rsponse;
        }

        public function getDisplayAllEvents() {
            try {
                $sql = "SELECT * FROM tbl_events ORDER BY start ASC";                
                
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

        public function getDateNow() {
            try {
                $sql = "SELECT DATE_FORMAT(NOW(), '%m/%d/%Y')";                
                
                if($result = $this->runBaseSql($sql)    
                ) {
                    $response =  json_encode(array(
                        "message" => $result[0]["DATE_FORMAT(NOW(), '%m/%d/%Y')"],
                        "status"  => "success"
                    ));

                    // $response =  json_encode(array(
                    //     "message" => '10/18/2021',
                    //     "status"  => "success"
                    // ));
                }
                
            } catch(Exception $e) {
                $response =  json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status"  => "error"
                ));
            }
            echo $response;
        }

        public function updateExpiredEvents($id) {
            try {
                $sql = "UPDATE tbl_events SET status=:status WHERE evenst_id=:evenst_id";
    
                $paramType = ":placeholder";
                $paramValue = array(
                    "evenst_id" => $id,
                    "status"    => 'Inactive'
                );
    
               if($this->update($sql, $paramType, $paramValue)
               ){
                    $rsponse = json_encode(array(
                        "message" => "Update remove expired events:  ".$id,
                        "status"  => "success"
                    ));
               }
    
           } catch(Exception $e) {
               $rsponse = json_encode(array(
                   "message" => "Error: " . $e->getMessage(),
                   "status" => "error"
               ));
           }
           echo $rsponse;
        }

        public function getGallery() {
            try {
                $sql = "SELECT * FROM tbl_gallery WHERE galllery_id ";                
                
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

        public function showGallery() {
            try {
                $sql = "SELECT * FROM tbl_gallery WHERE galllery_id ";                
                
                if($result = $this->runBaseSql($sql)    
                ) {
                    return $result;
                }
                
            } catch(Exception $e) {
                $response =  json_encode(array(
                    "message" => "Error: " . $e->getMessage(),
                    "status"  => "error"
                ));
            }
            echo $response;
        }

        public function uploadSchoolGallery($data) {
            try {
                $sql = "INSERT INTO tbl_gallery (filename) 
                VALUES (:filename)";
                $paramType = ":placeholder";
    
                $paramValue = array(
                    "filename" => $data,
                );
                if($this->insert($sql, $paramType, $paramValue)
                ) {
                    echo json_encode(array(
                        "message" => "Successfully Uplaod Image",
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

        public function removeSchoolGallery($data) {
            try {
                foreach($data as $value) {
    
                    $sql="DELETE FROM tbl_gallery WHERE galllery_id =:galllery_id ";
                    $paramType = ":placeholder";
                    $paramValue = array(
                        "galllery_id" => $value,
                    );
                    $this->update($sql, $paramType, $paramValue);
                }
                    
                $reponse = json_encode(array(
                    "message" => "Successfully Remove Image",
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

        public function sortSchoolGallery($number) {
            try {
                $sql = "SELECT * FROM tbl_gallery ORDER BY galllery_id DESC 
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
                    "status"  => "error"
                ));
            }
            echo $response;
        }

        public function galleryTotalPages() {
            try {
                $sql = "SELECT * FROM tbl_gallery";                
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
                    "status"  => "error"
                ));
            }
            echo $response;
        }

        public function paginateSchoolGallery($pagenum) {
            $num_per_page = 05;
            $start_from   = ($this->cleanStr($pagenum-1))*05;
    
            try {
                $sql = "SELECT * FROM tbl_gallery ORDER BY galllery_id DESC LIMIT $start_from, $num_per_page";  

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

        public function updateSchoolGallery($data) {

            try {
                $sql = "UPDATE tbl_gallery SET filename=:filename 
                WHERE galllery_id =:galllery_id";
    
                $paramType = ":placeholder";
                $paramValue = array(
                    "galllery_id" => $data[0],
                    "filename"     => $data[2]
                );
    
               if($this->insert($sql, $paramType, $paramValue)
               ){
                    $rsponse = json_encode(array(
                        "message" => "Successfully Update Image",
                        "status"  => "success"
                    ));
               }
    
           } catch(Exception $e) {
               $rsponse = json_encode(array(
                   "message" => "Error: " . $e->getMessage(),
                   "status" => "error"
               ));
           }
           echo $rsponse;
        }

        public function cleanStr($string) {
            
            $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
            $string = preg_replace('/-+/', '-', $string);
            
            return $string;
        }  
    }
?>