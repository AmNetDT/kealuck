<?php

require_once '../../core/init.php';

//$name = $_POST['title'];

$record = Db::getInstance();
$id = $_POST['id'];

    
        try {
            
        $record->update('journal', $id, array(
            
                'reconcile'         =>   Input::get('reconcile'),
                'date_time'         =>   date('Y-m-d H:i:s'),
                'transaction_year'  =>   date('Y')
                
            ));

            
                 echo  '<div class="alert alert-dismissible alert-success">Journal Entry Posted 
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                              </button>
                         </div>';
                
            } catch (Exception $e) {
                
                die($e->getMessage());
                
            }
      