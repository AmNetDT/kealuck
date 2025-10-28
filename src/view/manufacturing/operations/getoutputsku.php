<?php
                
require_once '../../core/init.php';


 
$department_id = 0;

        if($_REQUEST['product_id']) {
            
            $department_id = $_REQUEST['product_id'];
            //$users_arr = $_REQUEST['department_id'];
            $users_arr = array();
            
            if($department_id > 0){
                
                    $department = Db::getInstance()->query("SELECT a.sku_code, a.product_type, a.uom, a.description, a.selling_price_default, a.metric_units, b.id as currency_id, b.sign
                    FROM `products` a
                    Left join `currency` b on a.currency_id = b.id
                    WHERE a.id = $department_id");
                    foreach ($department->results() as $department) {
                            
                            $sku_code               = $department->sku_code;
                            $product_type           = $department->product_type;
                            $uom                    = $department->uom;
                            $description            = $department->description;
                            $selling_price_default  = $department->selling_price_default;
                            $metric_units           = $department->metric_units;
                            $currency_id            = $department->currency_id;
                            $currency_sign          = $department->sign;
                            

                         $users_arr[] = array(
                             "sku_code"                 => $sku_code, 
                             "product_type"             => $product_type, 
                             "uom"                      => $uom,
                             "description"              => $description,
                             "selling_price_default"    => $selling_price_default,
                             "metric_units"             => $metric_units,
                             "currency_id"              => $currency_id,
                             "currency_sign"              => $currency_sign
                            );
                     
                    }
            } 
        }
        echo json_encode($users_arr);

