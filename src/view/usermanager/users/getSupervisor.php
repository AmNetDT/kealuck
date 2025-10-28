<?php
                
require_once '../../core/init.php';


 
$department_id = 0;

        if($_REQUEST['department_id']) {
            
            $department_id = $_REQUEST['department_id'];
            
            $users_arr = array();
            
            if($department_id > 0 && $department_id != null){
                
                    $department = Db::getInstance()->query("SELECT CONCAT(b.firstname,' ', b.lastname) as name, b.id as id 
                                                            FROM `users` a 
                                                            LEFT JOIN `staff_record` b ON a.username = b.user_id
                                                            LEFT JOIN `departments` c ON a.department_id = c.id
                                                            WHERE a.department_id IN (11, $department_id)");
                    foreach ($department->results() as $department) {
                            $userid = $department->id;
                            $name = $department->name;

                     $users_arr[] = array(
                         "id" => $userid, 
                         "name" => $name
                         );

                    }
            } 
        }
        
        echo json_encode($users_arr);