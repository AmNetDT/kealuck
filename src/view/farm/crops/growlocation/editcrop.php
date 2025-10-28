<?php

require_once '../../core/init.php';

$user = new User();
if ($user->isLoggedIn()) {
$member_id = $_POST['member_id'];

$username = escape($user->data()->id);
             
             
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
                        <h3><i class="fa fa-pencil p-1" aria-hidden="true"></i> Edit Grow Location</h3>
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
                      
                      
                  <form id="grow_location_form" name="grow_location_form" method="POST" autocomplete="off">
                       <?php
                
                $crop_type = Db::getInstance()->query("SELECT * FROM `crop_grow_location` WHERE `id` = $member_id");
                foreach ($crop_type->results() as $crop_type) {
       
       ?>
      
                      <div class="row">
                        <div class="col-12 pt-3 mx-0 mb-0 pb-0">
                           
                              <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d45053.64411109254!2d3.5545750921610315!3d6.490824360220532!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e1!3m2!1sen!2sng!4v1655999311805!5m2!1sen!2sng" 
                              width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

                        </div>
                      </div>
                 
                      <div class="row">
                            <div class="form-group col-sm-8">
                                <label for="grow_location_name">Grow Location</label>
                                 <div class="input-group mb-2">
                                 <div class="input-group-prepend">
                                  <div class="input-group-text">Name</div>
                                </div>
                                <input type="text" class="form-control" id="grow_location_name" name="grow_location_name" value="<?php echo $crop_type->grow_location_name; ?>">
                                   
                                </div> 
                              </div>
                           <div class="form-group col-sm-4">
                        <label for="location_type">Location Type</label>
                        <select id="location_type" name="location_type" class="form-control" id="">
                          <option value="<?php echo $crop_type->location_type; ?>"><?php echo $crop_type->location_type; ?></option>
                          <option value="Green House">Green House</option>
                          <option value="Grow Room">Grow Room</option>
                          <option value="Pasture">Pasture</option>
                          <option value="Paddock">Paddock</option>
                          <option value="Other">Other</option>
                        </select>
                      </div>
                    </div>
                    <div class="row">
                       <div class="form-group col-sm-4">
                           <label for="area_size">Area/size</label>
                            <div class="input-group mb-2">
                              <input type="number" class="form-control" id="area_size" name="area_size" value="<?php echo $crop_type->area_size; ?>">
                             <div class="input-group-prepend">
                              <div class="input-group-text">Sqm<sup>2</sup></div>
                            </div>    
                        </div>
                            
                        </div>
                       <div class="form-group col-sm-4">
                        <label for="estimated_land_value">Estimated Land Value</label>
                        <div class="input-group mb-2">
                             <div class="input-group-prepend">
                              <div class="input-group-text">&#8358;</div>
                            </div>
                            <input type="number" class="form-control" id="estimated_land_value" name="estimated_land_value" value="<?php echo $crop_type->estimated_land_value; ?>">
                            </div>
                        </div>
                       <div class="form-group col-sm-4">
                        <label for="status">Status</label>
                           <select id="status" name="status" class="form-control" id="">
                              <option value="<?php echo $crop_type->status; ?>"><?php echo $crop_type->status; ?></option>
                              <option value="Active">Active</option>
                              <option value="Fallow">Fallow</option>
                              <option value="Leased">Leased</option>
                              <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                       <div class="form-group col-sm-4">
                        <label for="light_profile">Light Profile</label>
                           <select id="light_profile" name="light_profile" class="form-control" id="">
                              <option value="<?php echo $crop_type->light_profile; ?>"><?php echo $crop_type->light_profile; ?></option>
                              <option value="Full Sun">Full Sun</option>
                              <option value="Full to Part Sun">Full to Part Sun</option>
                              <option value="Partial Sun">Partial Sun</option>
                              <option value="Sun to Part Shade">Sun to Part Shade</option>
                              <option value="Patial Shade">Patial Shade</option>
                              <option value="Full Shade">Full Shade</option>
                            </select>
                        </div>
                       <div class="form-group col-sm-4">
                        <label for="grazing_rest_days">Grazing Rest Days</label>
                            <input type="number" class="form-control" id="grazing_rest_days" name="grazing_rest_days" value="<?php echo $crop_type->grazing_rest_days; ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <div class="input-group mb-2">
                             <div class="input-group-prepend">
                              <div class="input-group-text">Longitude</div>
                            </div>
                            <input type="text" class="form-control" id="longitude" name="longitude" value="<?php echo $crop_type->longitude; ?>">
                               
                            </div>    
                        </div>
                        <div class="form-group col-sm-6">
                            <div class="input-group mb-2">
                             <div class="input-group-prepend">
                              <div class="input-group-text">Latitude</div>
                            </div>
                            <input type="text" class="form-control" id="latitude" name="latitude" value="<?php echo $crop_type->latitude; ?>">
                               
                            </div> 
                                
                            <input type="hidden" id="added_by" name="added_by" value="<?php echo $username; ?>" />
                            <input type="hidden" id="id" name="id" value="<?php echo $crop_type->id; ?>">
                                 
                        </div>
                      </div>
                    <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="description">Description</label>
                                     <textarea class="form-control" id="description" name="description" rows="3"><?php echo $crop_type->description; ?></textarea>
                                </div>
                        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="farm-button py-1 ml-0 SaveGrowLocation">
        <span class="fa fa-save"> Save</span></button>
        <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0 current_page" data-dismiss="modal">Close</button>
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
      
            $('.SaveGrowLocation').on('click', function(e){
             
            
                    let form = $('#grow_location_form')[0]; // You need to use standard javascript object here 
                    let formData = new FormData(form); 
                   
                 // alert('Checking if event is executed');
                   
            	$.ajax({
            			url: 'view/farm/crops/growlocation/update.php',
            			data: formData,
                        type: 'POST',
                        contentType: false,  // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                        processData: false, // NEEDED, DON'T OMIT THIS
                        success:function(data){
                            $(".success_alert").html(data);
                            $(".success_alert").show();
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
        			url: "view/farm/crops/growlocation/",
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
  



