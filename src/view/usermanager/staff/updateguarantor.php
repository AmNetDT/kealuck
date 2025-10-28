<?php

require_once '../../core/init.php';

$id = $_POST['id'];
$user_id = $_POST['user_id'];
$user = Db::getInstance();

  
	
			if(isset($_FILES) & !empty($_FILES)){
				$name = $_FILES['guarantor_image']['name'];
				$size = $_FILES['guarantor_image']['size'];
				$type = $_FILES['guarantor_image']['type'];
				$tmp_name = $_FILES['guarantor_image']['tmp_name'];

            $max_size = 10000000;
			$extension = substr($name, strpos($name, '.') + 1);  

			if(isset($name) && !empty($name)){
				if(($extension == "png" || $extension == "jpg" || $extension == "jpeg") && $type == "image/png" || $type == "image/jpeg" && $size<=$max_size){
					$location = "upload/";
					if(move_uploaded_file($tmp_name, $location.$name)){
					$image = $location.$name;
	  
                                	
                                $user->update("staff_guarantor", $id, array(
                                            
                                            'guarantor_fullname'        => Input::get('guarantor_fullname'),
                                            'guarantor_address'         => Input::get('guarantor_address'),
                                            'guarantor_phone'           => Input::get('guarantor_phone'),
                                            'guarantor_email'           => Input::get('guarantor_email'),
                                            'guarantor_occupation'      => Input::get('guarantor_occupation'),
                                            'guarantor_image'           => $image,
                                            'relation_to_emp'           => Input::get('relation_to_emp')
                                            
                                        ));
                             
                                  
                    						echo "<div class='alert alert-success'>Gurantor Updated successfully</div>";
                    	
                              
                   
                                
                                     }else{
                    							echo "<div class='alert alert-danger'>Failed to Upload image</div>";
                    					}
                    				}else{
                    							echo "<div class='alert alert-danger'>Image should be .jpg or .png files and should be less that 1MB</div>";
                    				}
                    			}
                    		}
                    	



                	
                
             
    