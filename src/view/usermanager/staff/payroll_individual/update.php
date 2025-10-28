<?php

require_once '../../core/init.php';


$record = Db::getInstance();

            $id                 = $_POST['id'];
            $basic_salary       = $_POST['basic_salary'];
       
            if(isset($basic_salary) && !empty($basic_salary)){
                
        
        		try {
                            
                            $record->update("payroll_statements", $id, array(
                            'basic_salary'          => Input::get('basic_salary'),
                            'housing_allowance'     => Input::get('housing_allowance'),
                            'transport_allowance'   => Input::get('transport_allowance'),
                            'medical_allowance'     => Input::get('medical_allowance'),
            				'utility_allowance'     => Input::get('utility_allowance'),
            				'entertainment'         => Input::get('entertainment'),
            				'remarks'               => Input::get('remarks')
                         )); 
                         
                        echo  '<div class="alert alert-dismissible alert-success">Staff payroll statement adjusted
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
        
                        
                                
        		} catch (Exception $e) {
        			die($e->getMessage());
        		}
                        
                        
            }
		
	
