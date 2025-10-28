<?php

require_once '../../core/init.php';
$id = $_POST['id'];
$contact_code = $_POST['contact_code'];
$record = Db::getInstance();


              try{
                
                 $record->update("contact_person",$id, array(
                    'contact_person' => Input::get('contact_person'),
                    'contact_code' => Input::get('contact_code'), 
                    'contact_phone' => Input::get('contact_phone'),
                    'contact_email' => Input::get('contact_email'),
                    'foreign_id' => Input::get('foreign_id'),
                    'contact_type' => Input::get('contact_type'),
                    'contact_position' => Input::get('contact_position'),
                    'added_by' => Input::get('added_by')
                    
                )); 
          
                    	echo  "<div class='alert alert-success m-0'>". $contact_code ." Contact person updated successfully</div>";
                    	
                } catch (Exception $e) {
                    
                    die($e->getMessage());
                    
                }    
                
                    	


                	
                
             
    
                
                                  
                    						
                	
                
             
    