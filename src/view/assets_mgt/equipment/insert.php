<?php

require_once '../../core/init.php';


$record = Db::getInstance();


              try{
                
                 $record->insert("equipment", array(
                     
                    'equipment_code'         => Input::get('equipment_code'),
                    'description'            => Input::get('description'),
                    'type'                   => Input::get('type'),
                    'brand'                  => Input::get('brand'),
                    'model'                  => Input::get('model'),
                    'plate_number'           => Input::get('plate_number'),
                    'serial_number'          => Input::get('serial_number'),
                    'engine'                 => Input::get('engine'),
                    'transmission'           => Input::get('transmission'),
                    'track_usage'            => Input::get('track_usage'),
                    'link_to_service_manual' => Input::get('link_to_service_manual'),
                    'leased_or_purchased'    => Input::get('leased_or_purchased'),
                    'date_aquired'           => Input::get('date_aquired'),
                    'additional_info'        => Input::get('additional_info'),
                    'supplier_id'            => Input::get('supplier_id'),
                    'added_by'               => Input::get('added_by')
                    
                    
                )); 
          
                    	echo  '<div class="alert alert-dismissible alert-success">New Equipment Added
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                    	
                } catch (Exception $e) {
                    
                    die($e->getMessage());
                    
                }    
                
                



                
    