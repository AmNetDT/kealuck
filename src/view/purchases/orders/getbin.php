<?php
                
require_once '../../core/init.php';


 
$warehouse_id = 0;

        if($_REQUEST['warehouse_id']) {
            
            $warehouse_id = $_REQUEST['warehouse_id'];
            //$users_arr = $_REQUEST['department_id'];
            $users_arr = array();
            
            if($warehouse_id > 0){
                
                    $warehouse = Db::getInstance()->query("SELECT description, id FROM `bin` WHERE `warehouse_id` = $warehouse_id");
                    foreach ($warehouse->results() as $warehouse) {
                            
                            $bin_id     = $warehouse->id;
                            $warehouse  = $warehouse->description;

                     $users_arr[] = array("description" => $warehouse, "id" => $bin_id);
                     
                    }
            } 
        }
        echo json_encode($users_arr);

