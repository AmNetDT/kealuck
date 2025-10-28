<?php

require_once '../../core/init.php';

$record = Db::getInstance();

$id = $_POST['id'];
$product_id = $_POST['product_id'];
$supplier_id = $_POST['supplier_id'];

             if(isset($product_id) && !empty($supplier_id)){
            
                       try{
                       
                          
                      
                         
                         $record->update("supplier_price_list", $id, array(
                            
                            'supplier_id'       => Input::get('supplier_id'),
                            'product_id'        => Input::get('product_id'),
                            'currency_id'       => Input::get('currency_id'),
                            'unit_cost'         => Input::get('unit_cost'),
                            'uom'               => Input::get('uom'),
                            'tier_qty'          => Input::get('tier_qty'),
                            'order_qty'         => Input::get('order_qty'),
                            'shipping_days'     => Input::get('shipping_days'),
                            'added_by'          => Input::get('added_by')
                            
                        )); 
                  
                            	 echo  '<div class="alert alert-dismissible alert-success">Item Update
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                        </div>';
                                        
                                  
                            	
                        } catch (Exception $e) {
                            
                            die($e->getMessage());
                            
                        }   
                        
                        
                        
                        
                }else{
                
                echo '<div class="alert alert-dismissible alert-danger">Select SKU
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                
            }  
                    	
  
                
             
    