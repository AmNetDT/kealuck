<?php
                
require_once '../../core/init.php';


 
$department_id = 0;

        if($_REQUEST['product_id']) {
            
            $department_id = $_REQUEST['product_id'];
            //$users_arr = $_REQUEST['department_id'];
            $users_arr = array();
            
            if($department_id > 0){
                
                    $department = Db::getInstance()->query("SELECT description, selling_price_default, uom FROM `products` WHERE `id` = $department_id");
                    foreach ($department->results() as $department) {
                            
                            $description = $department->description;
                            $selling_price_default = $department->selling_price_default;
                            $uom = $department->uom;

                     $users_arr[] = array("description" => $description, "selling_price_default" => $selling_price_default, "uom" => $uom);
                     
                    }
            } 
        }
        echo json_encode($users_arr);

