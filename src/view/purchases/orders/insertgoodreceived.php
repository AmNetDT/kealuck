<?php

require_once '../../core/init.php';
$sku_code = $_POST['sku_code'];
$purchase_id = $_POST['purchase_id'];
$received_date = $_POST['received_date'];
$received_qty = $_POST['qty'];

$record = Db::getInstance();

           
               if(isset($sku_code) && !empty($received_date)){
                
               $findgoods = $record->query("SELECT SUM(qty) AS qty FROM good_received WHERE sku_code = '$sku_code' AND purchase_id = $purchase_id");
                foreach ($findgoods->results() as $findtotalqty_good) {
                        $find_goodqty = $findtotalqty_good->qty;

                        $totalqty = $received_qty + $find_goodqty;
                        
                $findpurchase = $record->query("SELECT SUM(qty) AS qty FROM purchase_order WHERE sku_code = '$sku_code' AND purchase_id = $purchase_id");
                foreach ($findpurchase->results() as $findtotalqty_pur) {
                        $find_purchaseqty = $findtotalqty_pur->qty;  
                        
                        
    
               try{
               
                      if($totalqty > $find_purchaseqty){
                          
                          echo  '<div class="alert alert-dismissible alert-success">Item added exceeded the total quantity ordered.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
              
                       }else if($totalqty <= $find_purchaseqty){
                           
                           $record->insert("good_received", array(
                            'purchase_id'     =>    Input::get('purchase_id'),
                            'sku_code'        =>    Input::get('sku_code'),
                            'description'     =>    Input::get('description'),
                            'qty'             =>    Input::get('qty'),
                            'received_date'   =>    Input::get('received_date')
                         ));
                         
                         $record->insert("proceed", array(
                            'item_id'            =>    Input::get('purchase_id'),
                            'sku_code'           =>    Input::get('sku_code'),
                            'item_category'      =>    'Purchase',
                            'qty'                =>    Input::get('qty'),
                            'received_sku'       =>    Input::get('inventry_type'),
                            'received_qty'       =>    Input::get('qty'),
                            'sign'               =>    Input::get('sign'),
                            'cost_production'    =>    Input::get('cost_production'),
                            'transaction_year'   =>    date('Y'),
                         ));
                  
                    	    echo  '<div class="alert alert-dismissible alert-success">Item added successfully
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                           
                           
                        }
                     
                     
                     
                } catch (Exception $e) {
                    
                    die($e->getMessage());
                    
                }    

                  }
                }
            }else{
                
                echo '<div class="alert alert-dismissible alert-danger">You most choose an SKU and the received date
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                    </div>';
                
            }
        
  