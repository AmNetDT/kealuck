<?php

require_once '../../core/init.php';



$budget_entry_id = $_POST['budget_entry_id'];
    
            
    
        try {
            
          // $user = Db::getInstance()->query("DELETE FROM `{$tablename}` WHERE id = $budget_entry_id");
                
            $user = Db::getInstance()->query("DELETE FROM `budget_entry` WHERE id = $budget_entry_id");
            $user = Db::getInstance()->query("DELETE FROM `budget_month` WHERE budget_entry_id = $budget_entry_id");
            
                echo '<div class="alert alert-dismissible alert-warning">Item removed successfully
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                </div>';
                
            } catch (Exception $e) {
                
                die($e->getMessage());
                
            }
            
            
 