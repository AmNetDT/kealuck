<?php

require_once '../../core/init.php';

$member_id = $_POST['id'];

$user = new User();
if ($user->isLoggedIn()) {

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
          <?php
                  
                    $users = Db::getInstance()->query("SELECT a.*, e.description as locationdescription, concat(d.firstname,' ',d.lastname) as added_by
                    FROM worklocation a
                    left join worklocation_type e on a.worklocation_type_id = e.id
                    Left Join users c on a.added_by = c.id
                    Left Join staff_record d on c.username = d.user_id
                    WHERE a.id = $member_id");
                    foreach ($users->results() as $stockQ) {
              
                 
                   $location_code = $stockQ->location_code;
                 ?>

          <div class="jumbotron bg-white">
              <div class="row">
                <div class="col-sm-12">
                    <div class="row justify-content-between">
                    <div class="col-sm-8">
                       <h3>Update Location: <?php echo $location_code; ?></h3> </h3>     
                    </div>
                   <div class="col-sm-4">
                      <button class="farm-button-cancel py-1 ml-0 edituser_view" id="#">
                        <span class="fa fa-chevron-left"></span> 
                      </button>
                      <button type="button" class="farm-button py-1 ml-0 SaveStaff">
                        <span class="fa fa-save"> Save</span>
                      </button>
                      <button class="farm-button-icon-button py-1 ml-0 current_page" id="<?php echo $member_id ?>">
                        <span class="fa fa-refresh"></span>
                      </button>
                    </div> 
                </div>
                
                  <div class="row mt-0 mb-3 pt-0">
                      
                    <div class="col-sm-12 success_alert" id="success_alert"></div>
                    <div class="col-sm-12 warning_alert" id="warning_alert"></div>
                    
                  </div>
                  
                 <form method="POST" autocomplete="off">
                    <div class="row">
                      <div class="form-group col-sm-12">
                            <label for="location">Stock Unit</label>
                         <div class="input-group mb-2">
                         <div class="input-group-prepend">
                          <div class="input-group-text">Description</div>
                        </div>
                          <input type="text" id="location" name="location" value="<?php echo $stockQ->location; ?>" class="form-control" placeholder="Locationm Name" />
                           <input type="hidden" name="location_code" value="<?php echo $location_code; ?>" id="location_code"  />
                         </div>
                     </div> 
                    </div>
                    <div class="row">
                    <div class="form-group col-sm-12">
                          <label for="inputs_warehouse">Location Type</label>
                            <select class="form-control" id="worklocation_type_id" name="worklocation_type_id">
                                <option value="<?php echo $stockQ->worklocation_type_id; ?>"><?php echo $stockQ->locationdescription; ?></option>
                                <!-- Work Location !-->
                            <?php 
                            
                                     $usslocation = Db::getInstance()->query("SELECT * FROM worklocation_type");
                                     
                                      if (!$usslocation->count()) {
                                        echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                                      } else {
                                          foreach ($usslocation->results() as $usslocat) {
                            ?>
                          <option value="<?php echo $usslocat->id; ?>"><?php echo $usslocat->description; ?></option>
                          <?php
                     
                        }
                                      }
                        ?>
                            </select>
                            </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-sm-12">
                            <label for="address">Location Address</label>
                         <div class="input-group mb-2">
                         <div class="input-group-prepend">
                          <div class="input-group-text">Description</div>
                        </div>
                          <textarea class="form-control" name="address" id="address" rows="3"><?php echo $stockQ->address; ?></textarea>
                         </div>
                     </div> 
                    </div>
                    <div class="row">
                      <div class="form-group col-sm-6">
                        <label for="longitude">Longitude</label>
                        <input type="text" id="longitude" name="longitude" value="<?php echo $stockQ->longitude; ?>" class="form-control" placeholder="Area Longitude" />
                      </div>
                      <div class="form-group col-sm-6">
                        <label for="latitude">Latitude</label>
                        <input type="text" id="latitude" name="latitude" value="<?php echo $stockQ->latitude; ?>" class="form-control" placeholder="Area Latitude" />
                      </div>
                    </div>
                    
                    <hr class="my-4">
                    <div class="row">
                        <div class="form-group col-sm-12">
                        <label for="username" class="form-control">Created by: <?php echo $stockQ->added_by; ?></label>
                         </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                        <label for="creted_date" class="form-control">Date Created: <?php echo $stockQ->createddate; ?></label>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                        <label for="modified_date" class="form-control">Modified: <?php echo $stockQ->modifieddate; ?></label> 
                      </div>
                    </div>
                    <input type="hidden" id="id" name="id" value="<?php echo $stockQ->id; ?>" />
                    <input type="hidden" id="added_by" name="added_by" value="<?php echo $username; ?>" />
                    
                
                </form>
              </div>
            </div>
          </div>
           <?php
                
                }
                
                ?>
        </div>
      </div>
    </div>

<?php

} else {
  $user->logout();
  Redirect::to('../../login/');
}


?>


<!-- Create Dept Modal !-->
  
<script>
    $(document).ready(function(event){
        $('.success_alert').hide();
        $('.warning_alert').hide();
   
       
        $('.SaveStaff').on('click', function(){
       
                let form = $('form')[0]; // You need to use standard javascript object here
                let formData = new FormData(form);  
                
                //alert(formData)
           
                    $.ajax({
        				url: 'view/configurations/worklocation/update.php',
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
                
            });
       
         
       
    	$('.current_page').click(function (e) {
    		
    		let id = $(this).attr('id');
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/configurations/worklocation/editlocation.php",
    			data: {
    				'id': id  
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
	<script>
   $(document).ready(function(event) {
       
       
    	$('.edituser_view').click(function (e) {
		
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: "view/configurations/worklocation/",
			cache: false,
			success: function (msg) {
				$("#contentbar_inner").html(msg);
				$("#loader_httpFeed").hide();
			}
		});
		e.preventDefault();
	});   
       
   });
   
   </script>