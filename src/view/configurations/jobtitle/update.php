<?php

require_once '../../core/init.php';

$id = $_POST['id'];
$name = $_POST['name'];

$record = Db::getInstance();

if (Input::exists()) {

    $validate = new Validate();
    $validation = $validate->check($_POST, array(
		'name'          => array(
        'required'      => true
        )
    ));

    
        try {
            
        $record->update('job_title', $id, array(
                'name'          => Input::get('name'),
                'level'          => Input::get('level'),
                'description'   => Input::get('description')
            ));

                echo  '<div class="alert alert-success">Job title <b>' .$name .'</b> updated successfully</div>';
                
            } catch (Exception $e) {
                
                die($e->getMessage());
                
            }
        } else {

            foreach ($validation->errors() as $error) {
                echo '<div class="alert alert-warning">' . $error . '<br /></div>';
            }
           
        }