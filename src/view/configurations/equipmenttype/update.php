<?php

require_once '../../core/init.php';

$id = $_POST['id'];

$record = Db::getInstance();

    
        try {
            
        $record->update('equipmenttype', $id, array(
                'title'          => Input::get('title'),
                'added_by'   => Input::get('added_by')
            ));

                echo  '<div class="alert alert-success">  Equipment Type Updated</div>';
                
            } catch (Exception $e) {
                
                die($e->getMessage());
                
            }
     