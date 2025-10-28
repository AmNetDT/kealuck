<?php
require_once '../../core/init.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $crop_name = Input::get('crop_name');
    $crop_id = Input::get('crop_id');
    
    
    date_default_timezone_set('Africa/Lagos');
    $record = Db::getInstance();

    try {
                        $record->update("crop_type", $crop_id, array(
                            
                            'crop_name'         => Input::get('crop_name'),
                            'description'       => Input::get('description'),
                            'variety_strain'    => Input::get('variety_strain'),
                            'botanical_name'    => Input::get('botanical_name'),
                            'added_by'          => Input::get('added_by'),
                            'modifieddate'      => date('Y-m-d H:i:s')
                            
                       ));

                                                echo '<div class="alert alert-dismissible alert-success">' . $crop_name . ' Crop Type Updated 
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                                    <span aria-hidden="true">&times;</span> 
                                    </button> </div>';
                   
    } catch (Exception $e) {
        die($e->getMessage());
    }
}