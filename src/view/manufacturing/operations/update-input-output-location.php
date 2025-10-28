<?php

require_once '../../core/init.php';



$id = $_POST['id'];
$inputs_warehouse_id = $_POST['inputs_warehouse_id'];
$output_warehouse_id = $_POST['output_warehouse_id'];
$record = Db::getInstance();

            if($inputs_warehouse_id === null){
                
                
                echo  '<div class="alert alert-dismissible alert-danger">All fills required.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                            </div>';
                           
                 
            }else if($output_warehouse_id === null){
                
             
                echo  '<div class="alert alert-dismissible alert-danger">All fills required.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                            </div>';
                           
                
            }else{
                
              try{
                
                            
                 $record->update("workorders", $id, array(
                    'inputs_warehouse_id' => Input::get('inputs_warehouse_id'),
                    'output_warehouse_id' => Input::get('output_warehouse_id'), 
                    'added_by' => Input::get('added_by')
                    
                    
                )); 
          
                    
                    	    echo  '<div class="alert alert-dismissible alert-success">Work order added.
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                    </div>';
                    	
                     
                     
                    	
                } catch (Exception $e) {
                    
                    die($e->getMessage());
                    
                }   
                    
                
            }
                
             
    