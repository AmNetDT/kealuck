<?php

require_once '../../core/init.php';

$workorders_id = $_POST['workorders_id'];
$sku_inv_code = $_POST['sku_inv_code'];
$description = $_POST['description'];

$record = Db::getInstance();


            if(isset($description) && $description !== ""){
                
               $findtax = $record->query("SELECT a.*, b.type 
               FROM workoutput a 
               LEFT JOIN workorders b on a.workorders_id = b.id
               WHERE a.sku_code = '$sku_inv_code' AND a.workorders_id = $workorders_id");
                
              try{
                
              
                        if($findtax->count()){
                          
                            echo  '<div class="alert alert-dismissible alert-danger">Work Output already added
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                           
                        }else{
                            
                 $record->insert("workoutput", array(
                    'workorders_id'         => Input::get('workorders_id'),
                    'sku_code'              => Input::get('sku_inv_code'), 
                    'uom'                   => Input::get('uom'),
                    'description'           => Input::get('description'),
                    'product_type'          => Input::get('product_type'),
                    'product_category'      => Input::get('product_category'),
                    'product_qty'           => Input::get('product_qty'),
                    'currency_id'           => Input::get('currency_id'),
                    'total_revenue'         => Input::get('total_revenue'),
                    'storage_location'      => Input::get('storage_location'),
                    'additional_info'       => Input::get('additional_info')
                )); 
          
                    
                    	    echo  '<div class="alert alert-dismissible alert-success">Work out ' .  $sku_inv_code . '  added.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                    	
                     }
                     
                    	
                } catch (Exception $e) {
                    
                    die($e->getMessage());
                    
                }    
                
            }else{
                
                echo "<div class='alert alert-danger m-0'>All field required.</div>";
                
            }


                	
                
    