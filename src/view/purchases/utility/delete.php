<?php

require_once '../../core/init.php';

$id = $_POST['ids'];
    


        try {
            
          
                
            $user = Db::getInstance()->query("DELETE FROM `utilities` WHERE `id` = $id");

                echo '<div class="alert alert-dismissible alert-warning">Removed
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                </div>';
                
                
            } catch (Exception $e) {
                
                die($e->getMessage());
                
            }
            