<?php
require_once '../../core/init.php';

// Check if form data is posted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
     // Set timezone to Lagos, Nigeria (West Africa)
    date_default_timezone_set('Africa/Lagos');

    $record = Db::getInstance();

    try {
        // Check if file is uploaded
        
                    // Insert data into database
                    $data = [
                       
                        'crop_type_id'          => Input::get('crop_type_id'),
                        'number_planted'        => Input::get('number_planted'),
                        'grow_location_id'      => Input::get('grow_location_id'),
                        'planting_format_id'    => Input::get('planting_format_id'),
                        'season_type_id'        => Input::get('season_type_id'),
                        'pr_start_date'         => Input::get('pr_start_date'),
                        'pr_end_date'           => Input::get('pr_end_date'),
                        'hr_start_date'         => Input::get('hr_start_date'),
                        'hr_end_date'           => Input::get('hr_end_date'),
                        'added_by'              => Input::get('added_by'),
                        'modifieddate'          => date('Y-m-d H:i:s'),
                        'createddate'           => date('Y-m-d H:i:s'),
                    ];

                    $record->insert("crop_planting", $data);
                    
                    echo '<div class="alert alert-dismissible alert-success"> Crop Planted Successfully Added 
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                            <span aria-hidden="true">&times;</span> 
                            </button> 
                            </div>';
                   
    } catch (Exception $e) {
        die($e->getMessage());
    }
}
?>