<?php

require_once '../../core/init.php';


$record = Db::getInstance();

$id = $_POST['id_u'];

       
    	    
        
        		try {
        		    
                            
                            $record->update("payroll", $id, array(
                            'employee_id'           => Input::get('employee_id_u'),
                            'job_level_id'          => Input::get('job_level_id_u'),
                            'basic_salary'          => Input::get('basic_salary_u'),
                            'housing_allowance'     => Input::get('housing_allowance_u'),
                            'transport_allowance'   => Input::get('transport_allowance_u'),
                            'medical_allowance'     => Input::get('medical_allowance_u'),
            				'utility_allowance'     => Input::get('utility_allowance_u'),
            				'entertainment'         => Input::get('entertainment_u')
                         )); 
                         
                        echo  '<div class="alert alert-dismissible alert-success">Staff Level Updated
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
        
                        
                                
        		} catch (Exception $e) {
        			die($e->getMessage());
        		}
                        
                        
       
		
	
