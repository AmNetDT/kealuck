<?php

require_once '../../core/init.php';


$contractorname = $_POST['name'];
$contractor_code = $_POST['contractor_code'];
$record = Db::getInstance();

            if(isset($contractor_code) && $contractorname != ''){
                
               $findtax = $record->query("SELECT * FROM contractors WHERE contractor_code = '$request_code'");
          
    
               try{
               
                  
              
                        if($findtax->count()){
                          
                            echo  '<div class="alert alert-dismissible alert-danger">Contrator already sent
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                           
                        }else{
                         
                        
                         
                         
                         $record->insert("contractors", array(
                            'contractor_code'       => Input::get('contractor_code'),
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
                  
                    	    echo '<div class="alert alert-dismissible alert-success">Contrator added successfully
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                 </div>';
                    	
                     }
                     
                     
                     
                } catch (Exception $e) {
                    
                    die($e->getMessage());
                    
                }    

            }else{
                
                echo "<div class='alert alert-danger m-0'>No request to be sent</div>";
                
            }
        
                  	
                
             
    