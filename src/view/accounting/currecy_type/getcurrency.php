<?php
                
require_once '../../core/init.php';

$record = Db::getInstance();
     $id        = $_POST['id'];
 

      
            
            
            $users_arr = array();
            
             $sku = $record->query("SELECT * FROM `currency` WHERE `id` = $id order by id desc");
                                    foreach ($sku->results() as $skudetail) {
                                            
                                         $id = $skudetail->id;
                                         $name = $skudetail->name;
                
                                         $users_arr = array(
                                             
                                             "id"       => $id,
                                             "name"     => $name
                                             
                                         );
                                         
                                    }
            
        echo json_encode($users_arr);

