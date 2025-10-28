<?php

require_once '../../core/init.php';


$record = Db::getInstance();



              try{
                
              
                       
                            
                 $record->insert("sales_stocks_received", array(
                    'item_code'       => Input::get('sku_inv_code'),
                    'qty_received'    => Input::get('qty_received'),
                    'received_date'   => Input::get('received_date'),
                    'additional_info' => Input::get('additional_info'),
                    'workorders_id'   => Input::get('workorders_id'),
                    'added_by'        => Input::get('added_by')
                    
                )); 
          
                    
                    	    echo  '<div class="alert alert-dismissible alert-success">Received items added.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                    	
                 
                     
                    	
                } catch (Exception $e) {
                    
                    die($e->getMessage());
                    
                }    
                
           

                	
                
    