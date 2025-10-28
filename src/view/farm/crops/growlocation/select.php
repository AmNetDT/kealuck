<?php

require_once '../../core/init.php';

$user = new User();
if ($user->isLoggedIn()) {

$username = escape($user->data()->id);
?>

       


<div class="table-responsive data-font" style="height:100%;">
     
                <?php



                  $crop_grow_location = Db::getInstance()->query("SELECT a.*, b.username
                  FROM crop_grow_location a 
                  left join users b on a.added_by = b.id 
                  order by id desc");

                  if (!$crop_grow_location->count()) {
                      
                    echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                    
                  } else {

                ?>

                    <table id="fatima" class="table table-hover table-bordered" style="width:100%; font-size:0.8rem">
                      <thead>
                        <tr>
                          <th>S/No</th>
                          <th>Name</th>
                          <th>GLCode</th>
                          <th>Location Type</th>
                          <th>Area/size</th>
                          <th style="width:20%;">Estimated Land Value <span class="pl-4 ml-4 pr-0 mr-0"> &#8358;</span></th>
                          <th>Status</th>
                          <th>Light Profile</th>
                          <th>Grazing Rest Days</th>
                          <th>Description</th>
                          <th>&nbsp;</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        	$i = 1;
                        foreach ($crop_grow_location->results() as $crop_grow_location) {

                        ?>

                          <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $crop_grow_location->grow_location_name; ?></td>
                            <td><?php echo $crop_grow_location->glocation_code; ?></td>
                            <td><?php echo $crop_grow_location->location_type; ?></td>
                            <td><?php echo $crop_grow_location->area_size; ?></td>
                            <td><?php echo $crop_grow_location->estimated_land_value; ?></td>
                            <td><?php echo $crop_grow_location->status; ?></td>
                            <td><?php echo $crop_grow_location->light_profile; ?></td>
                            <td><?php echo $crop_grow_location->grazing_rest_days; ?></td>
                            <td><?php echo $crop_grow_location->description; ?></td>
                            <td>
                                <div class="dropdown">
                                <button class="btn btn-default dropleft" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                  <i style="font-size:14px" class="fa">&#xf142;</i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                  <div class="edit_" id="<?php echo $crop_grow_location->id; ?>">
                                        <button class="dropdown-item">
                                             <i class="fa fa-edit"></i>&nbsp; View/Edit</button>
                                    </div>
                                    
                                <div class="dropdown-divider"></div>
                                <div class="_delete" id="<?php echo $crop_grow_location->id; ?>">
                                    <button class="dropdown-item py-0 my-0">
                                         <i class="fa fa-trash"></i>&nbsp; Delete</button>
                                </div>
                                  </div>

                                </div>
                              </div>
                                </td>
                            
                            <!-- Modal -->

  
                          </tr>

 
                        <?php
                        $i++;
                        }
                        ?>

                      </tbody>
                    </table>
                  <?php
                  }
                 
                ?>
            </div>
          


  <?php
} else {
  $user->logout();
  Redirect::to('../../login/');
}


  ?>
   
	 <script>
	      $(document).ready(function(){
 
    	$('.edit_').click(function (e) {
    		
    		let member_id = $(this).attr('id');
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/farm/crops/growlocation/editcrop.php",
    			data: {
    				'member_id': member_id
    			},
    			cache: false,
    			success: function (msg) {
    				$("#contentbar_inner").html(msg);
    				$("#loader_httpFeed").hide();
    			}
    		});
    		e.preventDefault();
    	});
    	
    	
        $('._delete').click(function (e) {
        		
        	   if (confirm("Are you sure you want to remove this item?") == true) {
        		let id = $(this).attr('id');
                
                //alert(budget_id);
        		
        		$("#loader_httpFeed").show();
        		$.ajax({
        			type: "POST",
        			url: "view/farm/crops/growlocation/delete.php",
        			data:{
        			  
        			    id : id
        			    
        			},
        			cache: false,
        			success:function(data){
                            
                            $(".success_alert").html(data);
                            $(".success_alert").show();
                            $('#wload').html(''); 
                                  setTimeout(function(){// wait for 5 secs(2)
                                      $(document).ready(function() {
                                        showgrowlocation(10, 1);
                                    }); // then reload the page.(3)
                                  }, 100); 
    				        $("#loader_httpFeed").hide();
    			        	
                        },
                        error:function(data){
                            
                            $(".warning_alert").html(data);
                            $(".warning_alert").show();
                            
                        }
        		});
        		e.preventDefault();
        	   }
        	});  
   

	});
	 </script>