<?php

require_once '../../core/init.php';


$record = Db::getInstance();

        $inputTransaction_year = $_POST['inputTransaction_year'];
        $transaction_year = $_POST['transaction_year'];
        
        
        if($inputTransaction_year === '' && $transaction_year === '' ){
            
            echo  '<div class="alert alert-dismissible alert-danger">Inventory Not Added, No field should be emptied
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
            
        } else if(!empty($inputTransaction_year)){
            
            $transaction_year = $_POST['inputTransaction_year'];

        try {
            
            
            
        $record->insert('inventory', array(
                'activity_date'         => Input::get('activity_date'),
                'products_id'           => Input::get('products_id'),
                'total_qty_debit'       => Input::get('total_qty_debit'),
                'total_qty_credit'      => Input::get('total_qty_credit'),
				'bin_id'                => Input::get('bin_id'),
                'warehouse_id'          => Input::get('warehouse_id'),
				'source'                => Input::get('source'),
                'transaction_year'      => $transaction_year,
				'remarks'               => Input::get('remarks'),
                'modified_date'         => Input::get('modified_date'),
                'created_date'          => Input::get('created_date'),
				'added_by'              => Input::get('added_by')
            ));

            echo  '<div class="alert alert-dismissible alert-success">Inventory Added
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                    	
                     
                     
                
            } catch (Exception $e) {
                
                die($e->getMessage());
                
            }
       
        } else if(!empty($transaction_year)){
            
            $transaction_year = $_POST['transaction_year'];

        try {
            
            
            
        $record->insert('inventory', array(
                'activity_date'         => Input::get('activity_date'),
                'products_id'           => Input::get('products_id'),
                'total_qty_debit'       => Input::get('total_qty_debit'),
                'total_qty_credit'      => Input::get('total_qty_credit'),
				'bin_id'                => Input::get('bin_id'),
                'warehouse_id'          => Input::get('warehouse_id'),
				'source'                => Input::get('source'),
                'transaction_year'      => $transaction_year,
				'remarks'               => Input::get('remarks'),
                'modified_date'         => Input::get('modified_date'),
                'created_date'          => Input::get('created_date'),
				'added_by'              => Input::get('added_by')
            ));

            echo  '<div class="alert alert-dismissible alert-success">Inventory Added
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                    	
                     
                     
                
            } catch (Exception $e) {
                
                die($e->getMessage());
                
            }
       
        }