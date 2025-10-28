<?php
                
require_once '../../core/init.php';


 
$department_id = 0;

        if($_REQUEST['tax_category']) {
            
            $department_id = $_REQUEST['tax_category'];
          
            $users_arr = array();
            
            if($department_id > 0){
                
                    $department = Db::getInstance()->query("SELECT percentage FROM `tax` WHERE `id` = $department_id");
                    foreach ($department->results() as $department) {
                            
                            $percentage               = $department->percentage;

                            $users_arr[] = array(
                                "percentage"                 => $percentage
                             );
                     
                    }
            } 
        }
        echo json_encode($users_arr);

