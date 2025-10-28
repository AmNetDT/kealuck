<?php
                
require_once '../../core/init.php';


 
$department_id = 0;

        if($_REQUEST['removestaff']) {
            
            $department_id = $_REQUEST['removestaff'];
            
            $users_arr = array();
            
            if($department_id != ''){
                
                    $department = Db::getInstance()->query("SELECT b.employee_id, a.firstname, a.othername, a.lastname,
                                                            a.user_id 
                                                            FROM staff_record a join payroll b
                                                            on a.id = b.employee_id
                                                            WHERE a.user_id ='$department_id'");
                                                      
                    foreach ($department->results() as $department) {
                            
                            $firstname              = $department->firstname;
                            $othername              = $department->othername;
                            $lastname               = $department->lastname;
                            $user_id                = $department->user_id;
                            $_id                    = $department->employee_id;

                         $users_arr[] = array(
                             "firstname"                    => $firstname, 
                             "othername"                    => $othername, 
                             "lastname"                     => $lastname,
                             "user_id"                      => $user_id,
                             "_id"                          => $_id
                            );
                     
                    }
                 
            } 
        }
        echo json_encode($users_arr);

