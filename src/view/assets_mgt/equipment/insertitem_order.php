<?php

require_once '../../core/init.php';

$record = Db::getInstance();
$sku = $_POST['serial_no'];
$purchase_id = $_POST['equipment_id'];


            if(isset($sku) && !empty($sku)){
                
               $findtax = $record->query("SELECT * FROM equipment_order WHERE serial_no = '$sku' AND equipment_id = $purchase_id");
          
    
               try{
               
                  
              
                        if($findtax->count()){
                          
                            echo  '<div class="alert alert-dismissible alert-danger">Item already added
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                           
                        }else{
                         
                         $record->insert("equipment_order", array(
                            'equipment_id'              => Input::get('equipment_id'),
                            'serial_no'                 => Input::get('serial_no'),
                            'description'               => Input::get('description'),
                            'qty'                       => Input::get('qty'),
                            'currency_id'               => Input::get('currency_id'),
                            'unit_cost'                 => Input::get('unit_cost')
                         )); 
                  
                    	    echo  '<div class="alert alert-dismissible alert-success">Item added 
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                    	
                     }
                     
                     
                     
                } catch (Exception $e) {
                    
                    die($e->getMessage());
                    
                }    

            }else{
                
                echo '<div class="alert alert-dismissible alert-danger">Input the serial number
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                
            }
        
  