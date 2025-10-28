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
                'inventory_id'              => Input::get('inventory_id'),
                'uom'                       => Input::get('uom'),
				'metric_units'              => Input::get('metric_units'),
				'product_type'              => Input::get('product_type'),
				'product_category'          => Input::get('product_category'),
                'cost_per_unit'             => Input::get('cost_per_unit'),
				'order_from'                => Input::get('order_from'),
				'type'                      => Input::get('type'),
                'note'                      => Input::get('note'),
                'added_by'                  => Input::get('added_by')
            ));

              
                 echo  '<div class="alert alert-dismissible alert-success">Stock unit updated
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                
            } catch (Exception $e) {
                
                die($e->getMessage());
                
            }
        } else {

            foreach ($validation->errors() as $error) {
                echo $error . '<br />';
            }
            
        }
        