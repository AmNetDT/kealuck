<?php

require_once '../../core/init.php';

$user = new User();
if ($user->isLoggedIn()) {
$member_id = $_POST['member_id'];


              $username = escape($user->data()->id);
             
             $crop_type = Db::getInstance()->query("SELECT * 
                                                    FROM crop_planting a
                                                    LEFT JOIN crop_grow_location b ON a.grow_location_id = b.id
                                                    LEFT JOIN planting_format c ON a.planting_format_id = c.id
                                                    LEFT JOIN season_type d ON a.season_type_id = d.id
                                                    WHERE a.id = $member_id");
                foreach ($crop_type->results() as $crop_type) {
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
                        <h3><i class="fa fa-leaf p-1" aria-hidden="true"></i> Edit Crop Planting</h3>
                        </div>
                        <div class="col-sm-3">
                              <button class="farm-button-cancel py-1 ml-0 crop_index" id="<?php echo $crop_type->crop_type_id; ?>">
                                <span class="fa fa-chevron-left"></span> 
                              </button>
                        </div>
                </div>
          <div class="row my-3">
            <div class="col-sm-12">
           
                   
                  <div class="row my-5">
                      
                       <form method="post" name="update_planting_form" id="update_planting_form" enctype="multipart/form-data">
        <div class="modal-content">
         
          
          <div class="modal-body">
               <div class="row mt-0 mb-3 pt-0">
                 
                    <div class="col-sm-12 success_alert" id="success_alert"></div>
                    <div class="col-sm-12 warning_alert" id="warning_alert"></div>
                    
                  </div>
            <div class="row"> 
                <div class="form-group col-sm-6">
                    <label for="number_planted">No. Planted</label>
                <input type="number" name="number_planted" id="number_planted" class="form-control" value="<?php echo $crop_type->number_planted; ?>" />
                    </div>
              <div class="form-group col-sm-6">
                <label for="location">Grow Location</label>
                <select id="grow_location_id" name="grow_location_id" class="form-control">
                  <option value="<?php echo $crop_type->grow_location_id; ?>"><?php echo $crop_type->grow_location_name; ?></option>
                    <?php
                    
                        $crop_grow_location = Db::getInstance()->query("SELECT * FROM crop_grow_location"); 
                         if (!$crop_grow_location->count()) {
                                     
                                echo "<option>No data to be displayed</option>";
                                        
                          } else {
                                foreach ($crop_grow_location->results() as $crop_grow_location) {
            
                    ?>
                  <option value="<?php echo $crop_grow_location->id; ?>"><?php echo $crop_grow_location->grow_location_name; ?></option>
                  <?php
                  
                        }
                     }
                  ?>
                </select>
              </div>
            </div>
           
            <div class="row">
                 <div class="form-group col-sm-6">
                    <label for="planting_format_id">Planting Format</label>
                    <select id="planting_format_id" name="planting_format_id" class="form-control" id="">
                             <option value="<?php echo $crop_type->planting_format_id; ?>"><?php echo $crop_type->title; ?></option>
                        <?php
                        
                            $planting_format = Db::getInstance()->query("SELECT * FROM planting_format"); 
                            if (!$planting_format->count()) {
                                     
                                 echo "<option>No data to be displayed</option>";
                                        
                          } else {
                            foreach ($planting_format->results() as $planting_format) {
                
                        ?>
                                 <option value="<?php echo $planting_format->id; ?>"><?php echo $planting_format->title; ?></option>
                      <?php
                      
                            }
                          }
                      ?>
                    </select>
                      </div>
                      <div class="form-group col-sm-6">
                        <label for="season_type_id">Season Type</label>
                        <select id="season_type_id" name="season_type_id" class="form-control" id="">
                             <option value="<?php echo $crop_type->season_type_id; ?>"><?php echo $crop_type->name; ?></option>
                            <?php
                            
                                $season_type = Db::getInstance()->query("SELECT * FROM season_type");
                      
                                                    foreach ($season_type->results() as $season_type) {
                    
                            ?>
                          <option value="<?php echo $season_type->id; ?>"><?php echo $season_type->name; ?></option>
                          <?php
                                }
                          ?>
                        </select>
                      </div>
                                </div>
                                <div class="row">
                                    
                                  <div class="col-sm-12 farm-button-blend my-3"><span class="text-sm">Planting Period</span></div> 
                                  <div class="form-group col-sm-6">
                                    <label>Starting Date</label>
                                    <input type="week" name="pr_start_date" id="pr_start_date" class="form-control" value="<?php echo $crop_type->pr_start_date; ?>"  />
                                  </div>
                                  <div class="form-group col-sm-6">
                                    <label>End Date</label>
                                    <input type="week" name="pr_end_date" id="pr_end_date" class="form-control"  value="<?php echo $crop_type->pr_end_date; ?>"  />
                                  </div>
                                  </div>
                                  <div class="row">
                                    
                                  <div class="col-sm-12 farm-color my-3"><span class="text-sm">Harvesting Period</span></div> 
                                  <div class="form-group col-sm-6">
                                    <label>Starting Date</label>
                                    <input type="week" name="hr_start_date" id="hr_start_date" class="form-control"  value="<?php echo $crop_type->hr_start_date; ?>"  />
                                  </div>
                                  <div class="form-group col-sm-6">
                                    <label>End Date</label>
                                    <input type="week" name="hr_end_date" id="hr_end_date" class="form-control"  value="<?php echo $crop_type->hr_end_date; ?>"  />
                                  </div>
                                  </div>
                                </div>
                              
                              <div class="modal-footer">
                                <input type="hidden" name="crop_planting_id" id="crop_planting_id" value="<?php echo $member_id; ?>"/>
                                <input type="hidden" name="added_by" id="added_by" value="<?php echo $username; ?>"/>
                                <button type="submit" class="py-1 px-2 border farm-color mx-0 update-planting"> Save</button>
                                <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0 crop_index" id="<?php echo $crop_type->crop_type_id; ?>" data-dismiss="modal" aria-label="Cancel">Cancel</button>
                              </div>
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
  <?php
                }
} else {
  $user->logout();
  Redirect::to('../../login/');
}

  ?>
  

 
 
  <script>
   $(document).ready(function(event) {
      
            $('.update-planting').on('click', function(e){
             
            
                    let form = $('#update_planting_form')[0]; // You need to use standard javascript object here 
                    let formData = new FormData(form); 
                   
                 // alert('Checking if event is executed');
                   
            	
            	$.ajax({
            			url: 'view/farm/crops/update-planting.php',
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
        			url: "view/farm/crops/cropplanting.php",
        			data:{
        			    'member_id': member_id
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
  



