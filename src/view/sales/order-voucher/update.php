<?php

require_once '../../core/init.php';

$id = $_POST['id'];

$record = Db::getInstance();

if (Input::exists()) {

    $validate = new Validate();
    $validation = $validate->check($_POST, array(
		'sku_code'          => array(
        'required'      => true
        ),
		'description'      => array(
        'required'      => true
        )
    ));

    
        try {
            
        $record->update('products', $id, array(
                'sku_code'                  => Input::get('sku_code'),
                'description'               => Input::get('description'),
                'uom'                       => Input::get('uom'),
                'type_of_stock'                       => Input::get('type_of_stock'),
				'product_type'              => Input::get('product_type'),
                'tax_category'              => Input::get('tax_category'),
				'product_category'          => Input::get('product_category'),
                'storage_location'          => Input::get('storage_location'),
				'selling_price_default'     => Input::get('selling_price_default'),
                'selling_price_type'        => Input::get('selling_price_type'),
				'back_order'                => Input::get('back_order'),
                'note'                      => Input::get('note'),
                'added_by'                  => Input::get('added_by')
            ));

                echo 'Stock unit updated successfully';
                
            } catch (Exception $e) {
                
                die($e->getMessage());
                
            }
        } else {

            foreach ($validation->errors() as $error) {
                echo $error . '<br />';
            }
            
        }
        