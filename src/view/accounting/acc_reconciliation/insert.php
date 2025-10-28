<?php

require_once '../../core/init.php';


$record = Db::getInstance();

$journal_code = $_POST['journal_code'];
$approval_order_id = $_POST['approval_order_id'];

        if(isset($journal_code) && !empty($journal_code)){
                
               $findtax = $record->query("SELECT * FROM journal WHERE journal_code = '$journal_code' AND approval_order_id = $approval_order_id");
          
    
               try{
               
                  
              
                        if($findtax->count()){
                          
                            echo  '<div class="alert alert-dismissible alert-danger">Item already added
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                           
                        }else{
    
            
                        $record->insert('journal', array(
                                'journal_code'      => Input::get('journal_code'),
                                'date_time'         => Input::get('date_time'),
                                'description'       => Input::get('description'),
                                'currency'          => Input::get('currency'),
                                'approval_order_id' => Input::get('approval_order_id'),
                                'tag'               => Input::get('tag')
                            ));

            
                
                 echo  '<div class="alert alert-dismissible alert-success">Journal Entry Added
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                              </button>
                         </div>';
                         
                
                        }
                            
                        } catch (Exception $e) {
                
                die($e->getMessage());
                        }
            }
      