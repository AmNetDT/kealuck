<?php

require_once '../../core/init.php';

$id = $_POST['id'];
$location = $_POST['location'];

//$record = Db::getInstance();


    
        try {
            
            /*$record->delete('worklocation', $id, array(
                'id'     => Input::get('id')
                ));*/
        $user = Db::getInstance()->query("DELETE FROM worklocation WHERE id = $id");

                echo $location . ' Work Location deleted successfully';
                
            } catch (Exception $e) {
                
                die($e->getMessage());
                
            }
            
      