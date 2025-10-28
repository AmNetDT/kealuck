<?php
                
require_once '../../core/init.php';

$record = Db::getInstance();
     $purchase_id = $_POST['purchase_id'];
     $sku_code = $_POST['sku_code'];
 

      
            
            
            $users_arr = array();
            
            if($sku_code != ""){
                
                    $findtax = $record->query("SELECT SUM(qty) AS qty FROM good_received WHERE sku_code = '$sku_code' AND purchase_id = $purchase_id");
                    foreach ($findtax->results() as $find) {
                                    $findqty = $find->qty;
                         if($findqty != NULL){
                             
                             foreach ($findtax->results() as $find) {
                                   
                            
                                    $sku = $record->query("SELECT `id`, `purchase_id`, `sku_code`, `description`, SUM(qty) - $findqty AS qty, `unit_cost` 
                                    FROM `purchase_order` WHERE `purchase_id` = $purchase_id AND `sku_code` = '$sku_code'");
                                    foreach ($sku->results() as $skudetail) {
                                            
                                         $sku_code = $skudetail->sku_code;
                                         $description = $skudetail->description;
                                         $qty = $skudetail->qty;
                
                                         $users_arr = array(
                                             
                                             "sku_code" => $sku_code,
                                             "description" => $description,
                                             "qty" => $qty
                                             
                                         );
                                 
                                }
                            } 
                            
                         }else{
                             
                            
                                    $sku = $record->query("SELECT `id`, `purchase_id`, `sku_code`, `description`, SUM(qty) AS qty, `unit_cost` 
                                    FROM `purchase_order` WHERE `purchase_id` = $purchase_id AND `sku_code` = '$sku_code'");
                                    foreach ($sku->results() as $skudetail) {
                                            
                                         $sku_code = $skudetail->sku_code;
                                         $description = $skudetail->description;
                                         $qty = $skudetail->qty;
                
                                         $users_arr = array(
                                             
                                             "sku_code" => $sku_code,
                                             "description" => $description,
                                             "qty" => $qty
                                             
                                         );
                                 
                                
                            } 
                             
                         }
                    }
            }
        echo json_encode($users_arr);

