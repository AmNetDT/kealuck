<?php

require_once '../../core/init.php';

$member_id =   $_POST['id'];
$location       =   $_POST['grow_location_name'];

$record = Db::getInstance();

        try {
            
            
            
        $record->update('crop_grow_location', $member_id, array(
                'grow_location_name'        => Input::get('grow_location_name'),
                'location_type'             => Input::get('location_type'),
                'area_size'                 => Input::get('area_size'),
				'estimated_land_value'      => Input::get('estimated_land_value'),
                'status'                    => Input::get('status'),
				'light_profile'             => Input::get('light_profile'),
                'grazing_rest_days'         => Input::get('grazing_rest_days'),
                'description'               => Input::get('description'),
                'latitude'                  => Input::get('latitude'),
                'longitude'                 => Input::get('longitude'),
                'added_by'                  => Input::get('added_by')
            ));

            echo  '<div class="alert alert-dismissible alert-success">' . $location . ' location Updated
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                    	
                     
                     
                
            } catch (Exception $e) {
                
                die($e->getMessage());
                
            }
       