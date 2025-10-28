<?php

require_once '../../core/init.php';

$name = $_POST['title'];

$record = Db::getInstance();

if (Input::exists()) {

    $validate = new Validate();
    $validation = $validate->check($_POST, array(
		'title'          => array(
        'required'      => true
        )
    ));

    
        try {
            
        $record->insert('tax', array(
                'title'          => Input::get('title'),
                'type'   => Input::get('type'),
                'percentage'   => Input::get('percentage'),
                'rebate'   => Input::get('rebate'),
                'receiver'   => Input::get('receiver'),
                'note'   => Input::get('note'),
                'added_by'   => Input::get('added_by')
            ));

                echo  'Tax <b>' .$name .'</b> created successfully';
                
            } catch (Exception $e) {
                
                die($e->getMessage());
                
            }
        } else {

            foreach ($validation->errors() as $error) {
                echo $error . '<br />';
            }
           
        }