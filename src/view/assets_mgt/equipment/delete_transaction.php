<?php

require_once '../../core/init.php';


    $id             = $_POST['id'];
    $table_name     = $_POST['table_name'];
    $request_code   = $_POST['request_code'];
            
    
        try {
            
                if($_POST['id'] != '' && $_POST['request_code'] != '' && $table_name === 'approval'){
                    
                    $id = $_POST['id'];
                    $request_code = $_POST['request_code'];
                    
                    $user = Db::getInstance()->query("DELETE FROM equipmenttransaction WHERE id = $id");
                    $users = Db::getInstance()->query("DELETE FROM approval WHERE request_code = '$request_code'");
    
                    echo '<div class="alert alert-dismissible alert-warning">Item removed
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                    </div>';
                    
                    
                } else if($_POST['id'] != '' && $_POST['request_code'] != '' && $table_name === 'sales'){
                    
                    
                    $id = $_POST['id'];
                    $request_code = $_POST['request_code'];
                    
                    $user = Db::getInstance()->query("DELETE FROM equipmenttransaction WHERE id = $id");
                    $users = Db::getInstance()->query("DELETE FROM sales WHERE sales_code = '$request_code'");
    
                    echo '<div class="alert alert-dismissible alert-warning">Item removed
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                    </div>';
                    
                    
                }
                
                
                
            } catch (Exception $e) {
                
                die($e->getMessage());
                
            }
            
            
 