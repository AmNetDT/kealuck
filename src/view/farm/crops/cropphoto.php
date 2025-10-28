<?php

require_once '../../core/init.php';

$user = new User();
if ($user->isLoggedIn()) {
$member_id = $_POST['member_id'];


              $username = escape($user->data()->id);
              $userSyscategory = escape($user->data()->syscategory_id);
              $privilege = Db::getInstance()->query("SELECT * FROM `syscategory` WHERE `id` = $userSyscategory");
             
             
?>

  
      
  
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
                        <h3><i class="fa fa-leaf p-1" aria-hidden="true"></i> Crop Photo</h3>
                        </div>
                        <div class="col-sm-3">
                           <div class="crop_index" id="<?php echo $member_id; ?>">
                              <button class="farm-button-cancel py-1 ml-0 ">
                                <span class="fa fa-chevron-left"></span> 
                              </button>
                            </div>
                        </div>
                </div>
          <div class="row my-3">
            <div class="col-sm-12">
           
                   <div class="row mt-0 mb-3 pt-0">
                     
                        <div class="col-sm-12 p-0 m-0 success_alert" id="success_alert"></div>
                        <div class="col-sm-12 p-0 m-0 warning_alert" id="warning_alert"></div>
                    
                  </div> 
                  <div class="row my-5">
                      
                       <form method="post" name="crops_form" id="crops_formPhoto" enctype="multipart/form-data">
       
              
                <div class="row my-3">
                <div class="col-sm-12">
                <span style="font-size:0.8rem">Note: the image size should not be more that 10MB, and also the size of the image will decide the duration of 
                the saving proccess after you click on the <b>Add Crop</b> button.</span>
                </div>
            </div>
                <div class="row">
                    <script>
                          crop_image.onchange = evt => {
                              const [file] = crop_image.files
                              if (file) {
                                blah.src = URL.createObjectURL(file);
                                
                            }
                          }  
                            
                      </script> 
                        <div class="image-upload">
                             <div class="form-group col-sm-12">
                                <?php
                
                                        $crop_type = Db::getInstance()->query("SELECT id, crop_image  FROM `crop_type` WHERE `id` = $member_id GROUP BY id, crop_image LIMIT 1");
                                        foreach ($crop_type->results() as $crop_type) {
       
                                ?>
                                    <label for="crop_image"><img id="blah" class="img-fluid" src="view/farm/crops/<?php echo $crop_type->crop_image; ?>"  alt="Original Image">
                                    <input accept="image/*" id="crop_image" name="crop_image" type="file" class="d-none form-control" />
                                    <input type="hidden" name="crop_id" id="crop_id" value="<?php echo $crop_type->id; ?>" />
                              <?php            
                              
                                }
                            
                            ?>
                            
                                </div>
                        </div>
                  
                </div>
               
               
                </div>
            
             <div class="row justify-content-end">
                 
                <input type="hidden" name="added_by" id="added_by" value="<?php echo $username; ?>"/>
                <button type="submit" class="py-1 px-2 border farm-color mx-0 saveCropPhoto">Change Image</button>
                
                </div>
           
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
      
            $('.saveCropPhoto').on('click', function(e){
             
            
                    let form = $('#crops_formPhoto')[0]; // You need to use standard javascript object here 
                    let formData = new FormData(form); 
                   
                 // alert('Checking if event is executed');
                   
            	
            	$.ajax({
            			url: 'view/farm/crops/photo_update.php',
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
            
          
             
             $('.crop_index').click(function () {
        		
	        	let member_id = $(this).attr('id');
	        	
        		$("#loader_httpFeed").show();
        		$.ajax({
        			type: "POST",
        			url: "view/farm/crops/editcrop.php",
        			data:{
        			    member_id : member_id
        			},
        			cache: false,
        			success: function (msg) {
        				$("#contentbar_inner").html(msg);
        				$("#loader_httpFeed").hide();
        			}
        		});
        		
        	});   
              
            


   
   event.preventDefault();
   });
  </script>
  



