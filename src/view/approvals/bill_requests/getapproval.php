<?php
                
require_once '../../core/init.php';

$record = Db::getInstance();
$approval_id = $_POST['approval_id'];
 

      
            
            
            $users_arr = array();
            
                
                    $findtax = $record->query("SELECT amount FROM approval WHERE id = $approval_id");
                    foreach ($findtax->results() as $find) {
                                   
                      $total_amount = $find->amount;
                             
                              
                                   
                            
                                    $sku = $record->query("SELECT SUM(paid) AS paid 
                                    FROM `approval_records` WHERE `approval_id` = $approval_id");
                                    
                                    if($sku->count()) {
                                    foreach ($sku->results() as $skudetail) {
                                            
                                         $paid = $skudetail->paid;
                                         $bal = $total_amount - $paid;
                
                                         $users_arr = array(
                                             
                                             "total_amount" => $total_amount,
                                             "bal" => $bal
                                             
                                         );
                                 
                                    }
                            }else{
                                
                
                                         $users_arr = array(
                                             
                                             "bal" => $total_amount
                                             
                                         );
                            } 
                         
                    }
            
        echo json_encode($users_arr);

