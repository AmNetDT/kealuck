<?php

require_once '../../core/init.php';

$glocation_code =   $_POST['glocation_code'];
$location       =   $_POST['grow_location_name'];

$record = Db::getInstance();

if(isset($location) && $location !== ''){
                
               $find = $record->query("SELECT * FROM crop_grow_location WHERE glocation_code = '$glocation_code'");
          
    
        try {
            
             if($find->count()){
                          
                            echo  '<div class="alert alert-dismissible alert-danger">' . $location . '  location already added
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                           
                        }else{
            
        $record->insert('crop_grow_location', array(
                'grow_location_name'        => Input::get('grow_location_name'),
                'glocation_code'            => Input::get('glocation_code'),
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

            echo  '<div class="alert alert-dismissible alert-success">' . $location . ' location added
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                    	
                     }
                     
                
            } catch (Exception $e) {
                
                die($e->getMessage());
                
            }
       
       
    }else{
                
                echo "<div class='alert alert-danger m-0'>Fill the requirements</div>";
                
            }