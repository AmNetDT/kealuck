<?php
require_once '../../core/init.php';

$id = $_POST['id'];
$record = Db::getInstance();

  if (Input::exists()) {
  
    if (Token::check(Input::get('token'))) {
      $validate = new Validate();
      $validation = $validate->check($_POST, array(
            'added_by'          => array(
            'require'           => true
        ),
            'password'          => array(
            'require'           => true,
            'min'               => 6
        ),
            'confirm_password'  =>  array(
            'required'          =>  true,
            'matches'           => 'password'
        )
      ));

      if($validation->passed()) {
        $salt = Hash::salt(32);
        
        try {
          $record->update('users', $id, array(
            'added_by'         => Input::get('added_by'),
            'password'         => Hash::make(Input::get('password'), $salt),
            'salt'             => $salt
          ));
                    
                    echo  '<div class="alert alert-dismissible alert-success">Password changed successfully
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
           
                    
        } catch (Exception $e) {
          die($e->getMessage());
        }

      
        

      } else {

        foreach ($validation->errors() as $error) {
            $br = '<br />';
                    echo  '<div class="alert alert-dismissible alert-success">' .$error . ' '. $br .
                                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
        }
      }
    }
  }



