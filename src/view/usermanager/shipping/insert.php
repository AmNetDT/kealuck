<?php

require_once '../../core/init.php';

$ship_name = $_POST['ship_name'];
$ship_code = $_POST['ship_code'];
$record = Db::getInstance();


              try{
                
                 $record->insert("cus_shipping", array(
                    'ship_code' => Input::get('ship_code'),
                    'customer_id' => Input::get('customer_id'),
                    'ship_name' => Input::get('ship_name'), 
                    'ship_status' => Input::get('ship_status'),
                    'ship_address' => Input::get('ship_address'),
                    'ship_phone' => Input::get('ship_phone'),
                    'ship_state_id' => Input::get('ship_state_id'),
                    'ship_lga_id' => Input::get('ship_lga_id'),
                    'ship_contact_person' => Input::get('ship_contact_person'),
                    'added_by' => Input::get('added_by')
                )); 
          
                    	echo  "<div class='alert alert-success m-0'>" .$ship_name . " ". $ship_code ." added successfully</div>";
                    	
                } catch (Exception $e) {
                    
                    die($e->getMessage());
                    
                }    
                
                    	
                	
                
             
    