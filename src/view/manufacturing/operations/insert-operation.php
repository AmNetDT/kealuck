<?php

require_once '../../core/init.php';
$wop_code = $_POST['wop_code'];

$record = Db::getInstance();

           
               if(isset($wop_code) && !empty($wop_code)){
                
               $findgoods = $record->query("SELECT * FROM workoperation WHERE wop_code = '$wop_code'");
                
               try{
                         if($findgoods->count()){
                          
                            echo  '<div class="alert alert-dismissible alert-danger">Work Operation already added
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                           
                        }else{
                    
                           $record->insert("workoperation", array(
                            'wop_code'           =>    Input::get('wop_code'),
                            'workorders_id'      =>    Input::get('workorders_id'),
                            'description'        =>    Input::get('description_operation'),
                            'cost_per_hour'      =>    Input::get('cost_per_hour'),
                            'duration_in_hour'   =>    Input::get('duration_in_hour'),
                            'estimated_cost'     =>    Input::get('estimated_cost'),
                            'assign_to'          =>    Input::get('assign_to'),
                            'additional_info'    =>    Input::get('additional_info')
                         ));
                  
                    	    echo  '<div class="alert alert-dismissible alert-success">Work Operation added
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                        }
                           
                     
                } catch (Exception $e) {
                    
                    die($e->getMessage());
                    
                }    

                  
            }else{
                
                echo '<div class="alert alert-dismissible alert-danger">Fill all the field not filled
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                    </div>';
                
            }
        
  