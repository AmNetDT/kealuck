<?php

require_once '../../core/init.php';

$record = Db::getInstance();
$product_id = $_POST['product_id'];
$supplier_id = $_POST['supplier_id'];

                if(isset($product_id) && !empty($supplier_id)){
                
               $findtax = $record->query("SELECT * FROM supplier_price_list WHERE supplier_id = $supplier_id AND product_id = $product_id");
          
    
               try{
               
                  
              
                        if($findtax->count()){
                          
                            echo  '<div class="alert alert-dismissible alert-danger">Item already added
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                           
                        }else{
                
                 $record->insert("supplier_price_list", array(
                     
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
          
                    	 echo  '<div class="alert alert-dismissible alert-success">Supplier list added successfully
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                                
                        }            
                    	
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
                    	
                
             