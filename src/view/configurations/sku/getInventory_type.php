<?php
require_once '../../core/init.php';

$users_arr = [];

            function fetchProducts($query, $params = []) {
                
                $db = Db::getInstance();
                $products = $db->query($query, $params);
                
                $result_arr = [];
                foreach ($products->results() as $product) {
                    
                    $result_arr[] = [
                        
                        "id"          => $product->id ?? null,
                        "sku_code"    => $product->sku_code ?? null,
                        "description" => $product->description
                        
                    ];
                    
                }
                return $result_arr;
            }

            $product_category = $_REQUEST['product_category'] ?? null;
            $inventory_id   = $_REQUEST['inventory_id'] ?? null;
            
            if (!empty($product_category)) {
                
                $users_arr = fetchProducts("SELECT id, sku_code, description FROM `products` WHERE `product_category` = ?", [$product_category]);
                
            } elseif (!empty($inventory_id) && is_numeric($inventory_id)) {
                
                $users_arr = fetchProducts("SELECT description FROM `products` WHERE `id` = ?", [$inventory_id]);
                
            }
            
            echo json_encode($users_arr);
