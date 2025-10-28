<?php
require_once '../../core/init.php';

// Check if form data is posted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $crop_name = Input::get('crop_name');
    $current_year = date('Y');

    // Set timezone to Lagos, Nigeria (West Africa)
    date_default_timezone_set('Africa/Lagos');
    
     

    $record = Db::getInstance();

    try {
        
        $findtax = $record->query("SELECT * FROM crop_type WHERE crop_name = '$crop_name' AND transaction_year_month like '%$current_year%'");
        
        if($findtax->count()){
                          
                            echo  '<div class="alert alert-dismissible alert-danger">Item already added
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                           
                        }else{
                            
        // Check if file is uploaded
        if (isset($_FILES['crop_image']) && !empty($_FILES['crop_image'])) {
            $file = $_FILES['crop_image'];
            $name = $file['name'];
            $size = $file['size'];
            $type = $file['type'];
            $tmp_name = $file['tmp_name'];

            // File upload settings
            $max_size = 10 * 1024 * 1024; // 10MB
            $allowed_extensions = ['png', 'jpg', 'jpeg'];
            $allowed_types = ['image/png', 'image/jpeg', 'image/jpg']; // Added image/jpg

            // Get file extension
            $extension = strtolower(pathinfo($name, PATHINFO_EXTENSION));

            // Validate file
            if (in_array($extension, $allowed_extensions) && in_array($type, $allowed_types) && $size <= $max_size) {
                $location = "upload/";
                $image = $location . $name;

                // Move uploaded file
                if (move_uploaded_file($tmp_name, $image)) {
                    // Insert data into database
                    $data = [
                        'crop_code'                 => 'CR' . mt_rand(1000, 9999),
                        'transaction_year_month'    => date('Y-m'),
                        'crop_image'                => $image,
                        'crop_name'                 => Input::get('crop_name'),
                        'description'               => Input::get('description'),
                        'variety_strain'            => Input::get('variety_strain'),
                        'botanical_name'            => Input::get('botanical_name'),
                        'added_by'                  => Input::get('added_by'),
                        'modifieddate'              => date('Y-m-d H:i:s'),
                        'createddate'               => date('Y-m-d H:i:s'),
                    ];

                    $record->insert("crop_type", $data);

                    // Display success message
                    echo '<div class="alert alert-dismissible alert-success">' . $crop_name . ' Crop Type Created 
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                            <span aria-hidden="true">&times;</span> 
                            </button> 
                            </div>';
                } else {
                    // Display error message
                    echo "<div class='alert alert-danger'>Failed to Upload image</div>";
                }
            } else {
                // Display error message
                if ($size > $max_size) {
                    echo "<div class='alert alert-danger'>Image size exceeds 10MB</div>";
                } elseif (!in_array($extension, $allowed_extensions)) {
                    echo "<div class='alert alert-danger'>Image should be .jpg or .png files</div>";
                } elseif (!in_array($type, $allowed_types)) {
                    echo "<div class='alert alert-danger'>Invalid image type</div>";
                }
            }
        } else {
            // Display error message
            echo "<div class='alert alert-danger'>Please select an image</div>";
        }
                        }
    } catch (Exception $e) {
        die($e->getMessage());
    }
}
?>