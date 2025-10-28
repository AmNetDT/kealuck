<?php

require_once '../../core/init.php';

$item_code = $_POST['item_code'];
$record = Db::getInstance();


             if($item_code != ''){
            
            
                    $findtax = $record->query("SELECT * FROM purchase_discount WHERE item_code = '$item_code'");
             
            
              try{
                
                if($findtax->count()){
                    
                         echo  '<div class="alert alert-dismissible alert-danger">Discount already added
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                        </div>';
                         
                    	
                        }else{
                        
                        $record->insert("purchase_discount", array(
                             
                            'supplier_id'           => Input::get('supplier_id'),
                            'item_code'             => Input::get('item_code'),
                            'discount'              => Input::get('discount_'),
                            'additional_info'       => Input::get('additional_info')
                            
                        )); 
          
                        echo  '<div class="alert alert-dismissible alert-success">Added
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                        
                    }
                    
                    
                } catch (Exception $e) {
                    
                    die($e->getMessage());
                    
                }    
                
             }else{
                
                echo "<div class='alert alert-danger m-0'>No request to be sent</div>";
                
            }


                	
                
    