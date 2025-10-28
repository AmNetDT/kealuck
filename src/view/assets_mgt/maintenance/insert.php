<?php

require_once '../../core/init.php';


$record = Db::getInstance();

$description            = $_POST['service_description'];
$member_id              = $_POST['equipment_id'];
$inputTransaction_year  = $_POST['inputTransaction_year'];
$transaction_year       = $_POST['transaction_year'];
$maintenance_code       = $_POST['maintenance_code'];


       
            if(isset($maintenance_code) && !empty($maintenance_code)){
                
               $findtax = $record->query("SELECT * FROM maintenance WHERE maintenance_code = '$maintenance_code'");
          
    
        
        		try {
        		     if($findtax->count()){
                          
                            echo  '<div class="alert alert-dismissible alert-danger">Item already added
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                           
                        }else{
                            
                    if($inputTransaction_year !=''){
                        
            			$record->insert('maintenance', array(
                            'maintenance_code'          => Input::get('maintenance_code'),
            				'maintenance_date'          => Input::get('maintenance_date'),
            				'service_description'       => Input::get('service_description'),
            				'service_performed_by'      => Input::get('service_performed_by'),
            				'services_cost'             => Input::get('services_cost'),
            				'transaction_year'          => $inputTransaction_year,
            				'equipment_id'              => Input::get('equipment_id'),
            				'added_by'                  => Input::get('added_by')
            			));
                        
                         $record->insert("approval", array(
                            'request_code'      => Input::get('maintenance_code'),
                            'request_date'      => date('Y-m-d H:i:s'),
                            'type_of_bill'      => 'Maintenance',
                            'amount'            => Input::get('services_cost'),
                            'order_description' => Input::get('service_description'),
                            'approval_status'   => 'Initiated',
            				'transaction_year'  => $inputTransaction_year,
                         )); 
                         
                        echo  '<div class="alert alert-dismissible alert-success">Maintenance added
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                                
                    }else{
                        
                        
            			$record->insert('maintenance', array(
                            'maintenance_code'          => Input::get('maintenance_code'),
            				'maintenance_date'          => Input::get('maintenance_date'),
            				'service_description'       => Input::get('service_description'),
            				'service_performed_by'      => Input::get('service_performed_by'),
            				'services_cost'             => Input::get('services_cost'),
            				'transaction_year'          => $transaction_year,
            				'equipment_id'              => Input::get('equipment_id'),
            				'added_by'                  => Input::get('added_by')
            			));
                        
                        
                         $record->insert("approval", array(
                            'request_code'      => Input::get('maintenance_code'),
                            'request_date'      => date('Y-m-d H:i:s'),
                            'type_of_bill'      => 'Maintenance',
                            'amount'            => Input::get('services_cost'),
                            'order_description' => Input::get('service_description'),
                            'approval_status'   => 'Initiated',
            				'transaction_year'  => $inputTransaction_year,
                         )); 
                         
                        echo  '<div class="alert alert-dismissible alert-success">Maintenance added
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                    }
        
                        }
                                
        		} catch (Exception $e) {
        			die($e->getMessage());
        		}
                        
    	}
		
	
