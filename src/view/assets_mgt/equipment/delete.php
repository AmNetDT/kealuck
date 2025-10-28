<?php

require_once '../../core/init.php';


    $id = $_POST['id'];
    $tablename = $_POST['tablename'];
            
    
        try {
                if($_POST['id'] != '' && $_POST['tablename'] != ''){
                    
                    
                $user = Db::getInstance()->query("DELETE FROM `{$tablename}` WHERE id = $id");
    
                    echo '<div class="alert alert-dismissible alert-warning">Item removed successfully
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                    </div>';
                    
                }
                
            } catch (Exception $e) {
                
                die($e->getMessage());
                
            }
            
            
 