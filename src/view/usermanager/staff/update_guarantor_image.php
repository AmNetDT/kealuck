<?php

require_once '../../core/init.php';

$id = $_POST['id'];

  
	
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
	  
                                	
                                Db::getInstance()->update("staff_guarantor", $id, array(
                                    
                                            'guarantor_image'           => $image
                                            
                                            ));
                             
                                  
                    						echo "<div class='alert alert-success'>Image Uploaded Successfully</div>";
                    	
                              
                   
                                
                                     }else{
                    							echo "<div class='alert alert-danger'>Failed to Upload image</div>";
                    					}
                    				}else{
                    							echo "<div class='alert alert-danger'>Image should be .jpg or .png files and should be less that 1MB</div>";
                    				}
                    			}
                    		}
                    	



                	
                
             
    