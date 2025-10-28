<?php
                
require_once '../../core/init.php';

$record = Db::getInstance();

     $total_amount   = (float)$_POST['total_amount']; 
     $approval_id    = (int)$_POST['approval_id'];
     $paid           = (float)$_POST['paid'];
 
            

            $approval_records = Db::getInstance()->query("SELECT SUM(a.paid) AS paid, b.amount
                                                    FROM approval_records a 
                                                    LEFT JOIN approval b ON a.approval_id = b.id
                                                    WHERE a.approval_id = $approval_id AND b.id = $approval_id"); 
                                                    
                            foreach ($approval_records->results() as $debit) {
                                
                                    
                                    
                                    if ($paid > $total_amount){
                                        
                                        	echo  "<div class='alert alert-danger m-0'>Exceeded the total value.</div>";
                                        	
                                    }else{
                        
                                         try{
                
                                             $record->insert("approval_records", array(
                                                'approval_id'       => Input::get('approval_id'),
                                                'total_amount'      => Input::get('total_amount'), 
                                                'paid'              => Input::get('paid'),
                                                'remarks'           => Input::get('remarks'),
                                                'date_time'         => Input::get('date_time'),
                                                'transaction_year'  => date('Y')
                                                
                                            )); 
                                      
                                                	echo  "<div class='alert alert-success m-0'>Sent to account</div>";
                                                	
                                            } catch (Exception $e) {
                                                
                                                die($e->getMessage());
                                                
                                            }   
            
                                    }
                            }
            
