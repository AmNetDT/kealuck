<?php

require_once '../../core/init.php';

$type = $_POST['type'];
$equipment_code = $_POST['equipment_code'];
$record = Db::getInstance();

            if($type === 'Income'){
                
           
              try{
                
                 $record->insert("equipmenttransaction", array(
                     
                    'type'              => Input::get('type'),
                    'amount'            => Input::get('amount'),
                    'payment_type'      => Input::get('payment_type'),
                    'transaction_date'  => Input::get('transaction_date'),
                    'transaction_year'  => Input::get('transaction_year'),
                    'payee'             => Input::get('payee_customers'),
                    'category'          => Input::get('category'),
                    'cheque_number'     => Input::get('cheque_number'),
                    'description'       => Input::get('description'),
                    'equipment_id'      => Input::get('equipment_id'),
                    'id_code'           => Input::get('in_code'),
                    'added_by'          => Input::get('added_by')
                    
                    
                )); 
                
                $record->insert("sales", array(
                            'sales_code'        => Input::get('in_code'),
                            'payee_customers'   => Input::get('payee_customers'),
                            'date_time'         => Input::get('transaction_date'),
                            'type'              => 'Equipment ' . $equipment_code,
                            'amount'            => Input::get('amount'),
                            'description'       => Input::get('description'),
                            'transaction_year'  => Input::get('transaction_year'),
                            'approval_status'   => 'Initiated',
                            'added_by'          => Input::get('added_by')
                         )); 
          
                    	echo  '<div class="alert alert-dismissible alert-success">New transaction Added
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                    	
                } catch (Exception $e) {
                    
                    die($e->getMessage());
                    
                }    
                
                
                
            }else if($type === 'Expense'){
                
                

                try{
                
                 $record->insert("equipmenttransaction", array(
                     
                    'type'              => Input::get('type'),
                    'amount'            => Input::get('amount'),
                    'transaction_date'  => Input::get('transaction_date'),
                    'transaction_year'  => Input::get('transaction_year'),
                    'payee'             => Input::get('payee_contractors'),
                    'category'          => Input::get('category'),
                    'cheque_number'     => Input::get('cheque_number'),
                    'description'       => Input::get('description'),
                    'equipment_id'      => Input::get('equipment_id'),
                    'id_code'           => Input::get('ex_code'),
                    'added_by'          => Input::get('added_by')
                    
                     
                    
                )); 
                
                $record->insert("approval", array(
                            'request_code'      => Input::get('ex_code'),
                            'request_date'      => Input::get('transaction_date'),
                            'type_of_bill'      => Input::get('type'),
                            'amount'            => Input::get('amount'),
                            'order_description' => Input::get('description'),
                            'approval_status'   => 'Initiated',
                            'transaction_year'  => Input::get('transaction_year')
                         )); 
          
                    	echo  '<div class="alert alert-dismissible alert-success">New transaction Added
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                    	
                } catch (Exception $e) {
                    
                    die($e->getMessage());
                    
                } 
                
                
                
            }

                
    