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
                          concat(c.firstname,' ', c.lastname) as staffname, b.username, d.sign, d.name, d.id as currency_id
                          FROM approval a 
                          Left Join users b on  a.request_by = b.id 
                          Left Join staff_record c on b.username = c.user_id 
                          left Join currency d on a.currency_id = d.id
                          WHERE a.id = $member_id");
                  
            foreach ($approval->results() as $use) {
                
                             
            ?>
            <div class="row justify-content-between m-3">
                <div class="col-sm-8">
                       <h3>Remark: <?php echo $use->request_code; ?></h3>     
                  </div>
                    <div class="col-sm-4 text-right">
                    <button type="button" class="farm-button-cancel py-1 ml-0 prev_page" id="#">
                        <span class="fa fa-chevron-left"></span>
                      </button> 
                    <?php
        
        
                        $approval_records = Db::getInstance()->query("SELECT SUM(paid) as paid
                                                    FROM approval_records 
                                                    WHERE approval_id = $member_id");   
                            foreach ($approval_records->results() as $debit) {
                                
                                    
                                    if($use->approval_status === 'Approved' && $use->amount != $debit->paid){
                        
                        ?>
                        
                      <button type="button" class="farm-button py-1 ordermodal" data-target="#ordermodal" data-toggle="modal">
                        <span class="fa fa-save"> Remark</span>
                      </button>
                    
                      <?php
                                    }
                            }
                      ?>
                      
                      
                        <button type="button" class="farm-button py-1 btnRemark" data-target="#ordermodal" data-toggle="modal">
                            <span class="fa fa-save"> Remark</span>
                        </button>
                      <button type="button" class="farm-button-icon-button py-1 ml-0 current_page" id="<?php echo $member_id; ?>">
                        <span class="fa fa-refresh"></span>
                      </button>
                      <?php
                       
                                $approval_status = $use->approval_status;
                                if($approval_status != 'Approved'){
                ?>
                
                    <form id="approval_form" method="post">
                   <div class="col-sm-12 mx-0 px-0 my-2">
                       
                      <div class="form-group">
                          <select id="approval_status" name="approval_status" class="form-control approval_status">
                            <?php
                                if($approval_status != ''){
                                    ?>
                            <option value="<?php echo $approval_status; ?>" selected><?php echo $approval_status; ?></option>
                            <?php
                                }else{
                                    ?>
                            <option selected>-- Remark Status --</option>        
                                    <?php
                                }
                            ?>
                            <option value="Approved">Approved</option>
                            <option value="Pending">Pending</option>
                            <option value="Not Approved">Not Approved</option>
                          </select>
                        </div>
                        <input type="hidden" name="approval_date" id="approval_date" value="<?php echo date("Y-m-d H:i:s"); ?>" />
                        <input type="hidden" name="approved_by" id="approved_by" value="<?php echo $username; ?>"  />
                        <input type="hidden" name="approval_id" id="approval_id" value="<?php echo $member_id; ?>"  />
                    </div> 
                    </form>
                    
                <?php
                                }
                ?>
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
                                  <h4><?php echo $use->order_description; ?></h4>
                                  <h4 class="text-sm text-dark">
                                      <span class="badge badge-secondary"><?php echo $use->name; ?></span> <?php 
                                                      $number = $use->amount;
                                                      $Total_Amount = number_format($number);
                                      echo $use->sign . ' ' . $Total_Amount;  ?>  
                                      <?php
                                                if($use->currency_id != 1){
                                                    
                                                    $currency_id = $use->currency_id;
                                                    
                                                    $approval_currency = Db::getInstance()->query("SELECT b.rate, b.id 
                                                    FROM currency a
                                                    LEFT JOIN currency_rate b ON a.id = b.currency_id
                                                    WHERE a.id = $currency_id 
                                                    ORDER BY b.id DESC LIMIT 1");   
                                                    foreach ($approval_currency->results() as $approval_currency) {
                                                      $number_rate =   $approval_currency->rate * $use->amount;
                                                      $number = $number_rate;
                                                      $Total_Amount = number_format($number);
                                                        echo '|&nbsp;<span class="badge badge-secondary">NGN</span> &#x20A6; ' . $Total_Amount;
                                                    }
                                
                                                }
                                      ?>
                                      </h4>
                                  <hr class="dark horizontal">
                                  <h4 class="mb-0">Request Remarks</h4>
                                  <p class="text-sm text-danger"><?php echo $use->order_remarks; ?></p>
                                  <hr class="dark horizontal">
                                  <div class="d-flex ">
                                    <i class="material-icons text-sm my-auto me-1">Prepared by &nbsp;&nbsp;</i>
                                    <p class="mb-0 text-sm text-uppercase"> <?php echo $use->staffname; ?> </p>
                                  </div>
                                </div>
                              </div>
                            </div>
                           
                     
                      <div class="col-sm-8">
                          <div class="row justify-content-between my-5">
                           
                             <div class="table-responsive data-font px-3" style="height: 120%;">                                    
                                <?php
        
                          $user = Db::getInstance()->query("SELECT *  
                          FROM approval_records
                          WHERE approval_id = $member_id");
        
                          if (!$user->count()) {
                            echo "<div class='row justify-content-center'><h4 class='m-5'>No data to be displayed</h4></div>";
                          } else {
        
                        ?> 
        
                            <table id="selectuserabduganiu" class="table table-sm table-hover table-bordered" style="width:120%; font-size:0.8em;">
                              <thead>
                                <tr> 
                                  <th>SN</th>
                                  <th>Date</th>
                                  <th style="text-align:right">Total Amount</th>
                                  <th style="text-align:right">Paid</th>
                                  <th style="text-align:right">balance</th>
                                  
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                $i = 1;
                                foreach ($user->results() as $user) {
        
                                ?>
                                  <tr>
                                      
                                    <td rowspan="2"><?php echo $i++; ?></td>
                                    <td><?php echo $user->date_time; ?></td>
                                    <td style="text-align:right"><?php $number = $user->total_amount;
                                $Total_Amount = number_format($number);
                            echo $Total_Amount; 
                             ?></td>
                                    <td style="text-align:right"><?php $number = $user->paid;
                                $Total_Amount = number_format($number);
                                echo  $Total_Amount; ?></td>
                                    <td style="text-align:right"><?php 
                                    $total_amount = $user->total_amount;
                                    $paid = $user->paid;
                                    
                                     $number = $total_amount - $paid; 
                                $Total_Amount = number_format($number);
                            echo $Total_Amount; ?></td>
                                   
                                  </tr>
                                  <tr>
                                      
                                    <td colspan="4"><b>Approval Remarks:</b> <?php echo $user->remarks; ?></td>
                                   
                                  </tr>
         
                                <?php
                                }
                                ?>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td colspan='3' style="text-align:right" class="alert alert-primary p-2 m-0">
                                    <?php
                                     $labeltax = Db::getInstance()->query("SELECT SUM(paid) as paid
                                                                            FROM approval_records 
                                                                            WHERE approval_id = $member_id");     
                                    
                                        foreach ($labeltax->results() as $label) {
                                             if($label->paid != '' || $label->paid != null){
                                    ?>
                                            
                                    <div><b>Total Amount Approved</b> &nbsp;&nbsp;&nbsp;Debit&nbsp;<?php 
                                                        $number = $label->paid;;
                                                      $Total_Amount = number_format($number);
                                                      echo ' &#x20A6; ' . $Total_Amount;
                                     ?> </div>
                                    <?php
                                             }
                                         
                                        } 
                                        
                                
                                         
                                    ?>
                                            
                                    
                                    
                                    </td>
                                    
                                </tr>
                                
                                <?php
                                             }
                                         
                                    ?>
                              </tbody>
                            </table>
                          
                        
                      
                        </div>
                        
                          </div>
                    </div>
                </div>
                 <!-- Modal -->
<div class="modal fade" id="ordermodal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      
      <div class="farm-color modal-header p-2">
            <p class="modal-title" id="staticBackdropLabel">Request Order <?php 
            if($use->request_code != ''){
                echo $use->request_code;
            }
            ?> </p>
            <button type="button" class="bg-secondary px-2 border text-white current_page" data-dismiss="modal" aria-label="Close" id="<?php echo $member_id; ?>">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
                    <form id="approve_amount_form" method="post">
                            <div class="modal-body" id="rece_good_form">
                            
                                         <div class="row my-4">
                                            <div class="col-sm-12">
                                                 <div class="success_alert"></div>
                                                 <div class="warning_alert"></div>
                                             </div>
                                        </div>
                                         <div class="row">
                                         
                                          <div class="form-group col-sm-12">
                                          
                                            <label for="description">Total Amount for payment</label>
                                            <?php
                                                if($use->currency_id !== 1){
                                                    
                                                    $currency_id = $use->currency_id;
                                                    
                                                    $approval_currency = Db::getInstance()->query("SELECT b.rate, b.id FROM currency a
                                                    LEFT JOIN currency_rate b ON a.id = b.currency_id
                                                    WHERE a.id = $currency_id ORDER BY b.id DESC LIMIT 1");   
                                                    foreach ($approval_currency->results() as $approval_currency) {
                                                    
                                                   ?>     
                                                   <input type="text" class="form-control" id="total_amount_converted" name="total_amount" value="<?php $approval_currency->rate * $use->amount; ?>" readonly />  
                                                     <?php   
                                                    }
                                
                                                }else{
                                                   
                                                   ?>  
                                                   <input type="text" class="form-control" id="total_amount" name="total_amount" value="<?php echo $use->amount; ?>" readonly />
                                                   
                                                    <?php
                                                }
                                      ?>
                                            
                                            
                                          </div>
                                          
                                          <div class="form-group col-sm-12">
                                          
                                            <label for="debit">Amount</label>
                                            <input type="number" class="form-control" id="paid" name="paid"  />
                                          </div>
                                          <div class="form-group col-sm-12">
                                          
                                            <label for="remarks">Remarks</label>
                                            <textarea class="form-control" id="remarks" name="remarks" rows="3"></textarea>
                                          </div>
                                          <input type="hidden" class="form-control" id="date_time" name="date_time" value="<?php echo date("Y-m-d H:i:s"); ?>" />
                                          <input type="hidden" name="approval_id" id="approval_id" value="<?php echo $member_id; ?>"  />
                                </div>
                            
                         
                       </div>
                       
            <div class="modal-footer">
                <button type="button" class="farm-button py-1 ml-0 Save_approve current_page" data-dismiss="modal" id="<?php echo $member_id; ?>">
                    <span class="fa fa-save"> Approve</span>
                  </button>
                <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0 current_page" data-dismiss="modal" id="<?php echo $member_id; ?>">Close</button>
              </div>
                     </form>
          
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
               
                
                //alert(formData)
           
                    $.ajax({
        				
            			url: 'view/approvals/bill_requests/insert_approve.php',
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
            			url: 'view/approvals/bill_requests/update_approval.php',
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
        			url: 'view/approvals/bill_requests/getapproval.php',
        			dataType: 'JSON',
        			data: dataString,
        			cache: false,
        			success: function (response) {
        			     
                        // $(".description").empty();
                        // $("#bal").empty();
                    
                                   // let total_amount    = response.total_amount;
                                    let bal             = response.bal;
                              
                                    
                                     $('#total_amount').val(bal);
                                     $('#paid').maxlength(bal);
                   
                                    
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
    			url: "view/approvals/bill_requests/index.php",
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
    			url: "view/approvals/bill_requests/approval.php",
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
  
   