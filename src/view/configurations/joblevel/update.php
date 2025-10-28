<?php

require_once '../../core/init.php';

$id = $_POST['id'];
$name = $_POST['level'];

$record = Db::getInstance();

if (Input::exists()) {

    $validate = new Validate();
    $validation = $validate->check($_POST, array(
		'level'          => array(
        'required'      => true
        )
    ));

    
        try {
             
        $record->update('job_level', $id, array(
                'level'                 => Input::get('level'),
                'basic_salary'          => Input::get('basic'),
                'housing_allowance'     => Input::get('housing'),
                'transport_allowance'   => Input::get('transport'),
                'medical_allowance'     => Input::get('medical'),
                'utility_allowance'     => Input::get('utility'),
                'entertainment'         => Input::get('entertainment')
            ));

                echo  '<div class="alert alert-success">Job level <b>' .$name .'</b> updated successfully</div>';
                
            } catch (Exception $e) {
                
                die($e->getMessage());
                
            }
        } else {

            foreach ($validation->errors() as $error) {
                echo '<div class="alert alert-warning">' . $error . '<br /></div>';
            }
           
        }