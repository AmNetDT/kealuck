<?php

require_once '../../core/init.php';

$user = new User();
if ($user->isLoggedIn()) {

$username = escape($user->data()->id);
$userSyscategory = escape($user->data()->syscategory_id);
$privilege = Db::getInstance()->query("SELECT * FROM `syscategory` WHERE `id` = $userSyscategory");



        $transact_ = date('Y-m');
        //echo $transact_;
        
         if(!empty($_REQUEST['transaction_year_month'])) {
                
             $transaction_year_month = $_REQUEST['transaction_year_month'];

?>

        <div class="table-responsive data-font" style="height: 120%;">

 
                <?php

               


                  $crop_type = Db::getInstance()->query("SELECT * FROM crop_type WHERE transaction_year_month LIKE '%$transaction_year_month%'");

                  if (!$crop_type->count()) {
                      
                    echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                    
                  } else {

                ?>

                    <table class="table table-hover table-bordered" style="width:100%; font-size:0.8rem">
                      <thead>
                        <tr>
                          <th class="p-2" style="width:1%;">#</th>
                          <th class="p-2" style="width:65%;">Crop Type</th>
                          <th class="p-2" style="width:10%;">Crop Code</th>
                          <th class="p-2" style="width:10%;">Variety Strain</th>
                          <th class="p-2" style="width:14%;">Botanical Name</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $i = 1;
                        foreach ($crop_type->results() as $crop_type) {

                        ?>

                          <tr>
                            <td class="px-2 pt-2" style="width: 1%;"><?php echo $i++; ?></td>
                            <td class="px-0 pt-2">
                                
                                    <ul class="list-unstyled">
                                      <li class="media">
                                          
                                        <?php if (empty($crop_type->crop_image)) {
                                            
                                                        //re-shape an image with jQuery -- --- Check the script and the style on index page
                                                        echo '<img class="image_resizing mr-1 pr-0" src="view/farm/crops/upload/placeholder.png" alt="Placeholder"><canvas class="canvas p-0 m-0"></canvas>';
                                                        
                                                    } else {
                                                        
                                                        echo '<img class="image_resizing mr-1 pr-0" src="view/farm/crops/' . $crop_type->crop_image . '" alt="Real Image"><canvas class="canvas p-0 m-0"></canvas>';
                                                        
                                                    } ?>
                                        <div class="media-body p-0">
                                          <h5 class="mt-0 mb-1"><?php echo $crop_type->crop_name; ?></h5>
                                          <span><?php echo $crop_type->description; ?></span>
                                        </div>
                                      </li>
                                     </ul>
                            </td>
                            <td class="px-2 pt-2"><?php echo $crop_type->crop_code; ?></td>
                            <td class="px-2 pt-2"><?php echo $crop_type->variety_strain; ?></td>
                            <td class="px-2 pt-2"><?php echo $crop_type->botanical_name; ?></td>
                            <td class="px-2 pt-2" style="width: 1%;">
                                <div class="dropup">
                                <button class="btn btn-default dropleft" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                  <i style="font-size:14px" class="fa">&#xf142;</i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <div class="crop_planting" id="<?php echo $crop_type->id; ?>">
                                <button class="dropdown-item" class="dropdown-item">
                                <i class="fa fa-plus"></i>&nbsp; Crop Planting</button>
                                </div>
                                <div class="crop_update" id="<?php echo $crop_type->id; ?>">
                                <button class="dropdown-item py-0 my-0">
                                     <i class="fa fa-pencil"></i>&nbsp; Edit Crop</button>
                                </div>
                                <div class="dropdown-divider"></div>
                                <div class="crop_delete" id="<?php echo $crop_type->id; ?>">
                                    <button class="dropdown-item py-0 my-0">
                                         <i class="fa fa-trash"></i>&nbsp; Delete</button>
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
                  
                } ?>
              </div>
              
  <?php
        }else{
            
            ?>
            
        <div class="table-responsive data-font" style="height: 120%;">

 
                <?php

               


                  $crop_type = Db::getInstance()->query("SELECT * FROM crop_type WHERE transaction_year_month LIKE '%$transact_%'");

                  if (!$crop_type->count()) {
                      
                    echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                    
                  } else {

                ?>

                    <table class="table table-hover table-bordered" style="width:100%; font-size:0.8rem">
                      <thead>
                        <tr>
                          <th class="p-2" style="width:1%;">#</th>
                          <th class="p-2" style="width:65%;">Crop Type</th>
                          <th class="p-2" style="width:10%;">Crop Code</th>
                          <th class="p-2" style="width:10%;">Variety Strain</th>
                          <th class="p-2" style="width:14%;">Botanical Name</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $i = 1;
                        foreach ($crop_type->results() as $crop_type) {

                        ?>

                          <tr>
                            <td class="px-2 pt-2" style="width: 1%;"><?php echo $i++; ?></td>
                            <td class="px-0 pt-2">
                                
                                    <ul class="list-unstyled">
                                      <li class="media">
                                          
                                        <?php if (empty($crop_type->crop_image)) {
                                            
                                                        //re-shape an image with jQuery -- --- Check the script and the style on index page
                                                        echo '<img class="image_resizing mr-1 pr-0" src="view/farm/crops/upload/placeholder.png" alt="Placeholder"><canvas class="canvas p-0 m-0"></canvas>';
                                                        
                                                    } else {
                                                        
                                                        echo '<img class="image_resizing mr-1 pr-0" src="view/farm/crops/' . $crop_type->crop_image . '" alt="Real Image"><canvas class="canvas p-0 m-0"></canvas>';
                                                        
                                                    } ?>
                                        <div class="media-body p-0">
                                          <h5 class="mt-0 mb-1"><?php echo $crop_type->crop_name; ?></h5>
                                          <span><?php echo $crop_type->description; ?></span>
                                        </div>
                                      </li>
                                     </ul>
                            </td>
                            <td class="px-2 pt-2"><?php echo $crop_type->crop_code; ?></td>
                            <td class="px-2 pt-2"><?php echo $crop_type->variety_strain; ?></td>
                            <td class="px-2 pt-2"><?php echo $crop_type->botanical_name; ?></td>
                            <td class="px-2 pt-2" style="width: 1%;">
                              <div class="dropdown">
                                <button class="btn btn-default dropleft" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                  <i style="font-size:14px" class="fa">&#xf142;</i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <div class="crop_planting" id="<?php echo $crop_type->id; ?>">
                                <button class="dropdown-item" class="dropdown-item">
                                <i class="fa fa-plus"></i>&nbsp; Crop Planting</button>
                                </div>
                                  <div class="crop_update" id="<?php echo $crop_type->id; ?>">
                                        <button class="dropdown-item py-0 my-0">
                                             <i class="fa fa-pencil"></i>&nbsp; Edit Crop</button>

                                    </div>
                                    <div class="dropdown-divider"></div>
                                    <div class="_delete" id="<?php echo $crop_type->id; ?>" lang="crop_type">
                                        <button class="dropdown-item py-0 my-0">
                                             <i class="fa fa-trash"></i>&nbsp; Delete</button>

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
                  
                } ?>
              </div>
           
            <?php
        }
    
    }
  
  ?>
  
  
   <script>
   $(document).ready(function(event) {
       
  
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
 	
 	$('.crop_planting').click(function (e) {
        		
        		let member_id = $(this).attr('id');
                //alert(id);
        		
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
        		e.preventDefault();
        	}); 
        	
 	$('.crop_update').click(function (e) {
        		
        		let member_id = $(this).attr('id');
                //alert(id);
        		
        		$("#loader_httpFeed").show();
        		$.ajax({
        			type: "POST",
        			url: "view/farm/crops/editcrop.php",
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
   
   event.preventDefault();
   });
    
   
   
  </script>
 