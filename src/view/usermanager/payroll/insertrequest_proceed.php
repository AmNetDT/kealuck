<?php

require_once '../../core/init.php';

$request_code = $_POST['request_code'];
$order_description = $_POST['order_description'];
$amount = $_POST['amount'];
$record = Db::getInstance();

            if(isset($request_code) && $order_description != '' && $amount != 0){
                
               $findtax = $record->query("SELECT * FROM approval WHERE request_code = '$request_code'");
          
    
               try{
               
                  
              
                        if($findtax->count()){
                          
                            echo  '<div class="alert alert-dismissible alert-danger">Approval request already sent
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                           
                        }else{
                            
                        $deji = $record->query("SELECT * FROM transaction_year ORDER BY year DESC LIMIT 1;");
                        foreach ($deji->results() as $deji)
                            $deji = $deji->year;
                         
                         $record->insert("approval", array(
                            'request_code'      => Input::get('request_code'),
                            'request_date'      => Input::get('request_date'),
                            'type_of_bill'      => Input::get('type_of_bill'),
                            'request_by'        => Input::get('request_by'),
                            'amount'            => Input::get('amount'),
                            'order_description' => Input::get('order_description'),
                            'transaction_year'  => $deji,
                            'order_remarks'     => Input::get('order_remarks')
                         )); 
                  
                    	    echo '<div class="alert alert-dismissible alert-success">Approval request sent successfully
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
        
  