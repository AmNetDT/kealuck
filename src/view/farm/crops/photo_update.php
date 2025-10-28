<?php
require_once '../../core/init.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $crop_name = Input::get('crop_name');
    $crop_id = Input::get('crop_id');

    date_default_timezone_set('Africa/Lagos');
    $record = Db::getInstance();

    try {
        if (isset($_FILES['crop_image']) && !empty($_FILES['crop_image'])) {
            $file = $_FILES['crop_image'];
            $name = $file['name'];
            $size = $file['size'];
            $type = $file['type'];
            $tmp_name = $file['tmp_name'];

            $max_size = 10 * 1024 * 1024; // 10MB
            $allowed_extensions = ['png', 'jpg', 'jpeg'];
            $allowed_types = ['image/png', 'image/jpeg'];

            $extension = strtolower(pathinfo($name, PATHINFO_EXTENSION));

            if (in_array($extension, $allowed_extensions) && in_array($type, $allowed_types) && $size <= $max_size) {
                $location = "upload/";
                $image = $location . $name;

                if (move_uploaded_file($tmp_name, $image)) {
                   

                    $result = $record->update("crop_type", $crop_id, array(
                        
                                'crop_image' => $image,
                                'added_by' => Input::get('added_by'),
                                'modifieddate' => date('Y-m-d H:i:s')
                                
                        ));

                    
                        echo '<div class="alert alert-dismissible alert-success mx-0">' . $crop_name . ' Crop Type Updated 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                                <span aria-hidden="true">&times;</span> 
                                </button> </div>';
                   
                } else {
                    echo '<div class="alert alert-danger">Failed to Upload image <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>';
                }
            } else {
                echo '<div class="alert alert-danger">Image should be .jpg or .png files and should be less than 10MB <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>';
            }
        }
    } catch (Exception $e) {
        die($e->getMessage());
    }
}
