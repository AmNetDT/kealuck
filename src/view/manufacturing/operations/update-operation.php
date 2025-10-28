<?php

require_once '../../core/init.php';
$id = $_POST['woperator_id'];

$record = Db::getInstance();

           
              
                
                
               try{
                        
                    
                           $record->update("workoperation", $id, array(
                            'wop_code'           =>    Input::get('wop_code'),
                            'workorders_id'      =>    Input::get('workorders_id'),
                            'description'        =>    Input::get('description_operation'),
                            'cost_per_hour'      =>    Input::get('cost_per_hour'),
                            'duration_in_hour'   =>    Input::get('duration_in_hour'),
                            'estimated_cost'     =>    Input::get('estimated_cost'),
                            'assign_to'          =>    Input::get('assign_to'),
                            'additional_info'    =>    Input::get('additional_info')
                         ));
                  
                    	    echo  '<div class="alert alert-dismissible alert-success">Work Operation Update
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                        
                           
                     
                } catch (Exception $e) {
                    
                    die($e->getMessage());
                    
                }    

                  
           