<?php
                
require_once '../../core/init.php';


 
$department_id = 0;

        if($_REQUEST['subsidiary_ledger_id']) {
            
            $department_id = $_REQUEST['subsidiary_ledger_id'];
           
            $users_arr = array();
            
            if($department_id > 0){
                
                    $department = Db::getInstance()->query("SELECT gl_code FROM `chart_of_accounts` WHERE `id` = $department_id order by id asc");
                    foreach ($department->results() as $department) {
                            
                       
                            $gl_code = "(" . $department->gl_code . ")";

                     $users_arr[] = array(
                         
                  
                         "gl_code" => $gl_code
                         
                         );
                     
                    }
            } 
        }
        echo json_encode($users_arr);

