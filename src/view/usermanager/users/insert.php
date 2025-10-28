<?php
require_once '../../core/init.php';

$user = new User();
$record = Db::getInstance();

  if (Input::exists()) {
  
    if (Token::check(Input::get('token'))) {
      $validate = new Validate();
      $validation = $validate->check($_POST, array(
        'username'        => array(
          'required'        => true,
          'min'             =>  6
        ),
        'syscategory'     => array(
          'require'         => true
        ),
        'jobtitle'          => array(
          'require'         => true
        ),
        'department'        => array(
          'require'         => true
        ),
        'added_by'        => array(
          'require'         => true
        ),
        'password'        => array(
          'require'         => true,
          'min'             => 6
        ),
        'confirm_password'  =>  array(
          'required'          =>  true,
          'matches'           => 'password'
        )
      ));

      if($validation->passed()) {
        $user = new User();
        $salt = Hash::salt(32);
        
        try {
          $user->create('users', array(
            'username'         => Input::get('username'),
            'syscategory_id'   => Input::get('syscategory'),
            'jobtitle_id'      => Input::get('jobtitle'),
            'department_id'    => Input::get('department'),
            'supervisor_id'    => Input::get('supervisor'),
            'worklocation_id'    => Input::get('worklocation'),
            'added_by'         => Input::get('added_by'),
            'password'         => Hash::make(Input::get('password'), $salt),
            'salt'             => $salt,
            'joined'           => date('Y-m-d H:i:s')
          ));
         
            $record->insert('staff_record', array(
                      'user_id'        => Input::get('username')
                    ));
            $record->insert('staff_guarantor', array(
                  'user_id'        => Input::get('username')
                ));
                    echo 'You have successfully registered a staff<br />';
          
                    
        } catch (Exception $e) {
          die($e->getMessage());
        }

      
        

      } else {

        foreach ($validation->errors() as $error) {
          echo $error . '<br />';
        }
      }
    }
  }



