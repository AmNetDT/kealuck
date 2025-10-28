<?php
                
require_once '../../core/init.php';


 
$department_id = 0;

        if($_REQUEST['supplier_id']) {
            
            $department_id = $_REQUEST['supplier_id'];
            //$users_arr = $_REQUEST['department_id'];
            $users_arr = array();
            
            if($department_id > 0){
                
                    $department = Db::getInstance()->query("SELECT name FROM `suppliers` WHERE `id` = $department_id");
                    foreach ($department->results() as $department) {
                            
                            
                            $selling_price_default = $department->name;

                     $users_arr[] = array("name" => $selling_price_default);
                     
                    }
            } 
        }
        echo json_encode($users_arr);

