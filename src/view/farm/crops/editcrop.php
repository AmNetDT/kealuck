<?php

require_once '../../core/init.php';

$user = new User();
if ($user->isLoggedIn()) {
$member_id = $_POST['member_id'];


              $username = escape($user->data()->id);
              $userSyscategory = escape($user->data()->syscategory_id);
              $privilege = Db::getInstance()->query("SELECT * FROM `syscategory` WHERE `id` = $userSyscategory");
             
             
?>

  
        <style>
                    .image_resizing {
                        width: 80px; /* new width */
                        height: 40px; /* new height */
                        object-fit: cover; /* maintain aspect ratio */
                    }
                    
                    .canvas {
                        width: 80px; /* new width */
                        height: 40px; /* new height */
                    }
                    
                    .image_resizing_upload {
                        width: 86.5%; /* new width */
                        height: 85px; /* new height */
                        object-fit: cover; /* maintain aspect ratio */
                    }
                    
                    .canvas_upload {
                        width: 86.5%; /* new width */
                        height: 85px; /* new height */
                    }

        </style>
        <script>
            $(document).ready(function() {
                // Using jQuery and CSS
                // No code needed, CSS handles resizing
            
                // Using jQuery and HTML Canvas
                var img = $('.image_resizing')[0];
                var canvas = $('.canvas')[0];
                var ctx = canvas.getContext('2d');
                
                canvas.width = 80; // new width
                canvas.height = 40; // new height
                
                ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
                
                //Uplaad Place Image
                var img_upload = $('.image_resizing_upload')[0];
                var canvas_upload = $('.canvas_upload')[0];
                var ctx_upload = canvas_upload.getContext('2d');
                
                //Upload canvas
            
                canvas_upload.width = 80; // new width
                canvas_upload.height = 40; // new height
            
                ctx_upload.drawImage(img_upload, 0, 0, canvas_upload.width, canvas_upload.height);
            });
        </script>
  
  <div id="body_general">
    <div id="accounttile">
      <div class="col-sm-12 col-sm-10">
        <span id="close" class="fa fa-close p-1 btn-danger text-lg"></span>
      </div>
    </div>

    <div class="col-sm-6 offset-md-3">
        <div id="accounttile" class="container">
          
            

            <div class="jumbotron bg-white">
              
                <div class="col-sm-12">
                <div class="row justify-content-between">
                    <div class="col-sm-9">
                        <h3><i class="fa fa-leaf p-1" aria-hidden="true"></i> Crop Manager</h3>
                        </div>
                        <div class="col-sm-3">
                              <button class="farm-button-cancel py-1 ml-0 crop_index">
                                <span class="fa fa-chevron-left"></span> 
                              </button>
                        </div>
                </div>
          <div class="row my-3">
            <div class="col-sm-12">
           
                   <div class="row mt-0 mb-3 pt-0">
                     
                        <div class="col-sm-12 p-0 m-0 success_alert" id="success_alert"></div>
                        <div class="col-sm-12 p-0 m-0 warning_alert" id="warning_alert"></div>
                    
                  </div> 
                  <div class="row my-5">
                      
                       <form method="post" name="crops_form" id="crops_form" enctype="multipart/form-data">
       <?php
                
                $crop_type = Db::getInstance()->query("SELECT * FROM `crop_type` WHERE `id` = $member_id");
                foreach ($crop_type->results() as $crop_type) {
       
       ?>
     
              
                <div class="row">
            </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="image-upload">
                            
                           <div class="change_photo" id="<?php echo $member_id; ?>">
                            <button class="farm-button-cancel py-1 ml-0">
                                <i class="fa fa-edit change_photo"></i> Change Image</button>
                                </div>
                            <label for="crop_image">
                                <?php if (empty($crop_type->crop_image)) {
                                    
                                    echo '<img id="blah" class="image_resizing_upload mr-1 pr-0" src="view/farm/crops/upload/upload_placeholder.png" alt="Original Image"><canvas class="canvas_upload p-0 m-0"></canvas>';
                                    
                                } else {
                                    
                                    echo '<img id="blah" class="image_resizing_upload mr-1 pr-0" src="view/farm/crops/' . $crop_type->crop_image . '"  alt="Original Image"><canvas class="canvas_upload p-0 m-0"></canvas>';
                                     
                                } ?>
                                </label>
                                
                                </div>
                        </div>
                  <div class="form-group col-sm-8">
                    <label>Crop Type</label>
                    <input type="text" name="crop_name" id="crop_name" class="form-control" value="<?php echo $crop_type->crop_name; ?>" />
                  </div>
                </div>
               
                <div class="row">
                     <div class="form-group col-sm-12">
                         <label>Crop Description</label>
                        <input type="text" name="description" id="description" class="form-control" placeholder="Crop Description" value="<?php echo $crop_type->description; ?>" />
                        </div>
                </div>
                <div class="row">
                    
                  <div class="form-group col-sm-6">
                    <label>Variety/Strain</label>
                    <input type="text" name="variety_strain" id="variety_strain" class="form-control" placeholder="Crop Variety/Strain" value="<?php echo $crop_type->variety_strain; ?>" />
                  </div>
                  <div class="form-group col-sm-6">
                    <label>Botanical Name</label>
                    <input type="text" name="botanical_name" id="botanical_name" class="form-control" placeholder="Crop Botanical Name" value="<?php echo $crop_type->botanical_name; ?>" />
                  </div>
                </div>
            
             <div class="row justify-content-end p-3">
                <input type="hidden" name="added_by" id="added_by" value="<?php echo $username; ?>"/>
                <input type="hidden" name="crop_id" id="crop_id" value="<?php echo $crop_type->id; ?>" />
                <button type="submit" class="py-1 px-2 border farm-color mx-0 saveCrop">Edit Crop</button>
                </div>
            <?php
            
                }
            
            ?>
                 </form>
                  </div>
                  
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
    </div>
    </div>
  <?php

} else {
  $user->logout();
  Redirect::to('../../login/');
}

  ?>
  

 
 
  <script>
   $(document).ready(function(event) {
      
            $('.saveCrop').on('click', function(e){
             
            
                    let form = $('#crops_form')[0]; // You need to use standard javascript object here 
                    let formData = new FormData(form); 
                   
                 // alert('Checking if event is executed');
                   
            	
            	$.ajax({
            			url: 'view/farm/crops/update.php',
            			data: formData,
                        type: 'POST',
                        contentType: false,  // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                        processData: false, // NEEDED, DON'T OMIT THIS
                        success:function(data){
                            $(".success_alert").html(data);
                            $(".success_alert").show();
                            $('#sload').html(''); 
                        }, 
                        error:function(data){
                            $(".warning_alert").html(data);
                            $(".warning_alert").show();
                        }
                    }); 
                        
               e.preventDefault();
            });
            
          
             $('.current_page').click(function (e) {
    		
    	
    		//alert(id)
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/farm/crops/index.php",
    		
    			cache: false,
    			success: function (msg) {
    				$("#contentbar_inner").html(msg);
    				$("#loader_httpFeed").hide();
    			}
    		});
    		e.preventDefault();
    	});


             
             $('.crop_index').click(function () {
        		
        		$("#loader_httpFeed").show();
        		$.ajax({
        			type: "POST",
        			url: "view/farm/crops/",
        			cache: false,
        			success: function (msg) {
        				$("#contentbar_inner").html(msg);
        				$("#loader_httpFeed").hide();
        			}
        		});
        		
        	});   
              
            	$('.change_photo').click(function (e) {
		
                		let member_id = $(this).attr('id');
                		
                        //alert(id);
                		
                		$("#loader_httpFeed").show();
                		$.ajax({
                			type: "POST",
                			url: "view/farm/crops/cropphoto.php",
                			data:{
                			    member_id : member_id
                			},
                			cache: false,
                			success: function (msg) {
                				$("#contentbar_inner").html(msg);
                				$("#loader_httpFeed").hide();
                			}
                		});
                		e.preventDefault();
                	});   


   
   event.preventDefault();
   });
  </script>
  



