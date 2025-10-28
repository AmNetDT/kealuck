<?php
                
require_once '../../core/init.php';

$record = Db::getInstance();
     $workoperation_description_id = 0;
 

      

        if($_REQUEST['workoperation_description_id']) {
            
            $workoperation_description_id = $_REQUEST['workoperation_description_id'];       
            
            $users_arr = array();
            
         
                
                    $findtax = $record->query("SELECT * FROM workoperation_description WHERE id = $workoperation_description_id");
                    foreach ($findtax->results() as $find) {
                                    
                                    $cost_per_hour = $find->cost_per_hour;
                                    $description   = $find->description;
                                    
                                         $users_arr[] = array(
                                             
                                             "cost_per_hour" => $cost_per_hour,
                                             "description"   => $description
                                             
                                         );
                         }
        }            
            
        echo json_encode($users_arr);
