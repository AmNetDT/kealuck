<?php
                
require_once '../../core/init.php';


 
$department_id = 0;

        if($_REQUEST['output_warehouse_location_type']) {
            
            $department_id = $_REQUEST['output_warehouse_location_type'];
            //$users_arr = $_REQUEST['department_id'];
            $users_arr = array();
            
            if($department_id > 0){
                
                    $department = Db::getInstance()->query("SELECT id, location FROM `worklocation` WHERE `worklocation_type_id` = $department_id order by id asc");
                    foreach ($department->results() as $department) {
                            
                            
                            $id = $department->id;
                            $location = $department->location;

                     $users_arr[] = array(
                         
                         "id" => $id,
                         "location" => $location
                         
                         );
                     
                    }
            } 
        }
        echo json_encode($users_arr);

