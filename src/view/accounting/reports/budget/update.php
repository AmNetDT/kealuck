<?php

require_once '../../core/init.php';

$id                 = $_POST['id'];
$description        = $_POST['description'];
$transaction_year   = $_POST['transaction_year'];
date_default_timezone_set('Africa/Lagos');
$modifieddate = date('Y-m-d H:i:s');

$record = Db::getInstance();


              try{
                
                         
                      
                            $record->update("budget", $id, array(
                                 
                                'transaction_year'      => Input::get('transaction_year'),
                                'description'           => Input::get('description'),
                                'modifieddate'          => $modifieddate, 
                                'added_by'              => Input::get('added_by')
                                
                            )); 
          
                    		echo  '<div class="alert alert-dismissible alert-success">' . $transaction_year . ' ' . $description . ' Edited
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                        
                    	
                } catch (Exception $e) {
                    
                    die($e->getMessage());
                    
                }    
                
          
                	
                
    