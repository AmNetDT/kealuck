<?php
require_once '../../core/init.php';

// Check if form data is posted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $season_name = Input::get('title');

    $record = Db::getInstance();

    try {
        // Check if file is uploaded
        
                    // Insert data into database
                    $data = [
                       
                        'title'              => Input::get('title'),
                        'format_description' => Input::get('format_description')
                    ];

                    $record->insert("planting_format", $data);
                    
                    echo '<div class="alert alert-dismissible alert-success">' . $season_name . ' Planting Format Created 
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                            <span aria-hidden="true">&times;</span> 
                            </button> 
                            </div>';
                   
    } catch (Exception $e) {
        die($e->getMessage());
    }
}
?>