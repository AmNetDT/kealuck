<?php

require_once '../../core/init.php';

$record = Db::getInstance();
$year   = $_POST['year'];

    
    
    if($year === ''){
        
        echo  '<div class="alert alert-dismissible alert-danger">Enter a value year in this format 2002
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                                
    }else{
        try {
            
        $record->insert('transaction_year', array(
                'year'          => Input::get('year')
            ));

                echo  '<div class="alert alert-dismissible alert-success">Transaction year initiated
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                           
                
            } catch (Exception $e) {
                
                die($e->getMessage());
                
            }
    }