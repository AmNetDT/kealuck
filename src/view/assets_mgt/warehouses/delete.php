<?php

require_once '../../core/init.php';

$id = $_POST['id'];
$table = $_POST['table'];
$request_code = $_POST['request_code'];

//$record = Db::getInstance();


    
        try {
            
           
        $user = Db::getInstance()->query("DELETE FROM `{$table}` WHERE id = $id");

                 echo  '<div class="alert alert-dismissible alert-danger">Remove
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                
            } catch (Exception $e) {
                
                die($e->getMessage());
                
            }
            
      