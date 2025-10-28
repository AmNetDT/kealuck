<?php
                
require_once '../../core/init.php';

$record = Db::getInstance();
     $equipment_id = $_POST['equipment_id'];
 

      
            
            
            $users_arr = array();
            
            if($sku_code != ""){
                
                    $findtax = $record->query("SELECT SUM(qty) AS qty FROM item_received WHERE equipment_id = $equipment_id");
                    foreach ($findtax->results() as $find) {
                                    $findqty = $find->qty;
                         if($findqty != NULL){
                             
                             foreach ($findtax->results() as $find) {
                                   
                            
                                    $sku = $record->query("SELECT `id`, `equipment_id`, `description`, SUM(qty) - $findqty AS qty, `unit_cost` 
                                    FROM `equipment_order` WHERE `equipment_id` = $equipment_id");
                                    foreach ($sku->results() as $skudetail) {
                                            
                                         $description = $skudetail->description;
                                         $qty = $skudetail->qty;
                
                                         $users_arr = array(
                                             
                                             "description" => $description,
                                             "qty" => $qty
                                             
                                         );
                                 
                                }
                            } 
                            
                         }else{
                             
                            
                                    $sku = $record->query("SELECT `id`, `equipment_id`, `description`, SUM(qty) AS qty, `unit_cost` 
                                    FROM `equipment_order` WHERE `equipment_id` = $equipment_id");
                                    foreach ($sku->results() as $skudetail) {
                                            
                                         $description = $skudetail->description;
                                         $qty = $skudetail->qty;
                
                                         $users_arr = array(
                                             
                                             "description" => $description,
                                             "qty" => $qty
                                             
                                         );
                                 
                                
                            } 
                             
                         }
                    }
            }
        echo json_encode($users_arr);

