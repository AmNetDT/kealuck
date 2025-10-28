<?php

require_once '../../core/init.php';

$transaction_year_month = $_POST['transaction_year_month'];
$added_by = $_POST['added_by'];

$record = Db::getInstance();

if(isset($transaction_year_month) && $transaction_year_month !== ''){
                
        $find = $record->query("SELECT * FROM payroll_statements WHERE transaction_year_month = '$transaction_year_month'");
          
    
        try {
             
             if($find->count()){
                          
                            echo  '<div class="alert alert-dismissible alert-danger">Staff payroll already created
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                           
                        }else{
            
        $find = $record->query("INSERT INTO payroll_statements (`employee_id`, `job_level_id`, `basic_salary`, `housing_allowance`, `transport_allowance`, `medical_allowance`, `utility_allowance`, `entertainment`,`transaction_year_month`,`added_by`) 
SELECT `employee_id`, `job_level_id`, `basic_salary`, `housing_allowance`, `transport_allowance`, `medical_allowance`, `utility_allowance`, `entertainment`, '$transaction_year_month' as transaction_year_month, '$added_by' as added_by FROM payroll");

            echo  '<div class="alert alert-dismissible alert-success">Staff payroll created
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                    	
                     }
                     
                
            } catch (Exception $e) {
                
                die($e->getMessage());
                
            }
       
       
    }else{
                
                echo "<div class='alert alert-danger m-0'>Select a month</div>";
                
            }