<?php

require_once '../../core/init.php';

$user = new User();
if ($user->isLoggedIn()) {
    

$username = escape($user->data()->id);
?>

  
    <div id="body_general">
    <div class="container-fluid p-0 bg-success">
        <div id="accounttile">
          <div class="col-sm-12 col-sm-6">
            <span id="close" class="fa fa-close p-1 btn-danger text-lg"></span>
          </div>
        </div>
      <div class="jumbotron pt-5 bg-white">
            <div class="row m-3 mb-4">
                <div class="container">
                    <h3 class="mb-0 pb-0"><i class="fa fa-puzzle-piece" aria-hidden="true"></i> Grow Location</h3>
                    <p class="text-sm ml-4 mt-0 pt-0 text-secondary">Crop Planting</p>
                  </div>
            </div>
            <div class="col-sm-12">
                <div class="row justify-content-end mb-4">
                   <div class="col-sm-7">
                      
                      </div>
                      
                  
                    <div class="col-sm-5 text-right">
                      <button class="farm-button py-1 ml-0" id="add_button" data-toggle="modal" data-target="#addWorkModal">
                        <span class="fa fa-plus"></span> Add Grow Location
                      </button>
                      <button class="farm-button-icon-button py-1 ml-0 current_page">
                        <span class=" fa fa-refresh"></span>
                      </button>
                    </div>
                </div>
              </div>
              
          <div class="row">
              <div class="col-sm-12 success_alert" id="success_alert"></div>
              <div class="col-sm-12 warning_alert" id="warning_alert"></div>
          </div>      
         <div class="row">
            <div class="col-12">
            <div id="workview"></div>
               <div id="wload"></div> 
        </div>
        </div>
        <div class="row">
            <div class="col-12 pt-3 mx-0 mb-0 pb-0">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d45053.64411109254!2d3.5545750921610315!3d6.490824360220532!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e1!3m2!1sen!2sng!4v1655999311805!5m2!1sen!2sng" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
            		
             
        </div>
    </div>
  </div>

<!-- Create Work Location Modal !-->
<div id="addWorkModal" class="modal fade" tabindex="-1" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title">Add Grow Location</h6>
        <button type="button" class="close current_page" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="grow_location_form" name="grow_location_form" method="POST" autocomplete="off">
       <div class="modal-body" style="font-size:0.8rem">
          
           <div class="row mt-0 mb-3 pt-0">
                      
                    <div class="col-sm-12 success_alert" id="success_alert"></div>
                    <div class="col-sm-12 warning_alert" id="warning_alert"></div>
                    
                  </div>
    
                 
                      <div class="row">
                        <div class="form-group col-sm-8">
                            <label for="grow_location_name">Grow Location</label>
                             <div class="input-group mb-2">
                             <div class="input-group-prepend">
                              <div class="input-group-text">Name</div>
                            </div>
                            <input type="text" class="form-control" id="grow_location_name" name="grow_location_name" placeholder="Location Name">
                               
                            </div> 
                          </div>
                       <div class="form-group col-sm-4">
                    <label for="location_type">Location Type</label>
                    <select id="location_type" name="location_type" class="form-control" id="">
                      <option> Select... </option>
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
                              <input type="number" class="form-control" id="area_size" name="area_size" placeholder="0.00">
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
                            <input type="number" class="form-control" id="estimated_land_value" name="estimated_land_value" placeholder="0.00">
                            </div>
                        </div>
                       <div class="form-group col-sm-4">
                        <label for="status">Status</label>
                           <select id="status" name="status" class="form-control" id="">
                              <option> Select... </option>
                              <option value="Active">Active</option>
                              <option value="Fallow">Fallow</option>
                              <option value="Leased">Leased</option>
                              <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                       <div class="form-group col-sm-4">
                        <label for="status">Light Profile</label>
                           <select id="light_profile" name="light_profile" class="form-control" id="">
                              <option> Select... </option>
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
                            <input type="number" class="form-control" id="grazing_rest_days" name="grazing_rest_days" placeholder="0">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <div class="input-group mb-2">
                             <div class="input-group-prepend">
                              <div class="input-group-text">Longitude</div>
                            </div>
                            <input type="text" class="form-control" id="longitude" name="longitude" placeholder="0.000000">
                               
                            </div>    
                        </div>
                        <div class="form-group col-sm-6">
                            <div class="input-group mb-2">
                             <div class="input-group-prepend">
                              <div class="input-group-text">Latitude</div>
                            </div>
                            <input type="text" class="form-control" id="latitude" name="latitude" placeholder="0.000000">
                               
                            </div> 
                                  
                            <?php        
                                     $abdusalam = mt_rand(0001,9999); 
                                ?>
                            <input type="hidden" id="glocation_code" name="glocation_code" value="<?php echo $abdusalam; ?>" />
                            <input type="hidden" id="added_by" name="added_by" value="<?php echo $username; ?>" />
                                 
                        </div>
                      </div>
                    <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="description">Description</label>
                                     <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                </div>
                        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="farm-button py-1 ml-0 SaveGrowLocation">
        <span class="fa fa-save"> Save</span></button>
        <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0 current_page" data-dismiss="modal">Close</button>
      </div>
      </form>
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
  function showgrowlocation(perPageCount, pageNumber) {
        $.ajax({
            type: "GET",
            url: "view/farm/crops/growlocation/select.php",
            data: "pageNumber=" + pageNumber,
            cache: false,
    		beforeSend: function() {
                $('#wload').html('<img src="loader.png" alt="reload" width="20" height="20" style="margin-top:10px;">');
    			
            },
            success: function(html) {
                $("#workview").html(html);
                $('#wload').html(''); 
            }
        });
    }
    </script>
    <script>
   $(document).ready(function(event) {
        $('.success_alert').hide();
        $('.warning_alert').hide();
        showgrowlocation(4, 1);
        
        
       
        
         $('.current_page').click(function (e) {
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/farm/crops/growlocation/index.php",
    		
    			cache: false,
    			success: function (msg) {
    				$("#contentbar_inner").html(msg);
    				$("#loader_httpFeed").hide();
    			}
    		});
    		e.preventDefault();
    	});
        
    
       
          $('.SaveGrowLocation').on('click', function(e){
       
                 let form = $('#grow_location_form')[0]; // You need to use standard javascript object here
                 let formData = new FormData(form);  
                
                 //alert("Working...")
           
                     $.ajax({
        				url: 'view/farm/crops/growlocation/insert.php',
        				data: formData,
                        type: 'POST',
                        contentType: false,  // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                        processData: false, // NEEDED, DON'T OMIT THIS
                        success:function(data){
                            $(".success_alert").html(data);
                            $(".success_alert").show();
                            $('#wload').html(''); 
                                  setTimeout(function(){// wait for 5 secs(2)
                                      $(document).ready(function() {
                                        showgrowlocation(10, 1);
                                    }); // then reload the page.(3)
                                  }, 100); 
                        }, 
                        error:function(data){
                            $(".warning_alert").html(data);
                            $(".warning_alert").show();
                        }
                    }); 
                
    		e.preventDefault();
            });
       
         
 
   
   event.preventDefault();
   });
  </script>
  

  