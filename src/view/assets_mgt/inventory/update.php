<?php

require_once '../../core/init.php';

$id = $_POST['id'];

$record = Db::getInstance();


    
        try {
            
        $record->update('worklocation', $id, array(
                'location_code'     => Input::get('location_code'),
                'location'          => Input::get('location'),
                'worklocation_type_id' => Input::get('worklocation_type_id'),
                'address'           => Input::get('address'),
				'longitude'         => Input::get('longitude'),
                'latitude'          => Input::get('latitude'),
				'added_by'          => Input::get('added_by')
            ));

                
                echo  '<div class="alert alert-dismissible alert-success">Work location updated
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                
            } catch (Exception $e) {
                
                die($e->getMessage());
                
            }
       