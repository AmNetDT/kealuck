<?php

require_once '../../core/init.php';


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
            
        $record->insert('products', array(
                'sku_code'                  => Input::get('sku_code'),
                'description'               => Input::get('description'),
                'uom'                       => Input::get('uom'),
				'product_type'              => Input::get('product_type'),
                'tax_id'                    => Input::get('tax_category'),
                'tax_percent'               => Input::get('tax_percent'),
                'cost_per_unit'             => Input::get('cost_'),
				'product_category'          => Input::get('product_category'),
                'metric_units'              => Input::get('metric_units'),
				'order_from'                => Input::get('order_from'),
				'selling_price_default'     => Input::get('selling_price_default'),
				'type'                      => Input::get('type'),
                'note'                      => Input::get('note'),
                'alert'                     => Input::get('alert'),
                'added_by'                  => Input::get('added_by')
            ));

                 echo  '<div class="alert alert-dismissible alert-success">Inventory Stock Unit Type Added
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
        