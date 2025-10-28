<?php

require_once '../../core/init.php';

//$transaction_year_month = $_POST['member_id'];

$transaction_year_month = $_POST['transaction_year_month'];

$user = new User();
if ($user->isLoggedIn()) {
$username = escape($user->data()->id);

$users = Db::getInstance()->query("SELECT id,
                                    SUM(`basic_salary`) as basic_salary, 
                                    SUM(`housing_allowance`) as housing_allowance, 
                                    SUM(`transport_allowance`) as transport_allowance, 
                                    SUM(`medical_allowance`) as medical_allowance, 
                                    SUM(`utility_allowance`) as utility_allowance, 
                                    SUM(`entertainment`) as entertainment, 
                                    SUM(`basic_salary` + `housing_allowance` + `transport_allowance` + `medical_allowance` + `utility_allowance` + `entertainment`) as total_payments,
                                    `transaction_year_month` 
                                    FROM payroll_statements 
                                    WHERE transaction_year_month = '$transaction_year_month'
                                    GROUP BY transaction_year_month");
                                    
                 foreach ($users->results() as $use){
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
             
            <div class="row my-3 mb-4 justify-content-between">
                <div class="col-sm-6">
                       <h3>Save Proceed: <?php echo $use->total_payments; ?></h3>     
                   </div>  
                   <div class="col-sm-2">
                         
                    </div> 
                </div>
               
            
             <form id="requestForm" method="post" enctype="multipart/form-data">
                 
                 
                             <div class="row justify-content-end mb-3"> 
                                
                                <div class="col-3 mx-0 px-0">
                                      <button class="farm-button-cancel py-1 ml-0 prev_page" id="<?php echo $transaction_year_month ?>">
                                        <span class="fa fa-chevron-left"></span>
                                      </button> 
                                      <button type="button" class="farm-button py-1 ml-0 SaveStaff">
                                        <span class="fa fa-save"> Proceed</span>
                                      </button>
                                      <button class="farm-button-icon-button py-1 ml-0 current_page" id="<?php echo $transaction_year_month ?>">
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
                              <input type="text" class="form-control" id="amount" name="amount" value="<?php echo $use->total_payments; ?>.00" readonly />
                            </div>
                        </div><div class="form-group col-sm-3">
                          <label for="request_date">Request Date &amp; Time</label>
                          <input type="text" class="form-control" id="request_date" name="request_date" value="<?php echo date("Y-m-d H:i:s"); ?>" readonly />
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-sm-6">
                          <label for="order_description">Order Description</label>
                          <input type="text" class="form-control" id="order_description" name="order_description" value="<?php 
                          
                                                        $dateInput = $transaction_year_month;
        
                                                        // Convert the date to a DateTime object
                                                        $dateTime = new DateTime($dateInput);
                                                        
                                                        // Format the DateTime object as text
                                                        $textDate = $dateTime->format('F Y'); // F represents the full month name, Y represents the full year
                                                        
                                                        // Output the text date
                                                        $input_string = $transaction_year_month; // Output: August 2023 
                                                       $substring = substr($input_string, 7); // Extracts "$input_string" (5 characters from the beginning)
                                                       
                                                        echo $textDate . ' ' . $substring;
                                                        ?>" readonly />
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-sm-6">
                          <label for="order_remarks">Remarks</label>
                          <textarea class="form-control" id="order_remarks" name="order_remarks" rows="3"></textarea>
                        </div>
                      </div>
             
                    
                    <input type="hidden" class="form-control" id="request_code" name="request_code" value="<?php $randomid = mt_rand(2222,9999); echo 'PR' . $randomid;  ?>" />
                    <input type="hidden" class="form-control" id="type_of_bill" name="type_of_bill" value="Purchase Order" />
                    <input type="hidden" class="form-control" id="request_by" name="request_by" value="<?php echo $username; ?>" />
                          
                 
             </form>
        


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
		
    		let transaction_year_month = $(this).attr('id');
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/usermanager/payroll/view.php",
    			data: {
    				'transaction_year_month': transaction_year_month
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
    	    
    		let transaction_year_month = $(this).attr('id');
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/usermanager/payroll/request_proceed.php",
    			data: {
    				'transaction_year_month': transaction_year_month
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
        				url: 'view/usermanager/payroll/insertrequest_proceed.php',
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

