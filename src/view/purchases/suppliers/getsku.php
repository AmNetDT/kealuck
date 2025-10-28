<?php
                
require_once '../../core/init.php';


 
$department_id = 0;

        if($_REQUEST['product_id']) {
            
            $department_id = $_REQUEST['product_id'];
            //$users_arr = $_REQUEST['department_id'];
            $users_arr = array();
            
            if($department_id > 0){
                
                    $department = Db::getInstance()->query("SELECT description, uom, cost_per_unit FROM `products` WHERE type='input' AND `id` = $department_id");
                    foreach ($department->results() as $department) {
                            
                            $description = $department->description;
                            $uom = $department->uom;
                            $cost_per_unit = $department->cost_per_unit;

                     $users_arr[] = array("description" => $description, "uom" => $uom, "cost_per_unit" => $cost_per_unit);
                     
                    }
            } 
        }
        echo json_encode($users_arr);

