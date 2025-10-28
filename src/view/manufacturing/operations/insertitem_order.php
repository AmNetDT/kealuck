<?php

require_once '../../core/init.php';

$record = Db::getInstance();
$table = $_POST['table']; 
$workorders_id = $_POST['workorders_id'];
$item_code = $_POST['item_code'];


              try{
            
               

            if(isset($item_code) && !empty($item_code) && $table ==='purchases' ){
                
               $check_if_already_exist1 = $record->query("SELECT * FROM purchases a WHERE EXISTS (SELECT * FROM workorders_orders b 
                                                            WHERE a.purchase_code = b.purchase_code AND a.purchase_code = '$item_code')");
               
                                if($check_if_already_exist1->count()){
                          
                                            echo  '<div class="alert alert-dismissible alert-danger">Items already exist
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                      </button>
                                                </div>';
                                             
                                }else{
                                    
                                           $findpurchases = $record->query("SELECT id, purchase_code
                                                                            FROM purchases 
                                                                            WHERE purchase_code = '$item_code'");
                                              
                                              foreach ($findpurchases->results() as $findpurchase) {
                                         
                                              $purchase_id = $findpurchase->id;
                                              $purchase_code = $findpurchase->purchase_code;
                                              // Insert a copy of the purchase order to the workorder_order
                                        
                                              $findworkorders_orders = $record->query("INSERT INTO `workorders_orders`(`workorders_id`, `purchase_id`, `purchase_code`, `item_code`, `description`, `qty`, `currency_id`, `unit_cost`) 
                                                                            SELECT $workorders_id, $purchase_id, '$purchase_code', `sku_code` as `item_code`, `description`, `qty`, `currency_id`, `unit_cost` 
                                                                            FROM `purchase_order` WHERE purchase_id = $purchase_id");
                                                                            echo '<div class="alert alert-dismissible alert-success">Purchase order items listed
                                                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                     </button>
                                                                                </div>';
                                                                  
                                            }
                                }

            }else if(isset($item_code) && !empty($item_code) && $table ==='utilities' ){
                
                // Insert a copy of the utility to the workorder_order
                
             
             
                $check_if_already_exist2 = $record->query("SELECT * FROM workorders_utility b WHERE varchar_code = '$item_code'");
                                
                                if($check_if_already_exist2->count()){
                                             
                          
                                                    echo  '<div class="alert alert-dismissible alert-danger">Voucher already added
                                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                              </button>
                                                        </div>';
                                
                                             
                                         }else{
                                             
                                            $check_if_approved = $record->query("SELECT * FROM approval WHERE request_code = '$item_code'");
                                           foreach ($check_if_approved->results() as $check_if_approved) {
                                               
                                               if($check_if_approved->approval_status === 'Approved'){
                                                 
                                                                        
                                                                       
                                           $findtax = $record->query("SELECT * FROM utilities WHERE voucher_code = '$item_code'");
                                            foreach ($findtax->results() as $findta) {
                                           
                                              $utility_id = $findta->id;
                                        // Insert a copy of the purchase order to the workorder_order
                                        
                                            $findinsert = $record->query("INSERT INTO `workorders_utility`(`workorders_id`, `varchar_code`, `utility_id`, `amount`, `description`)
                                                                            SELECT  $workorders_id, `voucher_code`, $utility_id, `amount`, `description` FROM `utilities` WHERE id = $utility_id");
                                                                            
                                                                         echo '<div class="alert alert-dismissible alert-success">Utility items listed
                                                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                              </button>
                                                                        </div>';
                                                }
                                                
                                                 
                                                   
                                               }else{
                                                
                                                echo '<div class="alert alert-dismissible alert-danger">Utility items not yet approved
                                                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                              </button>
                                                                        </div>';
                                                                        
                                            } 
                                            
                                            }
                                                  
                                         }
                                         
                
            }else{
                
                echo '<div class="alert alert-dismissible alert-danger">Add your Item Code
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                
            }
        
              } catch (Exception $e) {
                    
                    die($e->getMessage());
                    
                }    
                