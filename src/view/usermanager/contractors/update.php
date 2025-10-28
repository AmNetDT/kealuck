<?php

require_once '../../core/init.php';

$contractor_id      = $_POST['id'];
$contractorname     = $_POST['name'];
$contractor_code    = $_POST['contractor_code'];

$record = Db::getInstance();

           
               try{
               
                         
                         $record->update("contractors", $contractor_id, array(
                             
                            'name'                  => Input::get('name'), 
                            'email'                 => Input::get('email'),
                            'category'              => Input::get('category'),
                            'address'               => Input::get('address'),
                            'phone'                 => Input::get('phone'),
                            'bank'                  => Input::get('bank'),
                            'bank_nameonaccount'    => Input::get('bank_nameonaccount'),
                            'bank_account'          => Input::get('bank_account'),
                            'acceptance_date'       => Input::get('acceptance_date'),
                            'added_by'              => Input::get('added_by')
                            
                         )); 
                  
                    	    echo '<div class="alert alert-dismissible alert-success">Updated successfully
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                 </div>';
                 
                     
                } catch (Exception $e) {
                    
                    die($e->getMessage());
                    
                }    

           
    