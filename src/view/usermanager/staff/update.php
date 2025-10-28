<?php

require_once '../../core/init.php';
$id = $_POST['memberid'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$record = Db::getInstance();


        
                    			    
             try{
             
              $record->update("staff_record", $id, array(
                    'firstname'                     => Input::get('firstname'),
                    'lastname'                      => Input::get('lastname'), 
                    'othername'                     => Input::get('othername'),
                    'date_of_birth'                 => Input::get('date_of_birth'),
                    'marital_status'                => Input::get('marital_status'),
                    'gender'                        => Input::get('gender'),
                    'phone'                         => Input::get('phone'),
                    'email'                         => Input::get('email'),
                    'address'                       => Input::get('address'),
                    'bank_acc'                      => Input::get('bank_acc'),
                    'bank_name'                     => Input::get('bank_name'),
                    'edu_certificate_level'         => Input::get('edu_certificate_level'),
                    'edu_field_of_study'            => Input::get('edu_field_of_study'),
                    'edu_school'                    => Input::get('edu_school'),
                    'edu_date'                      => Input::get('edu_date'),
                    'emergency_contact_name'        => Input::get('emergency_contact_name'),
                    'emergency_phone'               => Input::get('emergency_phone'),
                    'next_of_kin'                   => Input::get('next_of_kin'),
                    'next_of_kin_phone'             => Input::get('next_of_kin_phone'),
                    'next_of_kin_email'             => Input::get('next_of_kin_email'),
                    'next_of_kin_address'           => Input::get('next_of_kin_address'),
                    'next_of_kin_date_of_birth'     => Input::get('next_of_kin_date_of_birth'),
                    'next_of_kin_gender'            => Input::get('next_of_kin_gender'),
                    'next_of_kin_marital_status'    => Input::get('next_of_kin_marital_status'),
                    'passport_no'                   => Input::get('passport_no'),
                    'gross_salary'                  => Input::get('gross_salary'),
                    'work_mobile'                   => Input::get('work_mobile'),
                    'work_email'                    => Input::get('work_email'),
                    'working_hours'                 => Input::get('working_hours'),
                    'nationality'                   => Input::get('nationality'),
                    'national_identification_no'    => Input::get('national_identification_no')
                    
                )); 
                
               
                
                echo  '<div class="alert alert-dismissible alert-success">' . $firstname . " " . $lastname . ' Staff Updated successfully
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
          
            } catch (Exception $e) {
                
                die($e->getMessage());
                
            }  
                    		    
                    			    
                    		
                    		
                    	


                	
                
             
    