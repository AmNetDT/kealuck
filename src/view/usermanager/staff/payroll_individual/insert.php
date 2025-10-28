<?php

require_once '../../core/init.php';


$record = Db::getInstance();

$employee_id            = $_POST['employee_id'];
$job_level_id           = $_POST['job_level_id'];

       
            if(isset($employee_id) && !empty($job_level_id)){
                
               $findtax = $record->query("SELECT * FROM payroll WHERE employee_id = $employee_id");
          
    	    
        
        		try {
        		    
        		     if($findtax->count()){
                          
                            echo  '<div class="alert alert-dismissible alert-danger">Staff payroll already added
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                           
                        }else{
                            
                            $record->insert("payroll", array(
                            'employee_id'           => Input::get('employee_id'),
                            'job_level_id'          => Input::get('job_level_id'),
                            'basic_salary'          => Input::get('basic_salary'),
                            'housing_allowance'     => Input::get('housing_allowance'),
                            'transport_allowance'   => Input::get('transport_allowance'),
                            'medical_allowance'     => Input::get('medical_allowance'),
            				'utility_allowance'     => Input::get('utility_allowance'),
            				'entertainment'         => Input::get('entertainment')
                         )); 
                         
                        echo  '<div class="alert alert-dismissible alert-success">Staff payroll created
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
        
                        }
                                
        		} catch (Exception $e) {
        			die($e->getMessage());
        		}
                        
                        
            }
		
	
