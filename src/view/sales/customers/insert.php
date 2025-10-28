<?php

require_once '../../core/init.php';
$customername = $_POST['name'];
$customer_code = $_POST['customer_code'];
$record = Db::getInstance();



              try{
                
                 $record->insert("customers", array(
                    'customer_code' => Input::get('customer_code'),
                    'name' => Input::get('name'), 
                    'phone' => Input::get('phone'),
                    'email' => Input::get('email'),
                    'category' => Input::get('category'),
                    'address' => Input::get('address'),
                    'state_id' => Input::get('state_id'),
                    'lga_id' => Input::get('lga_id'),
                    'added_by' => Input::get('added_by')
                    
                )); 
          
                    	echo  "<div class='alert alert-success m-0'>" .  $customer_code ." Customer Updated successfully</div>";
                    	
                } catch (Exception $e) {
                    
                    die($e->getMessage());
                    
                }    
                
                    	


                	
                
             
    