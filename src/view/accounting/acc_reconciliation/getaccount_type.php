<?php
                
require_once '../../core/init.php';


 
$department_id = 0;

        if($_REQUEST['account_type']) {
            
            $department_id = $_REQUEST['account_type'];
            //$users_arr = $_REQUEST['department_id'];
            $users_arr = array();
            
            if($department_id > 0){
                
                    $department = Db::getInstance()->query("SELECT id, gl_code, description FROM `chart_of_accounts` WHERE `category_id` = $department_id order by id asc");
                    foreach ($department->results() as $department) {
                            
                            
                            $id = $department->id;
                            $gl_code = $department->gl_code;
                            $description = $department->description;

                     $users_arr[] = array(
                         
                         "id" => $id,
                         "gl_code" => $gl_code,
                         "description" => $description
                         
                         );
                     
                    }
            } 
        }
        echo json_encode($users_arr);

