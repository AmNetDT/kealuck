<?php

require_once '../../core/init.php';

$record = Db::getInstance();
$date_time  = $_POST['date_time'];
$rate   = $_POST['rate'];

    
     if(isset($date_time) && !empty($rate)){
                
               $findtax = $record->query("SELECT * FROM currency_rate WHERE date_time like '$date_time%'");
          
    
               try{
               
                  
              
                        if($findtax->count()){
                          
                            echo  '<div class="alert alert-dismissible alert-danger">Already Updated
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                           
                        }else{
            
        $record->insert('currency_rate', array(
                'currency_id'   => Input::get('currency_id'),
                'rate'          => Input::get('rate'),
                'date_time'     => Input::get('date_time')
            ));

                
                 echo  '<div class="alert alert-dismissible alert-success">Currency Updated
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                              </button>
                         </div>';
                         
                        }
            } catch (Exception $e) {
                
                die($e->getMessage());
                
            }
        }