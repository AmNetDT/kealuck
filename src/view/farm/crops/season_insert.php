<?php
require_once '../../core/init.php';

// Check if form data is posted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $season_name = Input::get('name');

    $record = Db::getInstance();

    try {
        // Check if file is uploaded
        
                    // Insert data into database
                    $data = [
                       
                        'name'               => Input::get('name'),
                        'season_description' => Input::get('season_description')
                    ];

                    $record->insert("season_type", $data);
                    
                    echo '<div class="alert alert-dismissible alert-success">' . $season_name . ' Season Created 
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                            <span aria-hidden="true">&times;</span> 
                            </button> 
                            </div>';
                   
    } catch (Exception $e) {
        die($e->getMessage());
    }
}
?>