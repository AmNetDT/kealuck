<?php

require_once '../../core/init.php';

        if (!empty($_REQUEST['sku_code'])) {
            
            $sku_code = $_REQUEST['sku_code']; // Get SKU code from request
            $users_arr = [];
        
            // Using prepared statements to prevent SQL injection
            $query = "SELECT 
                        a.description, 
                        a.cost_per_unit, 
                        a.metric_units, 
                        b.sku_code AS inventory_code, 
                        b.id AS inventory_id
                      FROM `products` a
                      LEFT JOIN `products` b ON a.inventory_id = b.id
                      WHERE a.sku_code = ?";
        
            $db = Db::getInstance();
            $department = $db->query($query, [$sku_code]);
        
            if ($department->count()) { // Check if there are results
            
                foreach ($department->results() as $product) {
                    
                    $users_arr[] = [
                        
                        "description"    => $product->description,
                        "cost_per_unit"  => $product->cost_per_unit,
                        "metric_units"   => $product->metric_units,
                        "inventory_code" => $product->inventory_code,
                        "inventory_id"   => $product->inventory_id
                        
                    ];
            
                }
            }
            
            echo json_encode($users_arr);
        }
