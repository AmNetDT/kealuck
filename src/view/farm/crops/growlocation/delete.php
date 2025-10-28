<?php

require_once '../../core/init.php';

$id = $_POST['id'];

//$record = Db::getInstance();


    
        try {
            
            
        $user = Db::getInstance()->query("DELETE FROM crop_grow_location WHERE id = $id");
                echo  '<div class="alert alert-dismissible alert-danger">Location deleted.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
              
                
            } catch (Exception $e) {
                
                die($e->getMessage());
                
            }
            
      