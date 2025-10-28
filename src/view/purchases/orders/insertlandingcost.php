<?php

require_once '../../core/init.php';

$landing_cost = $_POST['landing_cost'];
$record = Db::getInstance();


              try{
                
                 $record->insert("landing_cost", array(
                     
                    'supplier_id'           => Input::get('supplier_id'),
                    'purchase_id'           => Input::get('purchase_id'),
                    'item_code'             => Input::get('item_code'),
                    'cost'                  => Input::get('landing_cost'),
                    'additional_info'       => Input::get('additional_info')
                    
                )); 
          
                    	echo  "<div class='alert alert-success m-0'>Added " . $landing_cost . "</div>";
                    	
                } catch (Exception $e) {
                    
                    die($e->getMessage());
                    
                }    
                
                


                	
                
    