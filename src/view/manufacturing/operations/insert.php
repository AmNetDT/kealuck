<?php

require_once '../../core/init.php';

$workorder_code = $_POST['wo_code'];
$description = $_POST['description'];
$operationtype = $_POST['operationtype'];

$record = Db::getInstance();


            if(isset($description) && $description !== "" && $operationtype !==""){
                
               $findtax = $record->query("SELECT * FROM workorders WHERE wo_code = '$workorder_code'");

              try{
                
              
                        if($findtax->count()){
                          
                            echo  '<div class="alert alert-dismissible alert-danger">Work Order already added
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                           
                        }else{
                            
                 $record->insert("workorders", array(
                    'wo_code' => Input::get('wo_code'),
                    'date_time' => Input::get('date_time'), 
                    'inputs_warehouse_id' => Input::get('inputs_warehouse'),
                    'output_warehouse_id' => Input::get('output_warehouse'),
                    'description' => Input::get('description'),
                    'type' => Input::get('operationtype'),
                    'stock_price' => Input::get('stock_price'),
                    'deadline' => Input::get('deadline'),
                    'priority' => Input::get('priority'), 
                    'transaction_year' => date('Y'), 
                    'remark' => Input::get('remark'),
                    'added_by' => Input::get('added_by')
                    
                )); 
          
                    
                    	    echo  '<div class="alert alert-dismissible alert-success">Work order ' .  $workorder_code . '  added.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                    	
                     }
                     
                    	
                } catch (Exception $e) {
                    
                    die($e->getMessage());
                    
                }    
                
            }else{
                
                echo "<div class='alert alert-danger m-0'>Order Description and Operation Type are to be filled.</div>";
                
            }


                	
                
    