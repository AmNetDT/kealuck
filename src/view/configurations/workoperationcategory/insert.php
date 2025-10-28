<?php

require_once '../../core/init.php';

$wop_code = $_POST['wop_code'];

$record = Db::getInstance();


    
        try {
            
        $record->insert('workoperation_description', array(
                'wop_code'          => Input::get('wop_code'),
                'no_of_workers'     => Input::get('no_of_workers'),
                'description'       => Input::get('description'),
                'cost_per_hour'     => Input::get('cost_per_hour')
            ));

                echo  '<div class="alert alert-success"> Operation Added</div>';
                
            } catch (Exception $e) {
                
                die($e->getMessage());
                
            }
      