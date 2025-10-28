<?php

require_once '../../core/init.php';

$id = $_POST['id'];

if (Input::exists()) {
 
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'username'        => array(
                'required'        => true,
                'min'             =>  6,
                'max'             =>  11
            ),
            'syscategory'     => array(
                'require'         => true
            ),
            'department'        => array(
                'require'         => true
            ),
            'supervisor'        => array(
                'require'         => true
            ),
            'job_title_id'        => array(
                'require'         => true
            ),
            'worklocation'        => array(
                'require'         => true
            ),
            'added_by'        => array(
                'require'         => true
            )
        ));

        if ($validation->passed()) {
            $user = Db::getInstance();

            try {
               
                
                $user->update("users", $id, array(
                    'username' => Input::get('username'),
                    'syscategory_id' => Input::get('syscategory'),
                    'department_id' => Input::get('department'),
                    'supervisor_id' => Input::get('supervisor'),
                    'jobtitle_id' => Input::get('job_title_id'),
                    'worklocation_id' => Input::get('worklocation'),
                    'added_by' => Input::get('added_by'),
                    'joined' => date('Y-m-d H:i:s')
                    
                ));
                
                 echo '<p>You have successfully updated a User</p>';
                 
              
          
                
            } catch (Exception $e) {
                die($e->getMessage());
            }
        } else {

            foreach ($validation->errors() as $error) {
                echo $error . '<br />';
            }
        }
    }
