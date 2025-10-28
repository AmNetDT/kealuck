<?php

require_once '../../core/init.php';

$payment_id = $_POST['payment_id'];

if (Input::exists()) {
    
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'member_id'     => array(
            'required'      =>  true,
            'min'           =>  6,
            'max'           =>  11
            ),

            'matric_no'     => array(
            'required'       => true
            ),

            'payment_type'  => array(
            'required'       => true
            ),

            'amount'        => array(
            'required'       => true
            ),

            'paid'          => array(
            'required'       => true,
            ),
            'added_by'      =>  array(
            'required'      =>  true,
            )
        ));

        if ($validation->passed()) {
            $user = Db::getInstance();

            try {
                    $user->update('payment', $payment_id, array(
                        'member_id' => Input::get('member_id'),
                        'matric_no' => Input::get('matric_no'),
                        'payment_type' => Input::get('payment_type'),
                        'amount' => Input::get('amount'),
                        'paid' => Input::get('paid'),
                        'added_by' => Input::get('added_by')
                    ));

                    echo 'Payment edited successfully';
                
            } catch (Exception $e) {
                die($e->getMessage());
            }
        } else {

            foreach ($validation->errors() as $error) {
                echo $error . '<br />';
            }
        }
    }



