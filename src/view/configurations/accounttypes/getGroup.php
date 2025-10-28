<?php
                
require_once '../../core/init.php';


 
$category_id = 0;

        if($_REQUEST['category_id']) {
            
            $category_id = $_REQUEST['category_id'];
        
            $users_arr = array();
            
                if($category_id > 0 && $category_id != null){
                
                    $department = Db::getInstance()->query("SELECT id, title 
                                                            FROM `chart_of_accounts_group` 
                                                            WHERE `accounts_type_id` = $category_id 
                                                            ORDER BY id ASC");
                    foreach ($department->results() as $department) {
                            
                            $id = $department->id;
                            $location = $department->title;

                     $users_arr[] = array(
                         
                         "id" => $id,
                         "title" => $location
                         
                         );
                     
                    }
            } 
        }
        echo json_encode($users_arr);

