<?php

require_once '../../core/init.php';

$approval_status = $_POST['approval_status'];
$approval_id = $_POST['approval_id'];
$record = Db::getInstance();


            $users_arr = array();

            if(isset($approval_status) && $approval_status != ''){
          
    
               try{
               
                  
              
                       
                         
                         $record->update("approval", $approval_id, array(
                            'approved_by'            => Input::get('approved_by'),
                            'approval_status'        => Input::get('approval_status'),
                            'approval_date'          => Input::get('approval_date')
                         )); 
                  
                    	    $msg = '<div class="alert alert-dismissible alert-success">Remark sent
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                 </div>';
                    	            
                    	            
                     
                     
                     
                } catch (Exception $e) {
                    
                    die($e->getMessage());
                    
                }    

            }else{
                
                $msg = "<div class='alert alert-danger m-0'>No remark sent</div>";
                
            }
    
                                    $users_arr = array(
                                             
                                             "approval_status" => $approval_status,
                                             "msg"          => $msg
                                         );     
   
                                    echo json_encode($users_arr);
                                    