<?php

require_once '../../core/init.php';
$id = $_POST['id'];
$suppliers_code = $_POST['supplier_code'];
$record = Db::getInstance();



              try{
                
                 $record->update("suppliers",$id, array(
                    'supplier_code' => Input::get('supplier_code'),
                    'name' => Input::get('name'), 
                    'phone' => Input::get('phone'),
                    'email' => Input::get('email'),
                    'category' => Input::get('category'),
                    'address' => Input::get('address'),
                    'state_id' => Input::get('state_id'),
                    'lga_id' => Input::get('lga_id'),
                    'bank_name' => Input::get('bank_name'), 
                    'bank_account' => Input::get('bank_account'),
                    'bank_acc_name' => Input::get('bank_acc_name'),
                    'added_by' => Input::get('added_by'),
                    
                )); 
          
                    	echo  "<div class='alert alert-success m-0'>Supplier " . $suppliers_code ." updated successfully</div>";
                    	
                } catch (Exception $e) {
                    
                    die($e->getMessage());
                    
                }    
                
                    	


                	
                
    
                
             
    