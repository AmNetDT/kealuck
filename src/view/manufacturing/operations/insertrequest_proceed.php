<?php

require_once '../../core/init.php';

$request_code = $_POST['request_code'];
$order_description = $_POST['order_description'];
$amount = $_POST['amount'];
$record = Db::getInstance();

            if(isset($request_code) && $order_description != '' && $amount != 0){
                
               $findtax = $record->query("SELECT * FROM proceed WHERE request_code = '$request_code'");
          
    
               try{
               
                  
              
                        if($findtax->count()){
                          
                            echo  '<div class="alert alert-dismissible alert-danger">Proceed already sent
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                           
                        }else{
                            
                        
                            
                         $record->insert("proceed", array(
                            'request_code'      => Input::get('request_code'),
                            'request_date'      => Input::get('request_date'),
                            'request_by'        => Input::get('request_by'),
                            'description'       => Input::get('description'),
                            'proceed_status'    => 'In Progress',
                            'estimated_qty'     => Input::get('estimated_qty'),
                            'actual_qty'        => Input::get('actual_qty'),
                            'production_cost'   => Input::get('production_cost'),
                            'remarks'           => Input::get('remarks'),
                            'transaction_year'  => date('Y')
                         )); 
                  
                    	    echo '<div class="alert alert-dismissible alert-success">Proceed sent successfully
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                 </div>';
                    	
                     }
                     
                     
                     
                } catch (Exception $e) {
                    
                    die($e->getMessage());
                    
                }    

            }else{
                
                echo "<div class='alert alert-danger m-0'>No sent. Make sure all fields are filled.</div>";
                
            }
        
  