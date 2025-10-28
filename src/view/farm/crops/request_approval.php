<?php

require_once '../../core/init.php';

$member_id = $_POST['member_id'];

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
              <?php
                             $labeltax = Db::getInstance()->query("SELECT concat(d.firstname, ' ', d.lastname) as registered, a.transaction_year_month, b.number_planted, b.id as crop_planting_id,
                                                                    e.title, f.name as season, a.crop_code, b.crop_type_id,
                                                                    g.grow_location_name as location, b.planting_format_id, b.season_type_id, b.pr_start_date, b.pr_end_date, b.hr_start_date, b.hr_end_date 
                                                                    FROM crop_type a
                                                                    LEFT JOIN crop_planting b ON a.id = b.crop_type_id
                                                                    LEFT JOIN planting_format e ON b.planting_format_id = e.id
                                                                    LEFT JOIN season_type f ON b.season_type_id = f.id
                                                                    LEFT JOIN crop_grow_location g ON b.grow_location_id = g.id
                                                                    LEFT JOIN users c ON a.added_by = c.id
                                                                    LEFT JOIN staff_record d ON c.username = d.user_id 
                                                                    WHERE b.id =$member_id");     
                             if($labeltax->count()){
                                 foreach ($labeltax->results() as $labelta) {
                                     
                                    
                              ?>
            <div class="row my-3 mb-4 justify-content-between">
                <div class="col-sm-6">
                       <h3>Request Approval: <?php echo $labelta->crop_code; ?></h3>     
                  </div>  
                   <div class="col-sm-2">
                         
                    </div> 
                </div>
               
            
             <form id="requestForm" method="post" enctype="multipart/form-data">
                 
                 
                             <div class="row justify-content-end mb-3"> 
                                
                                <div class="col-3 mx-0 px-0">
                                      <button class="farm-button-cancel py-1 ml-0 prev_page" id="<?php echo $labelta->crop_type_id; ?>">
                                        <span class="fa fa-chevron-left"></span>
                                      </button> 
                                      <button type="button" class="farm-button py-1 ml-0 SaveStaff">
                                        <span class="fa fa-save"> Request</span>
                                      </button>
                                      <button class="farm-button-icon-button py-1 ml-0 current_page" id="<?php echo $member_id ?>">
                                        <span class="fa fa-refresh"></span>
                                      </button>
                                     
                                </div>
                             </div>
                 <div class="row">
                    <div class="col-sm-12">
                     <div class="success_alert"></div>
                     <div class="warning_alert"></div>
                 </div>
              </div>
                 
                    <div class="row">
                        <div class="form-group col-sm-3">
                          <label for="amount">Request Amount</label>
                          <input type="text" class="form-control" id="amount" name="amount" value="<?php echo $total_cost; ?>" readonly />
                        </div><div class="form-group col-sm-3">
                          <label for="request_date">Request Date &amp; Time</label>
                          <input type="text" class="form-control" id="request_date" name="request_date" value="<?php echo date("Y-m-d H:i:s"); ?>" readonly />
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-sm-6">
                          <label for="order_description">Order Description</label>
                          <textarea class="form-control" id="order_description" name="order_description" rows="3"></textarea>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-sm-6">
                          <label for="order_remarks">Remarks</label>
                          <textarea class="form-control" id="order_remarks" name="order_remarks" rows="3"></textarea>
                        </div>
                      </div>
             
                          <input type="hidden" class="form-control" id="type_of_bill" name="type_of_bill" value="Purchase Order" />
                          <input type="hidden" class="form-control" id="request_code" name="request_code" value="<?php echo $purchase_code; ?>" />
                         <input type="hidden" class="form-control" id="request_by" name="request_by" value="<?php echo $username; ?>" />
                 
             </form>
         
   


                </div>
            
            </div>

      </div>

  <?php
                                 }
                                }
} else {
  $user->logout();
  Redirect::to('../../login/');
}

  ?>
   
<script>
    $(document).ready(function(event){
         $('.resulter').hide();
         $('.resulterError').hide();
         
        
    	$('.prev_page').click(function (e) {
		
    		let member_id = $(this).attr('id');
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/farm/crops/cropplanting.php",
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
          
       
        
        $('.SaveStaff').on('click', function(){
       
                let form = $('#requestForm')[0]; // You need to use standard javascript object here
                let formData = new FormData(form);  
                
                //alert(formData)
           
                    $.ajax({
        				url: 'view/purchases/orders/insertrequest_approval.php',
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
       
    	
       event.preventDefault();
   });
   
   </script>

