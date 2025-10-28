<?php

require_once '../../core/init.php';
$id = $_POST['id'];

$record = Db::getInstance();


            if(isset($_FILES) & !empty($_FILES)){
				$name = $_FILES['image']['name'];
				$size = $_FILES['image']['size'];
				$type = $_FILES['image']['type'];
				$tmp_name = $_FILES['image']['tmp_name'];

            $max_size = 10000000;
			$extension = substr($name, strpos($name, '.') + 1);  

			if(isset($name) && !empty($name)){
			    
				if(($extension == "png" || $extension == "jpg" || $extension == "jpeg") && $type == "image/png" || $type == "image/jpeg" && $size<=$max_size){
					$location = "upload/";
					if(move_uploaded_file($tmp_name, $location.$name)){
					$image = $location.$name;


              try{
                  
                 $record->update("staff_record", $id, array(
                    'image' => $image
                    
                )); 
          
                } catch (Exception $e) {
                    
                    die($e->getMessage());
                    
                }    
                
                                  
    						echo "<div class='alert alert-success m-0'>Picture updated successfully</div>";
                    	
                }
                   
                                
                    }else{
    						echo "<div class='alert alert-danger m-0'>Failed to upload image</div>";
                    				
				}	
            } 
    	}
                    		
                    	


                	
                
             
    