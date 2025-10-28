<?php

require_once '../../core/init.php';

$id = $_POST['ids'];

$record = Db::getInstance();

if (Input::exists()) {

    $validate = new Validate();
    $validation = $validate->check($_POST, array(
		'name'          => array(
        'required'      => true
        ),
		'location'      => array(
        'required'      => true
        ),
		'phone'         => array(
		'required'      => true
		),
		'email'         => array(
		'required'      => true
		),
        'added_by'      =>  array(
        'required'      =>  true
        )
    ));

    
        try {
            
        $record->update('departments', $id, array(
                'name'          => Input::get('name'),
                'address'       => Input::get('location'),
                'phone'         => Input::get('phone'),
				'email'         => Input::get('email'),
                'added_by'      => Input::get('added_by')
            ));

                echo 'Department updated successfully';
                
            } catch (Exception $e) {
                
                die($e->getMessage());
                
            }
        } else {

            foreach ($validation->errors() as $error) {
                echo $error . '<br />';
            }
            
        }
    