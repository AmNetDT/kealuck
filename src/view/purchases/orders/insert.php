<?php

require_once '../../core/init.php';

$purchase_code = $_POST['purchase_code'];

$record = Db::getInstance();


              if(isset($purchase_code) && !empty($purchase_code)){
                
               $findtax = $record->query("SELECT * FROM purchases WHERE purchase_code = '$purchase_code'");
          
    
               try{
               
                  
              
                        if($findtax->count()){
                          
                            echo  '<div class="alert alert-dismissible alert-danger">Purchase order already added
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                           
                        }else{
                            
                            
                 $record->insert("purchases", array(
                     
                    'purchase_code' => Input::get('purchase_code'),
                    'date_time' => Input::get('date_time'), 
                    'type' => Input::get('type'),
                    'expecteddate' => Input::get('expecteddate'),
                    'supplier_id' => Input::get('supplier_id'),
                    'transaction_year' => Input::get('transaction_year'),
                    'note' => Input::get('note'),
                    'added_by' => Input::get('added_by'), 
                    'modified_date' => Input::get('modified_date'),
                    'created_date' => Input::get('created_date')
                    
                )); 
          
                    		echo  '<div class="alert alert-dismissible alert-success">Purchase order ' .  $purchase_code . '  added
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                               
                        } 
                    	
                } catch (Exception $e) {
                    
                    die($e->getMessage());
                    
                }    
                
                
          }
                        

                	
                
    