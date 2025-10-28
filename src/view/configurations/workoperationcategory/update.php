<?php

require_once '../../core/init.php';

$id = $_POST['id'];
$name = $_POST['wop_code'];

$record = Db::getInstance();

    
        try {
            
        $record->update('workoperation_description', $id, array(
                'wop_code'          => Input::get('wop_code'),
                'description'       => Input::get('description'),
                'no_of_workers'     => Input::get('no_of_workers'),
                'cost_per_hour'     => Input::get('cost_per_hour')
            ));

                echo  '<div class="alert alert-success"> Operation updated </div>';
                
            } catch (Exception $e) {
                
                die($e->getMessage());
                
            }
       