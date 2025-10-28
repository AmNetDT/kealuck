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
                <h3><i class="fa fa-puzzle-piece" aria-hidden="true"></i> Bin</h3>
            </div>
            <div class="row justify-content-between mb-4">
                   <div class="col-sm-9">
                      
                      </div>
                      
                  
                    <div class="col-sm-3 text-right">
                      <button class="farm-button-cancel py-1 ml-0 edituser_view">
                        <span class="fa fa-chevron-left"></span>
                      </button>
                      <button class="farm-button py-1 ml-0" id="add_button" data-toggle="modal" data-target="#addModal">
                        <span class="fa fa-plus">Add Bin</span>
                      </button>
                      <button class="farm-button-icon-button py-1 ml-0 editstaff_index">
                        <span class=" fa fa-refresh"></span>
                      </button>
                    </div>
                </div>
           
              
          <div class="row">
              <div class="col-sm-12 alert alert-success m-0 success_alert" id="success_alert"></div>
              <div class="col-sm-12 alert alert-warning m-0 warning_alert" id="warning_alert"></div>
          </div>      
         <div class="row">
            <div class="col-12">
            <div id="binview"></div>
               <div id="bload"></div> 
        </div>
        </div>
        
            		
            		
      </div>
    </div>
  </div>
<div id="addModal" class="modal fade" data-backdrop="static">
    <div class="modal-dialog">
      
        <div class="modal-content">
          <div class="farm-color modal-header p-2">
            <p class="modal-title" id="staticBackdropLabel">Add New Bin</p>
            <button type="button" class="bg-secondary px-2 border text-white editstaff_index" id="<?php echo $member_id; ?>" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          
              <div class="row mt-0 mb-3 pt-0">
                 
                    <div class="col-sm-12 success_alert" id="success_alert"></div>
                    <div class="col-sm-12 warning_alert" id="warning_alert"></div>
                    
                  </div>
          <form id="bin_form" method="post">
        
          <div class="modal-body pt-0">
              <div class="row">
                  
              <div class="form-group col-sm-4">
              <?php $Rahma = mt_rand(100,999); ?>
                <label for="bin_code">Bin Code</label>
                <input type="text" id="bin_code" name="bin_code" class="form-control" value="BIN<?php echo $Rahma; ?>" readonly />
              </div>
            
              
                  <div class="form-group col-sm-8">
                    <label for="description">Description</label>
                     <input type="text"class="form-control" id="description" name="description" rows="3" />
                  </div>
              </div>
              <div class="row">
                  <div class="form-group col-sm-6">
              
                <label for="warehouse">Warehouse</label>
                <select class="form-control" id="warehouse_id" name="warehouse_id">
                    <option value="">-- Choose --</option>
                    <?php
                    
                             $user = Db::getInstance()->query("SELECT * FROM worklocation");

                              if (!$user->count()) {
                                echo "<option value=''>No data to be displayed</option>";
                              } else {
                                foreach ($user->results() as $usr) {
                    ?>
                    <option value="<?php echo $usr->location; ?>"><?php echo $usr->location; ?></option>
                    <?php
                    
                                }
                              }    
                    
                    ?>
                </select>
                
              </div>
              <div class="form-group col-sm-4 metric_units">
                        <label for="metric_units">Metric Type</label>
                        <select class="form-control" id="metric_type" name="metric_type">
                          <option value="">--Select--</option>
                          <option value="bales">bales</option>
                          <option value="barrels">barrels</option>
                          <option value="bunches">bunches</option>
                          <option value="bushes">bushes</option>
                          <option value="dozen">dozen</option>
                          <option value="grams">grams</option>
                          <option value="head">head</option>
                          <option value="kilograms">kilograms</option>
                          <option value="kilolitre">kilolitre</option>
                          <option value="litre">litre</option>
                          <option value="millilitre">millilitre</option>
                          <option value="quantity">quantity</option>
                          <option value="tonnes">tonnes</option>
                        </select>
                        
                      </div>
              <div class="form-group col-sm-4">
                <label for="max_capacity">Max Capacity</label>
                <input type="number" name="max_capacity" id="max_capacity" class="form-control" placeholder="0.00" />
              </div>
              
            </div>
          </div>
          <div class="modal-footer">
              
            
             <input type="hidden" id="added_by" name="added_by" value="<?php echo $username; ?>" />
            <button type="button" class="py-1 px-2 border farm-color mx-0 savebin">Add New</button>
            <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0 editstaff_index" id="<?php echo $member_id; ?>" data-dismiss="modal">Close</button>
          
          </div>
      </form>
        </div>
    </div>
  </div>
  
<?php

} else {
  $user->logout();
  Redirect::to('app.kealuck.com/login/');
}


?>



 
  <script>
   function showWorkLocation(perPageCount, pageNumber) {
        $.ajax({
            type: "GET",
            url: "view/configurations/bin/select.php",
            data: "pageNumber=" + pageNumber,
            cache: false,
    		beforeSend: function() {
                $('#bload').html('<img src="loader.png" alt="reload" width="20" height="20" style="margin-top:10px;">');
    			
            },
            success: function(html) {
                $("#binview").html(html);
                $('#bload').html(''); 
            }
        });
    }
    
   $(document).ready(function(event) {
        showWorkLocation(4, 1);
        
        $('.success_alert').hide();
        $('.warning_alert').hide();
        
           
            
         	$('.edituser_view').click(function () {
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/configurations",
    			cache: false,
    			success: function (msg) {
    				$("#contentbar_inner").html(msg);
    				$("#loader_httpFeed").hide();
    			}
    		});
    	});   
       
        $('.savebin').on('click', function(e){
        
                    let form = $('#bin_form')[0]; // You need to use standard javascript object here 
                    let formData = new FormData(form); 
       	        
       	        //alert(formData);
       	        
    			
    			$.ajax({
        				url: 'view/configurations/bin/insert.php',
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
       
       
        $('.editstaff_index').click(function () {
		
	
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: 'view/configurations/bin',
			cache: false,
			success: function (msg) {
				$("#contentbar_inner").html(msg);
				$("#loader_httpFeed").hide();
			}
		});
	});  
	
	
	     $('.insert_index').click(function () {
		
	
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: 'view/configurations/bin/',
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
  

  