<?php

require_once '../../core/init.php';



$user = new User();
if ($user->isLoggedIn()) {
    $username = escape($user->data()->id);
    $userSyscategory = escape($user->data()->syscategory_id);
    
    
    $member_id = $_POST['member_id'];
?>

  
  
  <div id="body_general">
    <div class="container-fluid p-0 bg-success">
        <div id="accounttile">
          <div class="col-sm-12 col-sm-6">
            <span id="close" class="fa fa-close p-1 btn-danger text-lg"></span>
          </div>
        </div>
      <div class="jumbotron jumbotron-fluid pt-5 bg-white">
        <div id="accounttile" class="container">
             <?php

            $users = Db::getInstance()->query("SELECT concat(d.firstname, ' ', d.lastname) as registered, a.transaction_year_month, a.crop_name, a.crop_image, crop_code
                                                FROM crop_type a
                                                LEFT JOIN users c ON a.added_by = c.id
                                                LEFT JOIN staff_record d ON c.username = d.user_id
                                                WHERE a.id =$member_id");
                  
            foreach ($users->results() as $use) {
                
                
            ?>
            
                <div class="row my-3 mb-4 justify-content-between">
                    <div class="col-sm-6">
                       <h3><?php echo $use->crop_name . ' ' . $use->crop_code; ?></h3>
                       <h5>Crop Planting for the year <?php
                                $string = $use->transaction_year_month;
                                $substring = substr($string, 0, 4); // Remove the month
                                echo $substring;
                         ?></h5>     
                    </div>  
                    <div class="col-sm-2">
                      
                    </div> 
                </div>
              
                <div class="row justify-content-between">
                    <div class="col-sm-12 success_alert mr-0"></div>
                    <div class="col-sm-12 warning_alert mr-0"></div>
                </div>
                
                  
                           
                    <div class="row justify-content-between">
                     
                           <div class="col-sm-3">
                             
                             </div>
                        
                            <div class="col-sm-6 px-0 mr-0">
                                
                            </div>
                            
                            
                            <div class="col-sm-3 text-right">
                    
                                  <button type="button" class="farm-button-cancel py-1 ml-0 prev_page" id="#">
                                    <span class="fa fa-chevron-left"></span>
                                  </button>  
                                  <button type="button" class="farm-button py-1 ml-0"  data-toggle="modal" data-target="#PlantingModal">
                                    <span class="fa fa-plus"></span> New Planting
                                  </button>  
                                  <button type="button" class="farm-button-icon-button py-1 ml-0 current_page" id="<?php echo $member_id; ?>">
                                    <span class="fa fa-refresh"></span>
                                  </button>
                                     
                            </div>
                           </div>  
                   
                  
                            
                 
                <div class="row justify-content-between">
                    <div class="col-sm-3">
                        
                             <img id="blah" class="img-fluid" src="view/farm/crops/<?php echo $use->crop_image; ?>" style="height:80%" alt="Original Image" />
                            
                    </div>
                    <div class="col-sm-3">
                        
                    </div>
                    <div class="col-sm-3">
                      <div class="card">
                        <div class="card-header p-2">
                          <div class="text-end pt-1">
                            <h6 class="mb-0 text-dark" style="font-size:0.85em">
                              <b>Total Planted</b> |  <?php
                                              
                                                            ?>
                             </h6> 
                         
                           
                            </div>
                        </div>
                      </div>
                 </div>
                 
                    <div class="col-sm-3">
                     <div class="card">
                        <div class="card-header p-2">
                          <div class="text-end pt-1">
                            <h6 class="mb-0 text-dark" style="font-size:0.85em">
                              <b>Prepare by:</b> <?php echo $use->registered; ?>
                              </h6> 
                          </div>
                        </div>
                      </div>
                 </div>
                </div>
                <div class="row justify-content-between mt-3">
                    <div class="col-sm-12">
                      <?php

                    
                    $sqlQuery = Db::getInstance()->query("SELECT concat(d.firstname, ' ', d.lastname) as registered, a.transaction_year_month, b.number_planted, b.id as crop_planting_id,
                                                e.title, f.name as season,
                                                g.grow_location_name as location, b.planting_format_id, b.season_type_id, b.pr_start_date, b.pr_end_date, b.hr_start_date, b.hr_end_date 
                                                FROM crop_type a
                                                LEFT JOIN crop_planting b ON a.id = b.crop_type_id
                                                LEFT JOIN planting_format e ON b.planting_format_id = e.id
                                                LEFT JOIN season_type f ON b.season_type_id = f.id
                                                LEFT JOIN crop_grow_location g ON b.grow_location_id = g.id
                                                LEFT JOIN users c ON a.added_by = c.id
                                                LEFT JOIN staff_record d ON c.username = d.user_id 
                                                WHERE b.crop_type_id =$member_id");
                    
                                     if (!$sqlQuery->count()) {
                                         
                                            echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                                            
                                          } else {
                                            ?>
                                          
                       
                                        <table id="deptview" class="table table-hover table-bordered" style="width:100%; font-size:0.75rem">
                                        <thead>
                                          <tr>
                                            <th colspan="5"></th>
                                            <th class="text-right pr-3 farm-button-blend" colspan="2">Planting Period</th>
                                            <th class="text-right pr-3 farm-button" colspan="2">Havesting Period</th>
                                            <th class="text-right pr-3" colspan="2"></th>
                                          </tr>
                                          <tr>
                                            <td>#</td>
                                            <td class="text-right pr-3">No. Planted</td>
                                            <td class="text-right pr-3">Location</td>
                                            <td class="text-right pr-3">Planting Format</td>
                                            <td class="text-right pr-3">Season Type</td>
                                            <td class="text-right pr-3 border-dark">Start Date</td>
                                            <td class="text-right pr-3 border-dark">End Date</td>
                                            <td class="text-right pr-3 border-success">Start Date</td>
                                            <td class="text-right pr-3 border-success">End Date</td>
                                            <td class="text-right pr-3">Created By</td>
                                            <td style="width:1%">&nbsp;</td>
                                          </tr>
                                        </thead>
                                        <tbody>
                    
                        
                    
                        <?php 
                                            $i = 1;
                    	                    foreach ($sqlQuery->results() as $sqlQuery) { 
                    
                    	?>
                       
                                            <tr>
                                              <td class="text-right pr-3"><?php echo $i++; ?></td>
                                              <td class="text-right pr-3"><?php echo $sqlQuery->number_planted; ?></td>
                                              <td class="text-right pr-3"><?php echo $sqlQuery->location; ?></td>
                                              <td class="text-right pr-3"><?php echo $sqlQuery->title; ?></td>
                                              <td class="text-right pr-3"><?php echo $sqlQuery->season; ?></td>
                                              <td class="text-right pr-3"><?php echo $sqlQuery->pr_start_date; ?></td>
                                              <td class="text-right pr-3"><?php echo $sqlQuery->pr_end_date; ?></td>
                                              <td class="text-right pr-3"><?php echo $sqlQuery->hr_start_date; ?></td>
                                              <td class="text-right pr-3"><?php echo $sqlQuery->hr_end_date; ?></td>
                                              <td class="text-right pr-3"><?php echo $sqlQuery->registered; ?></td>
                                              <td>
                                         
                                                        <div class="dropdown">
                                <button class="btn btn-default dropup" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                  <i style="font-size:14px" class="fa">&#xf142;</i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                   <div class="edit_crop_planting" id="<?php echo $sqlQuery->crop_planting_id; ?>" >
                                        <button class="dropdown-item btn btn-default">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>    &nbsp; Edit Planting</button>

                                    </div>
                                   <div class="request_for_approval" id="<?php echo $sqlQuery->crop_planting_id; ?>" >
                                        <button class="dropdown-item btn btn-default">
                                        <i class="fa fa-check" aria-hidden="true"></i>    &nbsp; Request for Approval</button>

                                    </div>
                                  <div class="adjust_view" id="<?php echo $sqlQuery->crop_planting_id; ?>" >
                                        <button class="dropdown-item btn btn-default">
                                        <i class="fa fa-map-marker" aria-hidden="true"></i>    &nbsp; Location Map</button>

                                    </div>
                                      <div class="adjust_view" id="<?php echo $sqlQuery->crop_planting_id; ?>" >
                                            <button class="dropdown-item btn btn-default">
                                            <i class="fa fa-clock" aria-hidden="true"></i>    &nbsp; Harvest Timing</button>
    
                                        </div>
                                      <div class="adjust_view" id="<?php echo $sqlQuery->crop_planting_id; ?>" >
                                            <button class="dropdown-item btn btn-default">
                                            <i class="fa fa-truck" aria-hidden="true"></i>    &nbsp; Harvest-to-Market Process</button>
    
                                        </div>
                                    <div class="dropdown-divider"></div>
                                      <div class="_delete" id="<?php echo $sqlQuery->crop_planting_id; ?>" lang="crop_planting">
                                            <button class="dropdown-item btn btn-default">
                                            <i class="fa fa-trash" aria-hidden="true"></i>    &nbsp; Delete</button>
    
                                        </div>
                                 </div>
                                </div> 
                                
                                            </td>
                                            </tr>
                       
                        <?php
                                 }
                                         
                        ?>
                        </tbody>
                    </table>
        <?php
                  }
                
                ?>
                            
                                </div>
                </div>
            
            
        </div>
      </div>
    </div>
    </div>
    
    <!-- Add Planting Modal !-->

  <div id="PlantingModal" class="modal fade" data-backdrop="static">
    <div class="modal-dialog modal-lg">
      <form method="post" name="crops_form" id="crops_planting_form" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="farm-color modal-header p-2">
            <p class="modal-title" id="staticBackdropLabel"><i class="fa fa-leaf" aria-hidden="true"></i> New Planting</p>
            <button type="button" class="bg-secondary px-2 border text-white current_page" id="<?php echo $member_id; ?>" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          
          <div class="modal-body">
               <div class="row mt-0 mb-3 pt-0">
                 
                    <div class="col-sm-12 success_alert" id="success_alert"></div>
                    <div class="col-sm-12 warning_alert" id="warning_alert"></div>
                    
                  </div>
            <div class="row my-3 mb-4 justify-content-between">
                    <div class="col-sm-12">
                       <h3>Crop Planting for the year <?php
                                $string = $use->transaction_year_month;
                                $substring = substr($string, 0, 4); // Remove the month
                                echo $substring;
                         ?></h3>     
                    </div> 
                </div>
            <div class="row"> 
                <div class="form-group col-sm-6">
                    <label for="number_planted">No. Planted</label>
                <input type="number" name="number_planted" id="number_planted" class="form-control" />
                    </div>
              <div class="form-group col-sm-6">
                <label for="grow_location_id">Location</label>
                <select id="grow_location_id" name="grow_location_id" class="form-control">
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
                <input type="week" name="pr_start_date" id="pr_start_date" class="form-control"  />
              </div>
              <div class="form-group col-sm-6">
                <label>End Date</label>
                <input type="week" name="pr_end_date" id="pr_end_date" class="form-control"  />
              </div>
              </div>
              <div class="row">
                
              <div class="col-sm-12 farm-color my-3"><span class="text-sm">Harvesting Period</span></div> 
              <div class="form-group col-sm-6">
                <label>Starting Date</label>
                <input type="week" name="hr_start_date" id="hr_start_date" class="form-control" />
              </div>
              <div class="form-group col-sm-6">
                <label>End Date</label>
                <input type="week" name="hr_end_date" id="hr_end_date" class="form-control"  />
              </div>
              </div>
            </div>
          
          <div class="modal-footer">
            <input type="hidden" name="crop_type_id" id="crop_type_id" value="<?php echo $member_id; ?>"/>
            <input type="hidden" name="added_by" id="added_by" value="<?php echo $username; ?>"/>
            <button type="submit" class="py-1 px-2 border farm-color mx-0 savePlanting"> Save</button>
            <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0 current_page" id="<?php echo $member_id; ?>" data-dismiss="modal" aria-label="Close">Close</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- End Planting Modal !-->
    
  <?php
            }
            
            
} else {
  $user->logout();
  Redirect::to('../../login/');
}

  ?>
  <script>
      $(document).ready(function(event){
          
            $('.success_alert').hide();
            $('.warning_alert').hide();
            
           	$('.edit_crop_planting').click(function (e) {
    		
    		let member_id = $(this).attr('id');
            //alert(id);
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/farm/crops/edit-crop-planting.php",
    			data:{
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
        		
        	$('.request_for_approval').click(function (e) {
    		
        		let member_id = $(this).attr('id');
                //alert(id);
        		
        		$("#loader_httpFeed").show();
        		$.ajax({
        			type: "POST",
        			url: "view/farm/crops/request_approval.php",
        			data:{
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
            
            $('.savePlanting').on('click', function(e){
             
            
                    let form = $('#crops_planting_form')[0]; // You need to use standard javascript object here 
                    let formData = new FormData(form); 
                   
                 // alert('Checking if event is executed');
                   
            	
            	$.ajax({
            			url: 'view/farm/crops/cropplanting_insert.php',
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
            
            $('.prev_page').click(function (e) {
            
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
            e.preventDefault();
            });   
            
            $('.current_page').click(function (e) {
            
            let member_id = $(this).attr('id');
            
            //alert(dataString);
            
            $("#loader_httpFeed").show();
            	$.ajax({
            		type: "POST",
            		data: {
            		    
            		    member_id:member_id
            		    
            		},
            		url: 'view/farm/crops/cropplanting.php',  
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
        		let table_name = $(this).attr('lang');
                
                //alert(budget_id);
        		
        		$("#loader_httpFeed").show();
        		$.ajax({
        			type: "POST",
        			url: "view/farm/crops/_delete.php",
        			data:{
        			  
        			    id : id,
        			    table_name : table_name
        			    
        			},
        			cache: false,
        			success:function(data){
                            
                            $(".success_alert").html(data);
                            $(".success_alert").show();
				            $(document).ready(function() {
                                showDepartment(10, 1);
                            });
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
       
   
    	
       event.preventDefault();
   });
   
   
   
   </script>

