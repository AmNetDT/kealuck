<?php
                
require_once '../../core/init.php';


 
$job_level_id = 0;

        if($_REQUEST['job_level_id'] || $_REQUEST['job_level_id_u']) {
            
            $job_level_id = $_REQUEST['job_level_id'];
            
            if(!empty($job_level_id)){
            
            
          
            $users_arr = array();
            
            if($job_level_id > 0){
                
                    $department = Db::getInstance()->query("SELECT `basic_salary`, `housing_allowance`, `transport_allowance`, `medical_allowance`, `utility_allowance`, `entertainment` FROM `job_level` WHERE `id` = $job_level_id");
                    foreach ($department->results() as $department) {
                            
                            $basic_salary           = $department->basic_salary;
                            $housing_allowance      = $department->housing_allowance;
                            $transport_allowance    = $department->transport_allowance;
                            $medical_allowance      = $department->medical_allowance;
                            $utility_allowance      = $department->utility_allowance;
                            $entertainment          = $department->entertainment;

                         $users_arr[] = array(
                             
                             "basic_salary"             => $basic_salary, 
                             "housing_allowance"        => $housing_allowance, 
                             "transport_allowance"      => $transport_allowance,
                             "medical_allowance"        => $medical_allowance,
                             "utility_allowance"        => $utility_allowance,
                             "entertainment"            => $entertainment
                             
                            );
                     
                    }
            } 
            }else{
                
                
            $job_level_id_u = $_REQUEST['job_level_id_u'];
            $users_arr = array();
            
            if($job_level_id_u > 0){
                
                    $department = Db::getInstance()->query("SELECT `basic_salary`, `housing_allowance`, `transport_allowance`, `medical_allowance`, `utility_allowance`, `entertainment` FROM `job_level` WHERE `id` = $job_level_id_u");
                    foreach ($department->results() as $department) {
                            
                            $basic_salary           = $department->basic_salary;
                            $housing_allowance      = $department->housing_allowance;
                            $transport_allowance    = $department->transport_allowance;
                            $medical_allowance      = $department->medical_allowance;
                            $utility_allowance      = $department->utility_allowance;
                            $entertainment          = $department->entertainment;

                         $users_arr[] = array(
                             
                             "basic_salary"             => $basic_salary, 
                             "housing_allowance"        => $housing_allowance, 
                             "transport_allowance"      => $transport_allowance,
                             "medical_allowance"        => $medical_allowance,
                             "utility_allowance"        => $utility_allowance,
                             "entertainment"            => $entertainment
                             
                            );
                     
                    }
            } 
                
                }
            
        }
        echo json_encode($users_arr);

