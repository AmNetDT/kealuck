<?php

require_once '../../core/init.php';

$id = $_POST['id'];

$record = Db::getInstance();

if (Input::exists()) {

    $validate = new Validate();
    $validation = $validate->check($_POST, array(
		'description'          => array(
        'required'      => true
        ),
		'status'      => array(
        'required'      => true
        ),
		'amount'      => array(
        'required'      => true
        ),
		'valid_until'      => array(
        'required'      => true
        ),
		'wholesale'      => array(
        'required'      => true
        )
    ));

    
        try {
            
        $record->update('promo',$id, array(
                'voucher_code'   => Input::get('voucher_code'),
                'wholesale'      => Input::get('wholesale'),
                'status'         => Input::get('status'),
                'description'    => Input::get('description'),
				'amount'         => Input::get('amount'),
                'valid_until'    => Input::get('valid_until'),
				'note'           => Input::get('note'),
                'added_by'       => Input::get('added_by')
            ));
            
                echo 'Promo voucher updated successfully';
                
            } catch (Exception $e) {
                
                die($e->getMessage());
                
            }
        } else {

            foreach ($validation->errors() as $error) {
                echo $error . '<br />';
            }
            
        }
        