<?php

require_once '../../core/init.php';

$user = new User();
if ($user->isLoggedIn()) {



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
                width: 100%; /* new width */
                height: 85px; /* new height */
                object-fit: cover; /* maintain aspect ratio */
            }
            
            .canvas_upload {
                width: 100%; /* new width */
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
    <div class="container-fluid p-0 bg-success">
        <div id="accounttile">
          <div class="col-sm-12 col-sm-6">
            <span id="close" class="fa fa-close p-1 btn-danger text-lg"></span>
          </div>
        </div>
      <div class="jumbotron pt-5 bg-white">
            <div class="row m-3 mb-4">
                <h3><i class="fa fa-leaf p-1" aria-hidden="true"></i> Crop Manager</h3>
                </div>
          <div class="row my-3">
            <div class="col-sm-12 mx-0 px-0">
           
             
               <div class="row justify-content-between mt-3 mb-5 mx-0 px-0">
                  
                    <div class="col-sm-3 mx-0 px-0">
                            <form>
                              <label class="mr-1">Sort by Planting History</label>
                              <select id="inputTransaction_year" name="inputTransaction_year" class="farm-button-cancel py-1 pl-4 mt-2">
                                   <?php

                                      $transaction_year = Db::getInstance()->query("SELECT * FROM transaction_year order by year desc");
                    
                                      if (!$transaction_year->count()) {
                                       ?>
                                       <div class='row'><h3 class='m-5' style="text-align:center">No item to be displayed</h3></div>
                                       <?php
                                      } else {
                    
                                        foreach($transaction_year->results() as $year){
                                            
                                    ?> 
                                <option value="<?php echo $year->year; ?>"><?php echo $year->year; ?></option>
                                    <?php
                                        
                                        }
                                      }  
                                    ?>
                              </select>
                          </form>
                          </div>
                    
                    <div class="col-sm-9 px-0 mx-0">
                      <div class="row justify-content-end pr-3">
                        <div class="col-sm-6 text-right px-0 mx-0"> 
                              <button type="button" class="farm-button-cancel py-1 ml-0" id="add_button" data-toggle="modal" data-target="#AddModal" data-target="#staticBackdrop">
                                <span class="fa fa-plus"></span> Add Crop
                              </button>
                            <button class="farm-button py-1 ml-0 mt-2" id="add_seasonmodal" data-toggle="modal" data-target="#seasonmodal">
                                <span class="fa fa-plus"> Seasons</span>
                              </button>
                                  <button type="button" class="farm-button py-1 ml-0" id="add_plantingmodal" data-toggle="modal" data-target="#plantingmodal">
                                    <span class="fa fa-plus"></span> Planting Format
                                  </button> 
                              <button type="button" class="farm-button-icon-button py-1 ml-0 current_page">
                                <span class="fa fa-refresh"></span>
                              </button>
                            </div>
                      </div>
                    </div>
                  

                </div>

            
               <div class="row mt-0 mb-3 pt-0">
                 
                    <div class="col-sm-12 success_alert" id="success_alert"></div>
                    <div class="col-sm-12 warning_alert" id="warning_alert"></div>
                    
                  </div> 
               <div id="department"></div>
               <div id="sload"></div>
            		
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
    <!-- Add Crop Type Modal !-->

  <div id="AddModal" class="modal fade" data-backdrop="static">
    <div class="modal-dialog modal-lg">
      <form method="post" name="crops_form" id="crops_form" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="farm-color modal-header p-2">
            <p class="modal-title" id="staticBackdropLabel"><i class="fa fa-leaf" aria-hidden="true"></i> New Crop</p>
            <button type="button" class="bg-secondary px-2 border text-white current_page" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
               <div class="row mt-0 mb-3 pt-0">
                 
                    <div class="col-sm-12 success_alert" id="success_alert"></div>
                    <div class="col-sm-12 warning_alert" id="warning_alert"></div>
                    
                  </div>
             <div class="row">
                <div class="col-sm-12 m-0">
                <span style="font-size:0.7rem">Note: the image size should not be more that 10MB, and also the size of the image will decide the duration of 
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
                <div class="col-sm-3">
                    <div class="image-upload">
                        <label for="crop_image">
                            <?php if (empty($staffguarant->crop_image)) {
                                
                                echo '<img id="blah" class="image_resizing_upload mr-1 pr-0" src="view/farm/crops/upload/upload_placeholder.png" alt="Original Image"><canvas class="canvas_upload p-0 m-0"></canvas>';
                                
                            } else {
                                
                                echo '<img id="blah" class="image_resizing_upload mr-1 pr-0" src="view/farm/crops/' . $staffguarant->crop_image . '"  alt="Original Image"><canvas class="canvas_upload p-0 m-0"></canvas>';
                                 
                            } ?>
                            </label>
                            <input accept="image/*" id="crop_image" name="crop_image" type="file" class="d-none" />
                            
                            </div>
                    </div>
              <div class="form-group col-sm-9">
                <label>Crop Type</label>
                <input type="text" name="crop_name" id="crop_name" class="form-control" placeholder="Crop Type" />
              </div>
            </div>
           
            <div class="row">
                 <div class="form-group col-sm-12">
                     <label>Crop Description</label>
                    <input type="text" name="description" id="description" class="form-control" placeholder="Crop Description" />
                    </div>
            </div>
            <div class="row">
                
              <div class="form-group col-sm-6">
                <label>Variety/Strain</label>
                <input type="text" name="variety_strain" id="variety_strain" class="form-control" placeholder="Crop Variety/Strain" />
              </div>
              <div class="form-group col-sm-6">
                <label>Botanical Name</label>
                <input type="text" name="botanical_name" id="botanical_name" class="form-control" placeholder="Crop Botanical Name" />
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <input type="hidden" name="added_by" id="added_by" value="<?php echo $username; ?>"/>
            <button type="submit" class="py-1 px-2 border farm-color mx-0 saveCrop">Add Crop</button>
            <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0 current_page" data-dismiss="modal">Close</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- End Crop Type Modal !-->

  <!-- Create Season Modal !-->

  <div id="seasonmodal" class="modal fade" data-backdrop="static">
    <div class="modal-dialog modal-lg">
     
        <div class="modal-content">
          <div class="farm-color modal-header p-2">
            <p class="modal-title" id="staticBackdropLabel"><i class="fa fa-cloud" aria-hidden="true"></i> Season</p>
            <button type="button" class="bg-secondary px-2 border text-white current_page" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <div class="row mt-0 mb-3 pt-0">
                 
                    <div class="col-sm-12 success_alert" id="success_alert"></div>
                    <div class="col-sm-12 warning_alert" id="warning_alert"></div>
                    
                  </div>
            <div class="row">
                 
              <div class="col-sm-6">
                  <form method="post" id="season_form" name="season_form">
                <div class="row">
                  <div class="form-group col-sm-12">
                    <label>Season Type</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Season Type" />
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-sm-12">
                    <label>Description</label>
                    <input type="text" name="season_description" id="season_description" class="form-control" placeholder="Season Description" />
                  </div>
                </div>
                </form>
              </div>
              <div class="col-sm-6">
                <div class="card" style="border-left:solid 1px #222222">
                  <div class="card-header">
                    Available Season
                  </div>
                  <?php
                   $season = Db::getInstance()->query("SELECT * FROM season_type");

                  if (!$season->count()) {
                      
                    echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                    
                  } else {
                       
                  ?>
                  <table class="table table-hover table-bordered" style="width:100%; font-size:0.8rem">
                      <thead>
                        <tr>
                          <th class="px-2">#</th>
                          <th class="px-2">Season Type &amps; Description</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php
                        $i = 1;
                        
                        foreach ($season->results() as $season_type) {

                
                        ?>

                          <tr>
                            <td class="px-2" style="width: 1%;"><?php echo $i++; ?></td>
                            <td class="px-2"><?php echo $season_type->name; ?>
                            <br><span><?php echo $season_type->season_description; ?></span></td>
                            
                            <td class="px-2 pt-2" style="width: 1%;">
                                <?php
                  
                                      if ($userSyscategory == 1 || $userSyscategory == 2) {
                                          
                                      ?>
                              <div class="dropdown">
                                <button class="btn btn-default dropleft" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                  <i style="font-size:14px" class="fa">&#xf142;</i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                  <div class="_delete" id="<?php echo $season_type->id; ?>" lang="season_type">
                                        <button class="dropdown-item py-0 my-0">
                                             <i class="fa fa-trash"></i>&nbsp; Delete</button>

                                    </div>
                                     </div>
                              </div>
                        
                                 <?php } ?>
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
          <div class="modal-footer">
             <button type="button" class="py-1 px-2 border farm-color mx-0 saveSeason">Add Season</button>
            <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0 current_page" data-dismiss="modal">Close</button>
          </div>
        </div>
    </div>
  </div>

  <!-- End Season Modal !-->

  <!-- Create Planting Format Modal !-->

  <div id="plantingmodal" class="modal fade" data-backdrop="static">
    <div class="modal-dialog modal-lg">
     
        <div class="modal-content">
          <div class="farm-color modal-header p-2">
            <p class="modal-title" id="staticBackdropLabel"><i class="fa fa-tree" aria-hidden="true"></i>  Planting Format</p>
            <button type="button" class="bg-secondary px-2 border text-white current_page" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <div class="row mt-0 mb-3 pt-0">
                 
                    <div class="col-sm-12 success_alert" id="success_alert"></div>
                    <div class="col-sm-12 warning_alert" id="warning_alert"></div>
                    
                  </div>
            <div class="row">
              
              <div class="col-sm-6">
                <div class="card" style="border-left:solid 1px #222222">
                  <div class="card-header farm-menu pt-4">
                    <h4>Format List <br />
                    <span style="font-size:0.7rem">Planting Format Title &amp; Description</span>
                    </h4>
                    
                  </div>
                  <?php
                   $planting_format = Db::getInstance()->query("SELECT * FROM planting_format");

                  if (!$planting_format->count()) {
                      
                    echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                    
                  } else {
                       
                  ?>
                  <table class="table table-hover table-bordered" style="width:100%; font-size:0.8rem">
                      <thead>
                        <tr>
                          <th class="px-2">#</th>
                          <th class="px-2" colspan="2"></th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php
                        $i = 1;
                        
                        foreach ($planting_format->results() as $planting_format) {

                
                        ?>

                          <tr>
                            <td class="px-2" style="width: 1%;"><?php echo $i++; ?></td>
                            <td class="px-2"><?php echo $planting_format->title; ?>
                            <br><span><?php echo $planting_format->format_description; ?></span></td>
                            
                            <td class="px-2 pt-2" style="width: 1%;">
                                <?php
                  
                                      if ($userSyscategory == 1 || $userSyscategory == 2) {
                                          
                                      ?>
                              <div class="dropdown">
                                <button class="btn btn-default dropleft" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                  <i style="font-size:14px" class="fa">&#xf142;</i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                  <div class="_delete" id="<?php echo $planting_format->id; ?>" lang="planting_format">
                                        <button class="dropdown-item py-0 my-0">
                                             <i class="fa fa-trash"></i>&nbsp; Delete</button>

                                    </div>
                                     </div>
                              </div>
                        
                                 <?php } ?>
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
              <div class="col-sm-6">
                  <form method="post" id="format_form" name="season_form">
                <div class="row">
                  <div class="form-group col-sm-12">
                    <label>Title</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Title" />
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-sm-12">
                    <label>Description</label>
                    <input type="text" name="format_description" id="format_description" class="form-control" placeholder="Description" />
                  </div>
                </div>
                </form>
              </div>
            </div>

          </div>
          <div class="modal-footer">
             <button type="button" class="py-1 px-2 border farm-color mx-0 saveFormat">Add Format</button>
            <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0 current_page" data-dismiss="modal">Close</button>
          </div>
        </div>
    </div>
  </div>

  <!-- End Season Modal !-->
 
  <script>
  	function showDepartment(perPageCount, pageNumber) {
        $.ajax({
            type: "GET",
            url: "view/farm/crops/select.php",
            data: "pageNumber=" + pageNumber,
            cache: false,
    		beforeSend: function() {
                $('#sload').html('<img src="loader.png" alt="reload" width="20" height="20" style="margin-top:10px;">');
    			
            },
            success: function(html) {
                $("#department").html(html);
                $('#sload').html(''); 
            }
        });
    }
    $(document).ready(function() {
        showDepartment(10, 1);
    });
    
 </script>
  <script>
   $(document).ready(function(event) {
       
             
        
        $('#inputTransaction_year').change(function(evt){ 
                
            let id = $(this).find(":selected").val(); 
		    
            let transaction_year_month = $('#inputTransaction_year').val(); 
    	
	        	//alert('welcome')
	
            $.ajax({
                type: "GET",
                url: "view/farm/crops/select.php",
               
    			data: {
    			    
    			    transaction_year_month: transaction_year_month
    			},
                cache: false,
        		beforeSend: function() {
        		    
                    $('#load').html('<img src="loader.png" alt="reload" width="20" height="20" style="margin-top:10px;">');
				    $("#loader_httpFeed").show();
        			
                },
                success: function(html) {
                    $("#department").html(html);
                    $('#sload').html(''); 
				    $("#loader_httpFeed").hide();
                }
            });
        
        
         evt.preventDefault();
        
      
      });
      
        $('.saveCrop').on('click', function(e){
             
            
                    let form = $('#crops_form')[0]; // You need to use standard javascript object here 
                    let formData = new FormData(form); 
                   
                 // alert('Checking if event is executed');
                   
            	
            	$.ajax({
            			url: 'view/farm/crops/insert.php',
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
            
        $('.saveSeason').on('click', function(e){
             
            
                    let form = $('#season_form')[0]; // You need to use standard javascript object here 
                    let formData = new FormData(form); 
                   
                 // alert('Checking if event is executed');
                   
            	
            	$.ajax({
            			url: 'view/farm/crops/season_insert.php',
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
            
        $('.saveFormat').on('click', function(e){
             
            
                    let form = $('#format_form')[0]; // You need to use standard javascript object here 
                    let formData = new FormData(form); 
                   
                 // alert('Checking if event is executed');
                   
            	
            	$.ajax({
            			url: 'view/farm/crops/format_insert.php',
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
  



