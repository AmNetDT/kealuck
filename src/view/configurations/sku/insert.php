<?php

require_once '../../core/init.php';

//$sku_code = $_POST['sku_code'];
$record = Db::getInstance();

    
        try {
            
        $record->insert('products', array(
                'sku_code'                  => Input::get('sku_code'),
                'description'               => Input::get('description'),
                'inventory_id'              => Input::get('inventory_id'),
                'uom'                       => Input::get('uom'),
				'metric_units'              => Input::get('metric_units'),
				'product_type'              => Input::get('product_type'),
				'product_category'          => Input::get('product_category'),
				'currency_id'               => Input::get('currency_id'),
                'cost_per_unit'             => Input::get('cost_per_unit'),
				'order_from'                => Input::get('order_from'),
				'type'                      => Input::get('type'),
                'note'                      => Input::get('note'),
                'added_by'                  => Input::get('added_by')
            ));

                 echo  '<div class="alert alert-dismissible alert-success">Stock unit added
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                
            } catch (Exception $e) {
                
                die($e->getMessage());
                
            }
       