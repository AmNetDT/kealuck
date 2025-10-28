<?php

require_once '../../core/init.php';

$id = $_POST['id'];
$description = $_POST['description'];



    
        try {
            
            Db::getInstance()->query("UPDATE worklocation_type SET description = '$description' WHERE id = $id");
            
                echo  '<div class="alert alert-dismissible alert-success">location type updated ' . $id . ' 989
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                
            } catch (Exception $e) {
                
                die($e->getMessage());
                
            }
       