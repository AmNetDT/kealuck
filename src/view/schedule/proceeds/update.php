<?php

require_once '../../core/init.php';




$id = $_POST['workorders_id'];

$record = Db::getInstance();



              try{
                
              
                            
                 $record->update("workorders", $id, array(
                    'status' => Input::get('status_')
                    
                )); 
          
                    
                    	    echo  '<div class="alert alert-dismissible alert-success">WO status updated
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                    	
                     
                     
                    	
                } catch (Exception $e) {
                    
                    die($e->getMessage());
                    
                }   
                
    
                
             
    