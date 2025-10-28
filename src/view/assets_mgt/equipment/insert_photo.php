<?php

require_once '../../core/init.php';



$record = Db::getInstance();


            if(isset($_FILES) & !empty($_FILES)){
				$name = $_FILES['image']['name'];
				$size = $_FILES['image']['size'];
				$type = $_FILES['image']['type'];
				$tmp_name = $_FILES['image']['tmp_name'];

            $max_size = 10000000;
			$extension = substr($name, strpos($name, '.') + 1);  

			if(isset($name) && !empty($name)){
			    
				if(($extension == "png" || $extension == "jpg" || $extension == "jpeg") && $type == "image/png" || $type == "image/jpg" || $type == "image/jpeg" && $size<=$max_size){
					$location = "upload/";
					if(move_uploaded_file($tmp_name, $location.$name)){
					$image = $location.$name;


              $findtax = $record->query("SELECT * FROM equipmentphoto WHERE photoUrl = '$image'");
             
            
              try{
                
                if($findtax->count()){
                    
                         echo  '<div class="alert alert-dismissible alert-danger">Image already added
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                        </div>';
                         
                    	
                        }else{
                  
                                 $record->insert("equipmentphoto", array(
                                    'equipment_id'  => Input::get('equipment_id'),
                                    'photoUrl'      => $image
                                    
                                )); 
                                
                                echo "<div class='alert alert-success m-0'>Image added</div>";
                        }
          
                } catch (Exception $e) {
                    
                    die($e->getMessage());
                    
                }    
                
                                  
    						
                    	
                }
                   
                                
                    }else{
    						echo "<div class='alert alert-danger m-0'>Failed to upload image</div>";
                    				
				}	
            } 
    	}
                    		
                    	


                	
                
             
    