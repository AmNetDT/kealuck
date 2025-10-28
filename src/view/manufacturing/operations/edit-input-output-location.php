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
                        <h3><i class="fa fa-edit p-1" aria-hidden="true"></i> Update Warehouse</h3>
                        </div>
                        <div class="col-sm-3">
                              <button class="farm-button-cancel py-1 ml-0 prev_page" id="<?php echo $member_id; ?>">
                                <span class="fa fa-chevron-left"></span> 
                              </button>
                        </div>
                </div>
          <div class="row my-3">
            <div class="col-sm-12">
           
                   <div class="row mt-0 mb-3 pt-0">
                     
                        <div class="col-sm-12 p-0 m-0 success_alert" id="success_alert"></div>
                        <div class="col-sm-12 p-0 m-0 warning_alert" id="warning_alert"></div>
                        <div class="col-sm-12 alert alert-warning" id="locationalert"></div>
                    
                  </div> 
                  <div class="row my-5">
                <?php
                //workorders table
                 $update = Db::getInstance()->query("SELECT w1.location AS inputs_warehouse_name,
                                                            w2.location AS output_warehouse_name
                                                        FROM workorders a
                                                        LEFT JOIN worklocation w1 ON a.inputs_warehouse_id = w1.id
                                                        LEFT JOIN worklocation w2 ON a.output_warehouse_id = w2.id
                                                        WHERE a.id = $member_id");
                 foreach ($update->results() as $update) {
                
                ?>
                       
                    <form id="warehouseform" method="post">
                            <div class="modal-body">
                                
                          <div class="row"> 
              <div class="form-group col-sm-6">
              
                <label for="inputs_warehouse_location_type">Location Type (Input)</label>
                <select class="form-control" id="inputs_warehouse_location_type" name="inputs_warehouse_location_type">
                    <option value=""></option>
                    <?php
                    
                             $user = Db::getInstance()->query("SELECT * FROM worklocation_type");

                              if (!$user->count()) {
                                echo "<option value=''>No data to be displayed</option>";
                              } else {
                                foreach ($user->results() as $usr) {
                    ?>
                    <option value="<?php echo $usr->id; ?>"><?php echo $usr->description; ?></option>
                    <?php
                    
                                }
                              }    
                    
                    ?>
                </select>
                
              </div>
              <div class="form-group col-sm-6">
              
                 <label for="output_warehouse_location_type">Location Type (Output)</label>
                <select class="form-control" id="output_warehouse_location_type" name="output_warehouse_location_type">
                    <option value=""></option>
                    <?php
                    
                             $user = Db::getInstance()->query("SELECT * FROM worklocation_type");

                              if (!$user->count()) {
                                echo "<option value=''>No data to be displayed</option>";
                              } else {
                                foreach ($user->results() as $usr) {
                    ?>
                    <option value="<?php echo $usr->id; ?>"><?php echo $usr->description; ?></option>
                    <?php
                    
                                }
                              }    
                    
                    ?>
                </select>
                
              </div>
              
            </div>
                          <div class="row"> 
              <div class="form-group col-sm-6">
              
                <label for="inputs_warehouse_id">Input Items Warehouse</label>
                <select class="form-control" id="inputs_warehouse_id" name="inputs_warehouse_id">
                    <?php
                            if(!empty($update->inputs_warehouse_name)){
                    ?>
                    <option value="<?php echo $update->inputs_warehouse_id; ?>"><?php echo $update->inputs_warehouse_name; ?></option>
                    <?php
                            }
                            ?>
                </select>
                <div class="invalid-feedback fetchedinputs_warehouse">
                        Please, select an Input Items Warehouse.
                      </div>
              </div>
              <div class="form-group col-sm-6">
              
                <label for="output_warehouse_id">Output Items Warehouse</label>
                <select class="form-control" id="output_warehouse_id" name="output_warehouse_id">
                    <?php
                            if(!empty($update->output_warehouse_name)){
                    ?>
                    <option value="<?php echo $update->output_warehouse_id; ?>"><?php echo $update->output_warehouse_name; ?></option>
                    <?php
                            }
                            ?>
                </select>
                <div class="invalid-feedback fetchedoutput_warehouse">
                        Please, select an Output Items Warehouse.
                      </div>
              </div>
            </div>
            
                      <input type="hidden" name="added_by" id="added_by" value="<?php echo $username; ?>" />
                      <input type="hidden" name="id" id="id" value="<?php echo $member_id; ?>" />
                      
                       </div>
                        <div class="modal-footer">
                            <button type="button" class="farm-button py-1 ml-0 update-Input-Output-location">
                                <span class="fa fa-save"> Save</span>
                              </button>
                            <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0 prev_page" data-dismiss="modal" id="<?php echo $member_id; ?>">Close</button>
                          </div>
                     </form>
                  
                  <?php
                  
                        } 
                  
                  ?>
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
       
        $("#locationalert").hide();
       
       	$('.prev_page').click(function (e) {
    	
    		let member_id = $(this).attr('id');
    	
            //alert(dataString);
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/manufacturing/operations/editorder.php",
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
        
       
      
          $('.update-Input-Output-location').on('click', function(){
                 
                     let input_s = $('#inputs_warehouse_location_type').val();
                     let output_s = $('#output_warehouse_location_type').val();
                     
                    if(input_s !='' || output_s !=''){
                         
                            let form = $('#warehouseform')[0]; // You need to use standard javascript object here
                            let formData = new FormData(form); 
                 
                
                    $.ajax({
        				url: 'view/manufacturing/operations/update-input-output-location.php',
        				data: formData,
                        type: 'POST',
                        contentType: false,  // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                        processData: false, // NEEDED, DON'T OMIT THIS
                        success:function(data){
                            $(".success_alert").html(data);
                            $(".success_alert").show();
                            $("#locationalert").hide();
                         
                        }, 
                        error:function(data){
                            $(".warning_alert").html(data);
                            $(".warning_alert").show();
                            $("#locationalert").hide();
                        }
                    });  
                    
                     }else{
                         $("#locationalert").show();
                         $("#locationalert").append('Location type should not be empty');
                         
                     }
                
            });
            
          
    	$("#inputs_warehouse_location_type").change(function(){  
	    
	        let id = $(this).find(":selected").val();
		    let dataString = 'inputs_warehouse_location_type='+ id;  
		
		    //alert(dataString);
	
    		$.ajax({
    			url: 'view/manufacturing/operations/getinput.php',
                dataType: 'json',
    			data: dataString,  
    			cache: false,
    			contentType: false,  // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                processData: false, // NEEDED, DON'T OMIT THIS
    			success:function(response){
                    
                    let len = response.length;
    
                    $("#inputs_warehouse_id").empty();
                    
                        for( let i = 0; i<len; i++){
                       
                        let id = response[i]['id'];
                        let location = response[i]['location'];
                        
                      
                        //alert(location);
                     
                        $('#inputs_warehouse_id').append($('<option>', {
                                value: id,
                                text: location
                         }));
                      
                    
                    }
    				 	
    			} 
    		});
     	}); 
     	
     	$("#output_warehouse_location_type").change(function(){  
	    
    	    let id = $(this).find(":selected").val();
    		let dataString = 'output_warehouse_location_type='+ id;  
		
		//alert(dataString);
	
    		$.ajax({
    			url: 'view/manufacturing/operations/getoutput.php',
                dataType: 'json',
    			data: dataString,  
    			cache: false,
    			contentType: false,  // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                processData: false, // NEEDED, DON'T OMIT THIS
    			success:function(response){
                    
                    let len = response.length;
    
                    $("#output_warehouse_id").empty();
                    
                    for( let i = 0; i<len; i++){
                   
                    let id = response[i]['id'];
                    let location = response[i]['location'];
                    
                  
                    //alert(location);
                 
                    $('#output_warehouse_id').append($('<option>', {
                            value: id,
                            text: location
                     }));
                  
                
                }
				 	
			} 
		});
 	}); 

             
   
   event.preventDefault();
   });
  </script>
  



