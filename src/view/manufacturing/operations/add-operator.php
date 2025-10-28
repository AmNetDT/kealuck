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
                        <h3><i class="fa fa-edit p-1" aria-hidden="true"></i> Add Operator</h3>
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
                    
                  </div> 
                  <div class="row my-5">
                <form id="WOperation_form" name="WOperation_form" method="post">
                          <div class="modal-body">
                                <div class="row justify-content-between">
                                    <div class="col-8">
                                        <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <label class="input-group-text" for="workoperation_description_id">Operator(s)</label>
                                  </div>
                                  <select class="custom-select" id="workoperation_description_id" name="workoperation_description_id">
                                    <option selected>--Select--</option>
                                    <?php
                                      $products = Db::getInstance()->query("SELECT * FROM `workoperation_description`");
                                         if (!$products->count()) {
                                             
                                             echo '<h4 class="text-center my-5 py-5">No data to be displayed</h4>';
                                             
                                         }else{
                                           
                                                    foreach ($products->results() as $prod) {
                                             ?>
                                        
                                          <option value="<?php echo $prod->id; ?>"><?php echo $prod->description; ?></option>
                                          <?php
                                                  }
                                                                                     }
                                              ?>
                                        </select>
                                </div>
                                    </div>
                                    <div class="col-4">
                                        <input type="text" name="wop_code" id="wop_code" class="form-control" value="WOP<?php echo mt_rand(1000,9999); ?>" readonly />
                                        
                                    </div>
                                </div>
                                <div class="row justify-content-between">
                                <div class="col-4">
                                    <label for="description_operation">Description</label>
                                    <input type="text" name="description_operation" id="description_operation" class="form-control" readonly />
                                </div>
                                  <div class="col-4">
                                    <label for="cost_per_hour">Cost per hour</label>
                                    <input type="text" name="cost_per_hour" id="cost_per_hour" class="form-control" readonly />
                                </div>
                                <div class="col-4">
                                    <label for="duration_in_hour">Hour</label>
                                    <input type="number" name="duration_in_hour" id="duration_in_hour" class="form-control" />
                                </div>
                                </div>
                                <div class="row justify-content-between my-3">
                                    <div class="col-6">
                                        <div class="input-group mb-3">
                                              <div class="input-group-prepend">
                                                    <label class="input-group-text" for="estimated_cost">Estimated Cost</label>
                                              </div>
                                        <input type="text" name="estimated_cost" id="estimated_cost" class="form-control" readonly />
                                      </div>
                                    </div>
                                    <div class="col-6">
                                         <div class="input-group mb-3">
                                              <div class="input-group-prepend">
                                                <label class="input-group-text" for="assign_to">Assign to</label>
                                              </div>
                                              <select class="custom-select" id="assign_to" name="assign_to">
                                                <option selected>--Select--</option>
                                                <?php
                                                  $products = Db::getInstance()->query("SELECT id, name, contractor_code as code FROM `contractors`
                                                                                        UNION
                                                                                        select b.id, concat(b.firstname,' ',b.lastname) as name, b.user_id as code 
                                                                                        from users a 
                                                                                        left join staff_record b on a.username = b.user_id
                                                                                        WHERE a.department_id = 10");
                                                     if (!$products->count()) {
                                                         
                                                         echo '<h4 class="text-center my-5 py-5">No data to be displayed</h4>';
                                                         
                                                     }else{
                                                       
                                                                foreach ($products->results() as $prod) {
                                                         ?>
                                                    
                                                      <option value="<?php echo $prod->name .' - '. $prod->code; ?>"><?php echo $prod->name .' - '. $prod->code; ?></option>
                                                      <?php
                                                              }
                                                                                                 }
                                                          ?>
                                        </select>
                                            </div>
                                    </div>
                                </div>
                                <div class="row justify-content-between my-3">
                                    <div class="col-12">
                                    <label for="note">Note</label>
                                    <textarea class="form-control" id="additional_info" name="additional_info"></textarea>
                                    </div>
                                </div>
                                <input type="hidden" name="workorders_id" id="workorders_id" value="<?php echo $member_id; ?>" />
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="farm-button py-1 ml-0 add-operation">
                            <span class="fa fa-save"> Save</span></button>
                        <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0 prev_page" data-dismiss="modal" id="<?php echo $member_id; ?>">Cancel</button>
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
    </div>
  <?php

} else {
  $user->logout();
  Redirect::to('../../login/');
}

  ?>
  

 
 
  <script>
   $(document).ready(function(event) {
       
       
       	$('.prev_page').click(function (e) {
    	
    		let member_id = $(this).attr('id');
    	
            //alert(dataString);
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/manufacturing/operations/editorder.php",
    			data: {
    				member_id : member_id
    			},
    			cache: false,
    			success: function (msg) {
    				$("#contentbar_inner").html(msg);
    				$("#loader_httpFeed").hide();
    			}
    		});
    		e.preventDefault();
    	});
        
        $('.add-operation').on('click', function(){
       
                let form = $('#WOperation_form')[0]; // You need to use standard javascript object here
                let formData = new FormData(form);  
                
                //alert(formData)
           
                    $.ajax({
        				url: 'view/manufacturing/operations/insert-operation.php',
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
      
        $("#workoperation_description_id").change(function(){  
	    
	    let id = $(this).find(":selected").val();
		let dataString = 'workoperation_description_id='+ id;  
		
		//alert(dataString);
	
		$.ajax({
			url: 'view/manufacturing/operations/getworkoperation.php',
            dataType: 'json',
			data: dataString,  
			cache: false,
			success:function(response){
                
                let len = response.length;

                $("#cost_per_hour").empty();
                $("#description").empty();
                
                    for( let i = 0; i<len; i++){
                   
                   
                    let cost_per_hour = response[i]['cost_per_hour'];
                    let description = response[i]['description'];
                     //alert(cost_per_hour);
                    
                   $('#cost_per_hour').val(cost_per_hour);
                   $('#description_operation').val(description);
                  
                  }
    				 	
    			} 
    		});
     	}) 
 	  
 	     $("#duration_in_hour").change(function(){  
		
	    let cost_per_hour = $('#cost_per_hour').val();
	    let hour = $('#duration_in_hour').val();
		
		let hour_equal = cost_per_hour * hour;
		
		//alert(hour_equal);
	     $('#estimated_cost').val(hour_equal);
	
     	});
        
             
   
   event.preventDefault();
   });
  </script>
  



