

<?php
                
require_once '../../core/init.php';


 
$department_id = 0;

        if($_REQUEST['state_id']) {
            
            $department_id = $_REQUEST['state_id'];
            //$users_arr = $_REQUEST['department_id'];
            $users_arr = array();
            
            if($department_id > 0){
                
                    $department = Db::getInstance()->query("SELECT b.id, b.name FROM `states` a join `lga` b on a.id = b.state_id WHERE a.id = $department_id");
                    foreach ($department->results() as $department) {
                            $userid = $department->id;
                            $name = $department->name;

                     $users_arr[] = array("id" => $userid, "name" => $name);

                    }
            } 
        }
        echo json_encode($users_arr);
