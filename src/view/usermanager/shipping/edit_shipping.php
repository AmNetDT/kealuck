<?php

require_once '../../core/init.php';

$member_id = $_POST['id'];

$user = new User();
if ($user->isLoggedIn()) {

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

            $username_id = escape($user->data()->id);

            $users = Db::getInstance()->query("SELECT a.`id` as ship_id, a.`ship_code`, a.`ship_name`, a.`ship_phone`, a.`ship_status`, a.`ship_address`, a.`ship_contact_person`,
                                    b.name as ship_state, c.name as ship_lga, d.username as added_by  
                                    FROM `cus_shipping` a 
                                    Left Join `states` b on a.ship_state_id = b.id
                                    Left Join lga c on a.ship_lga_id = c.id 
                                    Left Join users d on a.added_by = d.id
                                    WHERE a.`id` = $member_id");
            foreach ($users->results() as $use) {
                
                              $ship_code = $use->ship_code;
            ?>
            <div class="row my-3 mb-4 justify-content-between">
                <div class="col-md-6">
                       <h3>Update Shipping: <?php echo $ship_code; ?></h3>     
                  </div>  
                   <div class="col-md-2">
                      
                    </div> 
                </div>
                
                
             <form id="fatima" method="post" enctype="multipart/form-data">
                 
                 
                             <div class="row justify-content-end mb-3"> 
                                
                                <div class="col-3 mx-0 px-0">
                                      <button type="button" class="farm-button py-1 ml-0 SaveUpdateShipping">
                                        <span class="fa fa-save"> Save</span>
                                      </button>
                                      <button class="farm-button-icon-button py-1 ml-0 current_page" lang="view/usermanager/shipping" id="<?php echo $member_id ?>">
                                        <span class="fa fa-refresh"></span>
                                      </button>
                                     
                                </div>
                             </div>
                 <div class="row">
                    <div class="col-md-12">
                     <div class="success_alert"></div>
                     <div class="warning_alert"></div>
                 </div>
              </div>
                 <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="ship_name">Shipping name</label>
                         <div class="input-group mb-2">
                         <div class="input-group-prepend">
                          <div class="input-group-text">Description</div>
                        </div>
                          <textarea class="form-control" name="ship_name" id="ship_name" rows="3"><?php echo $use->ship_name; ?></textarea>
                           <input type="hidden" name="ship_code" value="<?php echo $ship_code; ?>" id="ship_code"  />
                           <input type="hidden" name="contact_type" value="<?php echo $use->contact_type; ?>" id="contact_type" />
                           <input type="hidden" name="customer_id" value="<?php echo $use->customer_id; ?>" id="customer_id" />
                         </div>
                     </div>
                 </div>       
         
            <div class="row">
             
                <div class="form-group col-sm-6">
                 <label for="ship_phone">Phone</label>
                         <input type="phone" name="ship_phone" id="ship_phone" class="form-control" value="<?php echo $use->ship_phone; ?>"/>
            </div> 
               
                    
                
              <div class="form-group col-sm-6">
              
                <label for="ship_status">Status</label>
                <select class="form-control" id="ship_status" name="ship_status">
                      <option value='<?php echo $use->ship_status; ?>'><?php echo $use->ship_status; ?></option>
                      <option value="Retail">Active</option>
                      <option value="Distributor">Inactive</option>
                </select>
                
              </div>
              </div>
              <div class="row">
              <div class="form-group col-sm-12">
              
                <label for="ship_address">Address</label>
                <textarea class="form-control" id="ship_address" name="ship_address"><?php echo $use->ship_address; ?></textarea>
                
              </div>
            </div>
            
             <div class="row">
                
              <div class="form-group col-md-6">
              
                <label for="ship_state_id">State</label>
                <select class="form-control" id="ship_state_id" name="ship_state_id">
                      <option value="<?php echo $use->ship_state_id; ?>"><?php echo $use->ship_state; ?></option>
                      <?php
                 
                    $department = Db::getInstance()->query("SELECT id, name FROM `states` ORDER BY `name` ASC");
                    foreach ($department->results() as $department) {

                  ?>
                      <option value="<?php echo $department->id; ?>" title="<?php echo $department->name; ?>"><?php echo $department->name; ?></option>
                    <?php
                    }
                  
                  ?>
                </select>
                
              </div>
              <div class="form-group col-md-6">
              
                <label for="ship_lga_id">LGA</label>
                <select class="form-control" id="ship_lga_id" name="ship_lga_id">
                      <option value="0" selected><?php echo $use->ship_lga; ?></option>
                </select>
                
              </div>
              
            </div>
            
            
                 <input type="hidden" name="added_by" id="added_by" value="<?php echo $username_id; ?>" />
                 <input type="hidden" name="id" id="id" value="<?php echo $use->ship_id; ?>"  />
                 
             </form>
         <?php }
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
   
<script>
    $(document).ready(function(){
     $('.resulter').hide();
     $('.resulterError').hide();
    })
</script>

 
<script>
   $(document).ready(function(event) {
    
    
       
	$('.current_page').click(function (e) {
		
		let ed = $(this).attr('lang');
		let id = $(this).attr('id');
	
		//Pssing values to nextPage 
		let rsData = "eQvmTfgfru";
		let dataString = "rsData=" + rsData;
        //alert(dataString);
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: ed + "/edit_shipping.php",
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

        
        $('.SaveUpdateShipping').on('click', function(){
       
                let form = $('#fatima')[0]; // You need to use standard javascript object here
                let formData = new FormData(form);  
                
                //alert(formData)
           
                    $.ajax({
        				url: 'view/usermanager/shipping/update.php',
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
       
     $("#ship_state_id").change(function(){  
	    const id = $(this).find(":selected").val();
		const dataString = 'state_id='+ id;  
		
		//alert(dataString);
	
		$.ajax({
			url: 'view/usermanager/shipping/getlga.php',
            dataType: 'json',
			data: dataString,  
			cache: false,
			success:function(response){
                
                const len = response.length;

                $("#ship_lga_id").empty();
                
                    for( var i = 0; i<len; i++){
                    const id = response[i]['id'];
                    const name = response[i]['name'];
                
                    $("#ship_lga_id").append("<option value='"+id+"'>"+name+"</option>");
                }
				 	
			} 
		});
 	}) 
       
   });
   
   </script>

