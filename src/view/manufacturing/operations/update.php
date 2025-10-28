<?php

require_once '../../core/init.php';



$workorder_code = $_POST['wo_code'];
$id = $_POST['id'];

$record = Db::getInstance();



              try{
                
              
                            
                 $record->update("workorders", $id, array(
                    'wo_code' => Input::get('wo_code'),
                    'date_time' => Input::get('date_time'), 
                    'description' => Input::get('description'),
                    'type' => Input::get('operationtype'),
                    'stock_price' => Input::get('stock_price'),
                    'deadline' => Input::get('deadline'),
                    'priority' => Input::get('priority'), 
                    'remark' => Input::get('remark'),
                    'added_by' => Input::get('added_by')
                    
                )); 
          
                    
                    	    echo  '<div class="alert alert-dismissible alert-success">Work order ' .  $workorder_code . '  added.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                    	
                     
                     
                    	
                } catch (Exception $e) {
                    
                    die($e->getMessage());
                    
                }   
                
    
                
             
    