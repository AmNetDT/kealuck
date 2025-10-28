<?php

require_once '../../core/init.php';
$record = Db::getInstance();

$id = $_POST['guarantor_id'];


  
	
		                    try{
	  
                               
                                
                                $record->update("staff_guarantor", $id, array(
                                            
                                            'guarantor_fullname'        => Input::get('guarantor_fullname'),
                                            'guarantor_address'         => Input::get('guarantor_address'),
                                            'guarantor_phone'           => Input::get('guarantor_phone'),
                                            'guarantor_email'           => Input::get('guarantor_email'),
                                            'guarantor_occupation'      => Input::get('guarantor_occupation'),
                                            'relation_to_emp'           => Input::get('relation_to_emp')
                                            
                                        ));
                             
                                  
                    						echo "<div class='alert alert-success'>Gurantor Updated Successfully</div>";
                    	
                              
                   
		                 
		                    } catch (Exception $e) {
        			die($e->getMessage());
        		}
                   


                	
                
             
    