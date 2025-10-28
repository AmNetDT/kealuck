<?php

require_once '../../core/init.php';
$id = $_POST['id'];
$suppliers_code = $_POST['purchase_code'];
$record = Db::getInstance();



              try{
                
                 $record->update("purchases",$id, array(
                    'purchase_code' => Input::get('purchase_code'),
                    'date_time' => Input::get('date_time'), 
                    'warehouse_id' => Input::get('warehouse_id'),
                    'bin_id' => Input::get('bin_id'),
                    'type' => Input::get('type'),
                    'expecteddate' => Input::get('expecteddate'),
                    'supplier_id' => Input::get('supplier_id'),
                    'note' => Input::get('note'),
                    'added_by' => Input::get('added_by')
                )); 
          
          
                    		echo  '<div class="alert alert-dismissible alert-success">Purchase order ' . $suppliers_code . ' updated
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                    	
                } catch (Exception $e) {
                    
                    die($e->getMessage());
                    
                }    
                	
                
    
                
             
    