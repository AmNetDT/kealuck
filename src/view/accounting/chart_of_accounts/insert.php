<?php

require_once '../../core/init.php';



$record = Db::getInstance();

$gl_code = $_POST['gl_code'];
$description = $_POST['description'];



        if(isset($gl_code) && $description != ''){
                
               $find = $record->query("SELECT * FROM chart_of_accounts WHERE gl_code = '$gl_code'");
          
                    if($find->count()){
                          
                            echo  '<div class="alert alert-dismissible alert-danger">GL Code already exist
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                           
                        }else{
                            
                            try {
                                
                            $record->insert('chart_of_accounts', array(
                                    'gl_code'           => Input::get('gl_code'),
                                    'description'       => Input::get('description'),
                                    'category_id'       => Input::get('category_id'),
                                    'group_id'          => Input::get('group_id'),
                                    'debit'             => Input::get('debit'),
                                    'credit'            => Input::get('credit'),
                                    'added_by'          => Input::get('added_by')
                                ));
                    
                                    echo  '<div class="alert alert-success"> Subsidiary account created</div>';
                                    
                                } catch (Exception $e) {
                                    
                                    die($e->getMessage());
                                    
                                }
                        }
                        
        }else{
                                    
                                   
                        echo  '<div class="alert alert-dismissible alert-danger">Check the input something is wrong
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                
                             }
        