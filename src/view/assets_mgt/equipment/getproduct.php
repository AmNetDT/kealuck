<?php
                
require_once '../../core/init.php';


 
$department_id = 0;

        if($_REQUEST['sku_code']) {
            
            $department_id = $_REQUEST['sku_code'];
            //$users_arr = $_REQUEST['department_id'];
            $users_arr = array();
            
            if($department_id != ""){
                
                    $department = Db::getInstance()->query("SELECT description, cost_per_unit, metric_units FROM `products` WHERE `sku_code` = '$department_id'");
                    foreach ($department->results() as $department) {
                            
                            
                            $selling_price_default = $department->description;
                            $cost_per_unit = $department->cost_per_unit;
                            $metric_units = $department->metric_units;

                     $users_arr[] = array(
                         
                         "description" => $selling_price_default,
                         "cost_per_unit" => $cost_per_unit,
                         "metric_units" => $metric_units
                         
                         );
                     
                    }
            } 
        }
        echo json_encode($users_arr);

