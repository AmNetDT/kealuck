<?php

require_once '../../core/init.php';

$landing_cost = $_POST['landing_cost'];
$record = Db::getInstance();


              try{
                
                 $record->insert("landing_cost", array(
                     
                    'supplier_id'           => Input::get('supplier_id'),
                    'item_code'             => Input::get('item_code'),
                    'currency_id'           => Input::get('currency_id'),
                    'cost'                  => Input::get('landing_cost'),
                    'additional_info'       => Input::get('additional_info')
                    
                )); 
          
                    	echo  '<div class="alert alert-dismissible alert-success">Landing Cost Added
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                    	
                } catch (Exception $e) {
                    
                    die($e->getMessage());
                    
                }    
                
                


                	
                
    