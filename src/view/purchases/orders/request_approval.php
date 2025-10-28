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
      <div class="jumbotron pt-5 bg-white">
              <?php
                             $labeltax = Db::getInstance()->query("SELECT SUM(a.unit_cost * a.qty) as cost, c.discount, d.cost as landing_cost, b.purchase_code,
                                                                    e.sign, a.currency_id
                                                                    FROM purchase_order a 
                                                                    left join purchases b on a.purchase_id = b.id
                                                                    Left join purchase_discount c on b.purchase_code = c.item_code
                                                                    Left join landing_cost d on b.purchase_code = d.item_code
                                                                    Left join currency e on a.currency_id = e.id
                                                                    WHERE a.purchase_id = $member_id");     
                             if($labeltax->count()){
                                 foreach ($labeltax->results() as $labelta) {
                                     
                                     $discount = $labelta->discount;
                                     $landing_cost = $labelta->landing_cost;
                                     $cost = $labelta->cost;
                                   
                                     
                                     if($discount != ''){
                          ?>
                                    <span>(include <?php echo $labelta->discount; ?>% discount) </span>
                            <?php
                                     }
                                 
                                
                                     $amount = $discount / 100 * $cost / 1;
                                    $total_discount = $cost - $amount;
                                    $total_cost = $total_discount + $landing_cost;
                                
                                
                              ?>
            <div class="row my-3 mb-4 justify-content-between">
                <div class="col-sm-7">
                       <h3>Request Approval: <?php echo $labelta->purchase_code; ?></h3>     
                  </div>  
                   <div class="col-sm-5">
                                
                                      <button class="farm-button-cancel py-1 ml-0 prev_page" id="<?php echo $member_id ?>">
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
               
            
             <form id="requestForm" method="post" enctype="multipart/form-data">
                 
                 <div class="row">
                    <div class="col-sm-12">
                     <div class="success_alert"></div>
                     <div class="warning_alert"></div>
                     </div>
                  </div>
                 
                    <div class="col-sm-5">
                        <div class="row">
                        <div class="form-group col-sm-12">
                          <label for="amount">Request Amount</label>
                           <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><?php echo $labelta->sign; ?></span>
                          </div>
                          <input type="hidden" value="<?php echo $labelta->currency_id; ?>" name="currency_id" id="currency_id" />
                          <input type="text" class="form-control" id="amount" name="amount" value="<?php echo $total_cost; ?>" readonly />
                        </div>
                        </div><div class="form-group col-sm-12">
                          <label for="request_date">Request Date &amp; Time</label>
                          <input type="text" class="form-control" id="request_date" name="request_date" value="<?php echo date("Y-m-d H:i:s"); ?>" readonly />
                        </div>
                      </div>
                        <div class="row">
                        <div class="form-group col-sm-12">
                          <label for="order_description">Order Description</label>
                          <textarea class="form-control" id="order_description" name="order_description" rows="3"></textarea>
                        </div>
                      </div>
                        <div class="row">
                        <div class="form-group col-sm-12">
                          <label for="order_remarks">Remarks</label>
                          <textarea class="form-control" id="order_remarks" name="order_remarks" rows="3"></textarea>
                        </div>
                      </div>
                            <input type="hidden" class="form-control" id="type_of_bill" name="type_of_bill" value="Purchase Order" />
                            <input type="hidden" class="form-control" id="request_code" name="request_code" value="<?php echo $labelta->purchase_code; ?>" />
                            <input type="hidden" class="form-control" id="request_by" name="request_by" value="<?php echo $username; ?>" />
                    </div>
                    <div class="col-sm-7">
                  
                          
                 
             </form>
         
   
            
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
         
        
            $("#state_id").change(function(){  
    	    let id = $(this).find(":selected").val();
    		let dataString = 'state_id='+ id;  
    		
    		//alert(dataString);
    	
    		$.ajax({
    			url: 'view/purchases/suppliers/getlga.php',
                dataType: 'json',
    			data: dataString,  
    			cache: false,
    			success:function(response){
                    
                    let len = response.length;
    
                    $("#lga_id").empty();
                    
                        for(let i = 0; i<len; i++){
                        let id = response[i]['id'];
                        let name = response[i]['name'];
                    
                        $("#lga_id").append("<option value='"+id+"'>"+name+"</option>");
                    }
    				 	
    			} 
    		});
     	}) 
     
    	$('.prev_page').click(function (e) {
		
    		let member_id = $(this).attr('id');
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/purchases/orders/editorder.php",
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
    			url: "view/purchases/orders/request_approval.php",
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
       
    	$('.edituser_view').click(function (e) {
		
    		let ed = $(this).attr('lang');
    	
    		//Pssing values to nextPage 
    		let rsData = "eQvmTfgfru";
    		let dataString = "rsData=" + rsData;
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
    	
       event.preventDefault();
   });
   
   </script>

