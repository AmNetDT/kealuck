<?php

require_once '../../core/init.php';

$member_id = $_POST['member_id'];
//echo $member_id;

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
                <div id="accounttile2" class="col-sm-12">
                    
         <?php


            $approval = Db::getInstance()->query("SELECT a.*, 
                  concat(d.firstname, ' ', d.lastname) as registered, c.sign
                  FROM utilities a 
                  Left join users b on a.prepared = b.id 
                  Left Join staff_record d on b.username = d.user_id 
                  left join currency c on a.currency_id = c.id
                  WHERE a.id =  $member_id");
                  
            foreach ($approval->results() as $use) {
                
                             
            ?>
            
               
            <div class="row justify-content-between m-3">
                <div class="col-sm-8">
                       <h3>Voucher: <?php echo $use->voucher_code; ?></h3>     
                  </div>
                    <div class="col-sm-4 text-right">
                    <button type="button" class="farm-button-cancel py-1 ml-0 prev_page" id="#">
                        <span class="fa fa-chevron-left"></span>
                      </button> 
                      <?php
                      
                      $purchase_code = $use->voucher_code;
                      
                             $findtax = Db::getInstance()->query("SELECT * FROM approval WHERE request_code = '$purchase_code'");     
                             if($findtax->count()){
                          ?>
                      <button type="button" class="farm-button-disabled py-1 ml-0">
                        <span class="fa fa-save"> Requested</span>
                      </button> 
                      <?php
                                 }else{
                                    ?> 
                      <button type="button" class="farm-button py-1 ml-0 request_approval" id="<?php echo $member_id; ?>">
                        <span class="fa fa-save"> Request Approval</span>
                      </button>    
                      <?php
                                 
                             }
                                 ?>      
                      <button type="button" class="farm-button-icon-button py-1 ml-0 current_page" id="<?php echo $member_id; ?>">
                        <span class="fa fa-refresh"></span>
                      </button>
                    </div>
                </div>
           
                <div class="row justify-content-between m-3">
                    <div class="col-sm-12 success_alert mr-0"></div>
                </div>
                
              
                <div class="row m-3 justify-content-between">
                     
                         
                            <div class="col-sm-4">
                              <div class="card z-index-2 ">
                                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                                  <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                                    <div class="chart">
                                      <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
                                    </div>
                                  </div>
                                </div>
                                <div class="card-body">
                                  <h4 class="mb-0 "><?php echo $use->description; ?></h4>
                                  <h3 class="text-sm text-danger"><span class="badge badge-secondary"><?php echo $use->description; ?></span> <?php 
                                $number = $use->amount;
                                $Total_Amount = number_format($number);
                                
                                
                                echo $use->sign . ' ' . $Total_Amount; 
                            
                            ?> </h3>
                                  <hr class="dark horizontal">
                                  <div class="d-flex ">
                                    <i class="material-icons text-sm my-auto me-1">Prepared by &nbsp;&nbsp;</i>
                                    <p class="mb-0 text-sm text-uppercase"> <?php echo $use->registered; ?> </p>
                                  </div>
                                </div>
                              </div>
                            </div>
                           
                     
                      <div class="col-sm-8">
                          <div class="row justify-content-between my-5">
                           
                             
                        
                          </div>
                    </div>
                </div>

                <?php
             }
            ?>
                
                
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
       
    $(document).ready(function(event){
        
     
        $('.resulter').hide();
        $('.resulterError').hide();
        $('.btnRemark').hide();
        
             $('.Save_approve').on('click', function(e){
       
                let form = $('#approve_amount_form')[0]; // You need to use standard javascript object here
                let formData = new FormData(form); 
               
                
                //alert(dataString.total_amount)
           
                    $.ajax({
        				
            			url: 'view/approvals/purchaseorder/insert_approve.php',
        				data: formData,
            			type: 'POST',
                        contentType: false,  // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                        processData: false, // NEEDED, DON'T OMIT THIS
                        success:function(data){
                            $(".success_alert").html(data);
                            $(".success_alert").show();
                            //alert(data.msg);
                        }, 
                        error:function(data){
                            $(".warning_alert").html(data);
                            $(".warning_alert").show();
                        }
                        
                        
                    });
                    
                    
                    
                e.preventDefault();
            }); 
         
         
        $(".approval_status").change(function(e){  
	   
                let approval_status = $('#approval_status').val();
                let approval_date   = $('#approval_date').val();
                let approved_by     = $('#approved_by').val();
                let approval_id     = $('#approval_id').val();
                
                const dataString = {
                    
                    approval_status :    approval_status,
                    approval_date   :    approval_date,
                    approved_by     :    approved_by,
                    approval_id     :    approval_id
                    
                };
               // alert(dataString.approval_status)
           
                    $.ajax({
        				
    			        type: "POST",
            			url: 'view/approvals/purchaseorder/update_approval.php',
            			dataType: 'JSON',
            			data: dataString,
            			cache: false,
                        success:function(data){
                           
                          //  alert(data.approval_status)
                            if(data.approval_status == 'Approved'){
                                 $("#approval_form").remove();
                                 $('.btnRemark').show();
                                 
                             }
                             
                            $(".success_alert").html(data.msg);
                            $(".success_alert").show();
                        }, 
                        error:function(data){
                            $(".warning_alert").html(data);
                            $(".warning_alert").show();
                        }
                    }); 
    
                e.preventDefault(); 
         	})  
         
        $(".ordermodal").on('click',function(e){  
	    
	    let approval_id = $('#approval_id').val();
	    
    	const dataString = {
    	    approval_id :   approval_id
        };
        
        //alert(dataString.approval_id)
		
		$.ajax({
    			type: "POST",
    			url: 'view/approvals/purchaseorder/getapproval_order.php',
    			dataType: 'JSON',
    			data: dataString,
    			cache: false,
    			success: function (response) {
    			    
    			    //alert(response.total_debit)    
                 
                    $("#debit").empty();
                    $("#credit").empty();
                              
                    let debit  = response.total_debit;
                    let credit = response.total_credit;
              
                    
                    $('#debit').val(debit); 
                    $('#debit').attr("max", debit);
                    
                     
    				 	   
    		 }
    	});
        		
	  

            e.preventDefault(); 
     	}) 
        
     
    	$('.prev_page').click(function (e) {
		
    		let ed = $(this).attr('lang');
    		let id = $(this).attr('id');
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/purchases/utility/",
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
          
       
    	$('.current_page').click(function (e) {
    		
    		let member_id = $(this).attr('id');
    	
            //alert(dataString);
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/purchases/utility/voucher.php",
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

    
        
    	$('.request_approval').click(function (e) {
    		
    		let member_id = $(this).attr('id');
    	
            //alert(dataString);
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/purchases/utility/request_approval.php",
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

    	
       event.preventDefault();
   });
   
   </script>
   
   