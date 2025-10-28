<?php

require_once '../../core/init.php';

$approval_order_id = $_POST['approval_order_id'];
$date_time = $_POST['date_time'];
$added_by = $_POST['added_by'];



           
           
    
        try{
                     $approval = Db::getInstance()->query("INSERT INTO `journal`(`approval_order_id`, `total_amount`, `debit`, `credit`, `date_time`, `added_by`) 
                                                SELECT `id`, `total_amount`, `paid` as `debit`, SUM(total_amount - paid) as `credit`, '$date_time' as `date_time`, $added_by as `added_by`  
                                                FROM `approval_records` WHERE id = $approval_order_id");
           
                     echo  '<div class="alert alert-dismissible alert-success">Payment recorded successfully
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                              </button>
                         </div>';
                    
              
              
              
         } catch (Exception $e) {
             
             die($e->getMessage());
             
         }    
                    
                    //echo $date_time;