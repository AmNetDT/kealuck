<?php

require_once '../../core/init.php';

$id = $_POST['id'];
$name = $_POST['name'];

//$record = Db::getInstance();


    
        try {
            
            /*$record->delete('worklocation', $id, array(
                'id'     => Input::get('id')
                ));*/
        $user = Db::getInstance()->query("DELETE FROM workoperation_description WHERE id = $id");

                echo '<div class="alert alert-warning"> deleted successfully</div>';
                
            } catch (Exception $e) {
                
                die($e->getMessage());
                
            }
            
      