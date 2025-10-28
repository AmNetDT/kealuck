<?php

require_once '../../core/init.php';

$id = $_POST['id'];
$name = $_POST['name'];

//$record = Db::getInstance();


    
        try {
            
            /*$record->delete('worklocation', $id, array(
                'id'     => Input::get('id')
                ));*/
        $user = Db::getInstance()->query("DELETE FROM job_title WHERE id = $id");

                echo '<div class="alert alert-warning">Job title <b>' . $name . '</b> deleted successfully</div>';
                
            } catch (Exception $e) {
                
                die($e->getMessage());
                
            }
            
      