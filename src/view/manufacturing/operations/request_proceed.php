<?php

require_once '../../core/init.php';

$member_id = $_POST['member_id'];

$user = new User();
if ($user->isLoggedIn()) {
$username = escape($user->data()->id);

$users = Db::getInstance()->query("SELECT *
            FROM workorders
            WHERE id =  $member_id");
                  
            foreach ($users->results() as $use){
                
                $operation_type         = $use->type;
                $order_description      = $use->description;
                
               
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
              
               if($operation_type === 'Internal'){
                  
                             
                             $labeltax = Db::getInstance()->query("SELECT SUM(a.unit_cost * a.qty) as cost, b.wo_code
                                                                    FROM workorders_orders a 
                                                                    left join workorders b on a.workorders_id = b.id
                                                                    WHERE b.id = $member_id");     
                             if($labeltax->count()){
                                 foreach ($labeltax->results() as $labelta) {
                                     
                                 
                                $cost = $labelta->cost;
                                //Work Operator Cost
                                $operator = Db::getInstance()->query("SELECT * FROM workoperation WHERE workorders_id = $member_id");
                                foreach ($operator->results() as $operate) {
                                $operate_cost = $operate->estimated_cost;
                                    
                                    
                                $workorders_utility = Db::getInstance()->query("SELECT SUM(amount) as amount FROM workorders_utility WHERE workorders_id = $member_id");
                                foreach ($workorders_utility->results() as $workorders_util) {
                                $workorders_ut = $workorders_util->amount;
                                $total_cost = $cost + $workorders_ut + $operate_cost;
                                
                              ?>
                                    &nbsp;<span class="text-success">NGN <?php echo $total_cost; ?>.00</span>
                             <?php
                                    }
                                 }
                                }
                             }
                              ?>
            <div class="row my-3 mb-4 justify-content-between">
                <div class="col-sm-6">
                       <h3>Save Proceed: <?php echo $labelta->wo_code; ?></h3>     
                   </div>  
                   <div class="col-sm-2">
                         
                    </div> 
                </div>
               
            
             <form id="requestForm" method="post" enctype="multipart/form-data">
                 
                 
                             <div class="row justify-content-end mb-3"> 
                                
                                <div class="col-3 mx-0 px-0">
                                      <button class="farm-button-cancel py-1 ml-0 prev_page" id="<?php echo $member_id ?>">
                                        <span class="fa fa-chevron-left"></span>
                                      </button> 
                                      <button type="button" class="farm-button py-1 ml-0 SaveStaff">
                                        <span class="fa fa-save"> Proceed</span>
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
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <label class="input-group-text" for="assign_to">NGN</label>
                              </div>
                              <input type="text" class="form-control" id="amount" name="amount" value="<?php echo $total_cost; ?>.00" readonly />
                            </div>
                        </div><div class="form-group col-sm-3">
                          <label for="request_date">Request Date &amp; Time</label>
                          <input type="text" class="form-control" id="request_date" name="request_date" value="<?php echo date("Y-m-d H:i:s"); ?>" readonly />
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-sm-6">
                          <label for="order_description">Order Description</label>
                          <input type="text" class="form-control" id="order_description" name="order_description" value="<?php echo $order_description; ?>" readonly />
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-sm-6">
                          <label for="order_remarks">Remarks</label>
                          <textarea class="form-control" id="order_remarks" name="order_remarks" rows="3"></textarea>
                        </div>
                      </div>
             
                    <input type="hidden" class="form-control" id="type_of_bill" name="type_of_bill" value="Work Order" />
                    <input type="hidden" class="form-control" id="request_code" name="request_code" value="<?php echo $labelta->wo_code; ?>" />
                    <input type="hidden" class="form-control" id="request_by" name="request_by" value="<?php echo $username; ?>" />
                    
                    
                    
                 
             </form>
         <?php

              }else{
                                 
                             $labeltax = Db::getInstance()->query("SELECT total_revenue as cost, b.wo_code
                                                                    FROM workoutput a 
                                                                    left join workorders b on a.workorders_id = b.id
                                                                    WHERE b.id = $member_id");     
                             if($labeltax->count()){
                                 foreach ($labeltax->results() as $labelta) {
                                     
                                     
                                $cost = $labelta->cost;
                                //Work Operator Cost
                               $operator = Db::getInstance()->query("SELECT * FROM workoperation WHERE workorders_id = $member_id");
                                foreach ($operator->results() as $operate) {
                                    $operate_cost = $operate->estimated_cost;
                                    
                                    
                                $total_cost = $cost + $operate_cost;
                                
                              ?>
                                    &nbsp;<span class="text-success">NGN <?php echo $total_cost; ?>.00</span>
                             <?php
                                    }
                                 }
                                }
                             ?>
            <div class="row my-3 mb-4 justify-content-between">
                <div class="col-sm-6">
                       <h3>Save Proceed: <?php echo $labelta->wo_code; ?></h3>     
                   </div>  
                   <div class="col-sm-2">
                         
                    </div> 
                </div>
               
            
             <form id="requestForm" method="post" enctype="multipart/form-data">
                 
                 
                             <div class="row justify-content-end mb-3"> 
                                
                                <div class="col-3 mx-0 px-0">
                                      <button class="farm-button-cancel py-1 ml-0 prev_page" id="<?php echo $member_id ?>">
                                        <span class="fa fa-chevron-left"></span>
                                      </button> 
                                      <button type="button" class="farm-button py-1 ml-0 SaveStaff">
                                        <span class="fa fa-save"> Proceed</span>
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
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <label class="input-group-text" for="assign_to">NGN</label>
                              </div>
                              <input type="text" class="form-control" id="amount" name="amount" value="<?php echo $total_cost; ?>.00" readonly />
                            </div>
                        </div><div class="form-group col-sm-3">
                          <label for="request_date">Request Date &amp; Time</label>
                          <input type="text" class="form-control" id="request_date" name="request_date" value="<?php echo date("Y-m-d H:i:s"); ?>" readonly />
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-sm-6">
                          <label for="order_description">Order Description</label>
                          <input type="text" class="form-control" id="order_description" name="order_description" value="<?php echo $order_description; ?>" readonly />
                        
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-sm-6">
                          <label for="order_remarks">Remarks</label>
                          <textarea class="form-control" id="order_remarks" name="order_remarks" rows="3"></textarea>
                        </div>
                      </div>
             
                
                    <input type="hidden" class="form-control" id="request_code" name="request_code" value="<?php echo $labelta->wo_code; ?>" />
                    <input type="hidden" class="form-control" id="request_by" name="request_by" value="<?php echo $username; ?>" />
                 
             </form>
         
                <?php
                                
                            }
                ?>


                </div>
            
            </div>

      </div>
    </div>
  <?php
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
          
       
    	$('.current_page').click(function (e) {
    	    
    		let member_id = $(this).attr('id');
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/manufacturing/operations/request_proceed.php",
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
        				url: 'view/manufacturing/operations/insertrequest_proceed.php',
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

