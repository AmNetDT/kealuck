<?php

require_once '../../core/init.php';


$record = Db::getInstance();

$voucher_code = $_POST['voucher_code'];
$description = $_POST['description'];
$amount = $_POST['amount'];



        if(isset($description) && $amount != ''){
                
               $find = $record->query("SELECT * FROM utilities WHERE voucher_code = '$voucher_code'");
          
                    if($find->count()){
                          
                            echo  '<div class="alert alert-dismissible alert-danger">Request already sent
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                           
                        }else{

                    	$validate = new Validate();
                    	$validation = $validate->check($_POST, array(
                        		'description'   => array(
                        		'required'      => true
                    		),
                    		    'amount'        => array(
                    			'required'      => true
                    		)
                    	));
                    
                    	if ($validation->passed()) {
                            
                    		try {
                    			$record->insert('utilities', array(
                    				'voucher_code'      => Input::get('voucher_code'),
                    				'description'       => Input::get('description'),
                    				'currency_id'       => Input::get('currency_id'),
                    				'amount'            => Input::get('amount'),
                    				'transaction_year'  => date('Y'),
                    				'prepared'          => Input::get('prepared')
                    			));
                    
                    		  
                    		   echo  '<div class="alert alert-dismissible alert-success">Voucher created
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>';
                    			
                    		} catch (Exception $e) {
                    			die($e->getMessage());
                    		}
                    	
                    	} else {
                    
                    		foreach ($validation->errors() as $error) {
                    			echo $error . '<br />';
                    		}
                    		
                    	}
                        }
                     }else{
                                    
                                   
                        echo  '<div class="alert alert-dismissible alert-danger">Voucher already created
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                
                             }
        
      