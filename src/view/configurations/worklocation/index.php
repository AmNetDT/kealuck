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
      <div class="jumbotron jumbotron-fluid pt-5 bg-white">
        <div id="accounttile" class="container">
            <div class="row m-3 mb-4">
                <h3><i class="fa fa-puzzle-piece" aria-hidden="true"></i> WorkLocation</h3>
            </div>
            <div class="col-sm-12">
                <div class="row justify-content-end mb-4">
                    <div class="edituser_view col-sm-2" lang="view/configurations">
                                       
                                    </div>
                   <div class="col-sm-5">
                      
                      </div>
                      
                  
                    <div class="col-sm-5">
                      <button class="farm-button-cancel py-1 ml-0 edituser_view" lang="view/configurations" id="#">
                        <span class="fa fa-chevron-left"></span>
                      </button>
                      <button class="farm-button py-1 ml-0" id="add_button" data-toggle="modal" data-target="#addWorkModal">
                        <span class="fa fa-plus"> Add Work Location</span>
                      </button>
                      <button class="farm-button py-1 ml-0" id="add_button" data-toggle="modal" data-target="#locationTypeModal">
                        <span class="fa fa-search"> Location Type</span>
                      </button>
                      <button class="farm-button-icon-button py-1 ml-0 editstaff_index">
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
  </div>

<!-- Create Work Location Modal !-->
<div id="addWorkModal" class="modal fade" tabindex="-1" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title">Add Work Location</h6>
        <button type="button" class="close editstaff_index" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="locationInsert" method="POST" autocomplete="off">
       <div class="modal-body" style="font-size:0.8rem">
           <?php $abdusalam = mt_rand(0001,9999); ?>
           <div class="row mt-0 mb-3 pt-0">
                      
                    <div class="col-sm-12 success_alert" id="success_alert"></div>
                    <div class="col-sm-12 warning_alert" id="warning_alert"></div>
                    
                  </div>
    
                 
                      <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="location">Work Location</label>
                             <div class="input-group mb-2">
                             <div class="input-group-prepend">
                              <div class="input-group-text">Description</div>
                            </div>
                            <input type="text" class="form-control" id="location" name="location" placeholder="Location Name">
                               
                            </div> 
                          </div>
                        
                      </div>
                      
                      <div class="row">
                          <div class="form-group col-sm-9">
                          <label for="inputs_warehouse">Location Type</label>
                            <select class="form-control" id="worklocation_type_id" name="worklocation_type_id">
                                <option value="">-- Choose --</option>
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
                          <div class="form-group col-sm-3">
                            <label for="location_code">Location Code</label>
                            <label class="form-control bg-light">LOC<?php echo $abdusalam; ?></label><input type="hidden" id="location_code" name="location_code" value="LOC<?php echo $abdusalam; ?>" />
                          </div>
                      </div>
                      <div class="row">
                      <div class="form-group col-sm-12">
                                  <label for="address">Address</label>
                                      <div class="input-group">
                                        <div class="input-group-prepend">
                                          <div class="input-group-text">Optional</div>
                                        </div>
                                        <textarea class="form-control" id="address" name="address" placeholder="Location Address"></textarea>
                                  </div>
                                  
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                                  <label class="sr-only" for="longitude">Longitude</label>
                                  <div class="input-group">
                                    <input type="text" class="form-control" id="longitude" name="longitude" placeholder="Longitude">
                                
                                  </div>
                                  
                        </div>
                        <div class="form-group col-sm-6">
                                  <label class="sr-only" for="latitude">Latitude</label>
                                  <div class="input-group">
                                    <input type="text" class="form-control" id="latitude" name="latitude" placeholder="Latitude">
                                
                    <input type="hidden" id="added_by" name="added_by" value="<?php echo $username; ?>" />
                                  </div>
                                 
                        </div>
                      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="farm-button py-1 ml-0 SaveStaff">
        <span class="fa fa-save"> Save</span></button>
        <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0 editstaff_index" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>  

<div id="locationTypeModal" class="modal fade" tabindex="-1" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title">Location Type</h6>
        <button type="button" class="close editstaff_index" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="locationtype" method="POST" autocomplete="off">
       <div class="modal-body" style="font-size:0.8rem">
           
           <div class="row mt-0 mb-3 pt-0">
                      
                    <div class="col-sm-12 success_alert" id="success_alert"></div>
                    <div class="col-sm-12 warning_alert" id="warning_alert"></div>
                    
                  </div>
    
                 
                      <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="location">Location Type</label>
                             <div class="input-group mb-2">
                             <div class="input-group-prepend">
                              <div class="input-group-text">Description</div>
                            </div>
                            <textarea class="form-control" id="description" name="description" placeholder="Description"></textarea>
                               
                            </div> 
                          </div>
                        
                      </div>
                      
      </div>
      <div class="modal-footer">
        <button type="button" class="farm-button py-1 ml-0 SavelocationType">
        <span class="fa fa-save"> Save</span></button>
        <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0 editstaff_index" data-dismiss="modal">Close</button>
      </div>
      </form>
      
    <div class="container">
      <div class="row">
          <div class="col-sm-12">
              <div id="locationview"></div>
               <div id="load"></div> 
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
   function showWorkLocation(perPageCount, pageNumber) {
        $.ajax({
            type: "GET",
            url: "view/configurations/worklocation/select.php",
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
    
    function showLocation(perPageCount, pageNumber) {
        $.ajax({
            type: "GET",
            url: "view/configurations/worklocation/selectlocationtype.php",
            data: "pageNumber=" + pageNumber,
            cache: false,
    		beforeSend: function() {
                $('#load').html('<img src="loader.png" alt="reload" width="20" height="20" style="margin-top:10px;">');
    			
            },
            success: function(html) {
                $("#locationview").html(html);
                $('#load').html(''); 
            }
        });
    }
    
   $(document).ready(function(event) {
        showWorkLocation(4, 1);
        showLocation(4, 1);
        
        $('.success_alert').hide();
        $('.warning_alert').hide();
        
            
        $('.edituser_view').click(function (e) {
    		
    		var ed = $(this).attr('lang');
    	
    		//Pssing values to nextPage 
    		var rsData = "eQvmTfgfru";
    		var dataString = "rsData=" + rsData;
            //alert(dataString);
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: ed + "/index.php",
    			cache: false,
    			success: function (msg) {
    				$("#contentbar_inner").html(msg);
    				$("#loader_httpFeed").hide();
    			}
    		});
    		e.preventDefault();
    	});   
        
        $('.SavelocationType').on('click', function(e){
       
                let form = $('#locationtype')[0]; // You need to use standard javascript object here
                let formData = new FormData(form);  
                
                //alert(formData)
           
                    $.ajax({
        				url: 'view/configurations/worklocation/insertlocationtype.php',
        				data: formData,
                        type: 'POST',
                        contentType: false,  // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                        processData: false, // NEEDED, DON'T OMIT THIS
                        success:function(data){
                            $(".success_alert").html(data);
                            $(".success_alert").show();
                            $('#userr').html(''); 
                                  setTimeout(function(){// wait for 5 secs(2)
                                       $(document).ready(function() {
                                        showWorkLocation(10, 1);
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
       
        $('.SaveStaff').on('click', function(e){
       
                let form = $('#locationInsert')[0]; // You need to use standard javascript object here
                let formData = new FormData(form);  
                
                //alert(formData)
           
                    $.ajax({
        				url: 'view/configurations/worklocation/insert.php',
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
                                        showWorkLocation(10, 1);
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
       
        $('.editstaff_index').click(function (e) {
		
		$.ajax({
			type: "POST",
			url: 'view/configurations/worklocation',
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
  

  