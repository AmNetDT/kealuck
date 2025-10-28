<?php

require_once '../../core/init.php';

$id = $_POST['id'];
$name = $_POST['name'];

//$record = Db::getInstance();


    
        try {
            
            /*$record->delete('worklocation', $id, array(
                'id'     => Input::get('id')
                ));*/
        $user = Db::getInstance()->query("DELETE FROM tax WHERE id = $id");

                echo '<b>' . $name . '</b> job title deleted successfully';
                
            } catch (Exception $e) {
                
                die($e->getMessage());
                
            }
            
      