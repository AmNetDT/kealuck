<?php

require_once '../../core/init.php';

$record = Db::getInstance();

$sku_code    = $_POST['sku_code'] ?? null;
$purchase_id = $_POST['purchase_id'] ?? null;

    if (!$sku_code) {
        
        echo '<div class="alert alert-dismissible alert-danger">Select SKU Code
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>';
        exit;
        
    }
    
        try {
            
            // Use prepared statement to prevent SQL injection
            $query = "SELECT * FROM purchase_order WHERE sku_code = ? AND purchase_id = ?";
            $findtax = $record->query($query, [$sku_code, $purchase_id]);
        
                    if ($findtax->count()) {
                        echo '<div class="alert alert-dismissible alert-danger">Item already added
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                              </div>';
                    } else {
                        
                        // Insert data into purchase_order
                        $insertData = [
                            
                            'purchase_id'   => Input::get('purchase_id'),
                            'sku_code'      => Input::get('sku_code'),
                            'description'   => Input::get('description'),
                            'inventory_id'  => Input::get('inventory_id'),
                            'warehouse_id'  => Input::get('warehouse_id'),
                            'bin_id'        => Input::get('bin_id'),
                            'qty'           => Input::get('qty'),
                            'currency_id'   => Input::get('currency_id'),
                            'unit_cost'     => Input::get('unit_cost')
                            
                        ];
                
                        if ($record->insert("purchase_order", $insertData)) {
                            
                            echo '<div class="alert alert-dismissible alert-success">Item added successfully
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>';
                                  
                        } else {
                            
                            echo '<div class="alert alert-dismissible alert-danger">Error adding item. Please try again.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>';
                                  
                        }
                    }
                    
        } catch (Exception $e) {
            
            error_log("Database Error: " . $e->getMessage()); // Logs error instead of exposing to user
            echo '<div class="alert alert-dismissible alert-danger">An error occurred. Please contact support.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
                  
        }
