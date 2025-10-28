<?php
                
require_once '../../core/init.php';

$record = Db::getInstance();
     $year = $_POST['year'];
 

      
            
            
            $users_arr = array();
            
             $sku = $record->query("SELECT * FROM `transaction_year` WHERE `year` = $year order by year desc");
                                    foreach ($sku->results() as $skudetail) {
                                            
                                         $id = $skudetail->id;
                                         $year = $skudetail->year;
                
                                         $users_arr = array(
                                             
                                             "id" => $id,
                                             "year" => $year
                                             
                                         );
                                         
                                    }
            
        echo json_encode($users_arr);

