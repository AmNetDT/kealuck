<?php

require_once '../../core/init.php';

$transaction_year = $_POST['transaction_year'];
$budget_type = $_POST['description'];

$record = Db::getInstance();


            if($transaction_year != "" && $transaction_year != null){
                
                 $findtax = $record->query("SELECT * FROM budget WHERE transaction_year = '$transaction_year'");

              try{
                
                 if($findtax->count()){
                          
                            echo  '<div class="alert alert-dismissible alert-danger">' . $transaction_year . ' Budget Already Created
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                           
                        }else{
                            
                            
                            date_default_timezone_set('Africa/Lagos'); // Set timezone to Lagos, Nigeria (West Africa)

                            $record->insert("budget", array(
                                 
                                'budget_code'       => 'BC' . mt_rand(1000,9999),
                                'transaction_year'  => Input::get('transaction_year'),
                                'description'       => Input::get('description'),
                                'modifieddate'      => date('Y-m-d H:i:s'), 
                                'createddate'       => date('Y-m-d H:i:s'),
                                'added_by'          => Input::get('added_by')
                                
                            )); 
          
                    		echo  '<div class="alert alert-dismissible alert-success">' . $transaction_year . ' ' .$budget_type . ' Budget Created
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                        }
                    	
                } catch (Exception $e) {
                    
                    die($e->getMessage());
                    
                }    
                
            }else{
                
                	echo  '<div class="alert alert-dismissible alert-danger">Budget could not be created.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                
            }


                	
                
    