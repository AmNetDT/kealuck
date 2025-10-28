<?php

require_once '../../core/init.php';

$id = $_POST['_id'];

//$record = Db::getInstance();


    
        try {
            
            /*$record->delete('worklocation', $id, array(
                'id'     => Input::get('id')
                ));*/
        $user = Db::getInstance()->query("DELETE FROM payroll WHERE employee_id = $id");

              
                
                    echo '<div class="alert alert-dismissible alert-danger">Staff remove from Payroll
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                    </div>';
                    
                
            } catch (Exception $e) {
                
                die($e->getMessage());
                
            }
            
      