<?php

require_once '../../core/init.php';

$user = new User();
if ($user->isLoggedIn()) {




   $transact_ = date('Y');
    
   if(!empty($_REQUEST['transaction_year'])) {
        
     
        $transaction_year_month  = $_REQUEST['transaction_year'];


               


                  $user = Db::getInstance()->query("SELECT a.id as approval_records_id, a.paid as approved_amount, a.date_time as date_time_approved, c.reconcile,
                                                    b.request_code, b.approval_status, b.amount, concat(e.firstname,' ', e.lastname) as staffname, a.transaction_year
                                                    FROM approval_records a 
                                                    LEFT JOIN approval b ON a.approval_id = b.id
                                                    LEFT JOIN journal c ON a.id = c.approval_order_id
                                                    Left join users d on b.approved_by = d.id 
                                                    Left Join staff_record e on d.username = e.user_id
                                                    WHERE a.transaction_year = '$transaction_year_month'");

                    if (!$user->count()) {
                        echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                      } else {
                        
                        
                    ?> 
                <div class="table-responsive data-font" style="height: 100%;">
      
    
                    <table id="selectuserabduganiu" class="table table-sm table-hover table-bordered" style="width:100%; font-size:0.8em;">
                      <thead>
                        <tr> 
                          <th>SN</th>
                          <th>Item Code</th>
                          <th>Approved By</th>                          
                          <th>Status</th>
                          <th>Approved Date</th> 
                          <th>Total Amount</th> 
                          <th>Approved For Payment</th>
                          <th>Reconcile</th>
                          <th>&nbsp;</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $i = 1;
                        foreach ($user->results() as $user) {

                        ?>

                          <tr>
                            <td><?php echo $i++ ; ?></td>
                            <td><?php echo $user->request_code; ?></td>
                            <td><?php echo $user->staffname; ?></td>
                            <td><?php echo $user->approval_status; ?></td>
                            <td><?php echo $user->date_time_approved; ?></td>
                            <td class="text-right"><?php 
                                $number = $user->amount;
                                $Total_Amount = number_format($number);
                            echo $Total_Amount; ?></td>
                            <td class="text-right"><?php 
                                $numb = $user->approved_amount;
                                $Total_Amt = number_format($numb);
                            echo $Total_Amt; ?></td>
                            <?php
                            
                                    if(!empty($user->reconcile)){
                            ?>
                            <td class="text-left pl-3 alert-success"><?php echo $user->reconcile; ?></td>
                            <?php
                            
                                    }else{
                                        
                                    ?>
                            <td class="text-left pl-3 alert-warning"></td>
                            <?php
                                    }
                                    ?>
                            <td>
                                
                                

                                <!-- Default dropup button -->
                                    <div class="btn-group dropup">
                                      <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <i style="font-size:14px" class="fa">&#xf142;</i>
                                      </button>
                                      <div class="dropdown-menu">
                                        <!-- Dropdown menu links -->
                                        <div class="item_view" id="<?php echo $user->approval_records_id; ?>">
                                    <!-- Dropdown menu links -->
                                            <button class="dropdown-item">
                                             <i class="fa fa-search"></i>&nbsp; Item Details</button>
                                            </div>
                                      </div>
                                    </div>
                               
                             
                            </td>
                          </tr>

 
                        <?php
                        }
                        ?>

                      </tbody>
                    </table>
                  
              </div>
            
  <?php
                      }
                      
   }else{
       
               


                  $user = Db::getInstance()->query("SELECT a.id as approval_records_id, a.paid as approved_amount, a.date_time as date_time_approved, c.reconcile,
                                                    b.request_code, b.approval_status, b.amount, concat(e.firstname,' ', e.lastname) as staffname, a.transaction_year
                                                    FROM approval_records a 
                                                    LEFT JOIN approval b ON a.approval_id = b.id
                                                    LEFT JOIN journal c ON a.id = c.approval_order_id
                                                    Left join users d on b.approved_by = d.id 
                                                    Left Join staff_record e on d.username = e.user_id
                                                    WHERE a.transaction_year = '$transact_'");

                    if (!$user->count()) {
                        echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                      } else {
                        
                        
                    ?> 
                <div class="table-responsive data-font" style="height: 100%;">
      
    
                    <table id="selectuserabduganiu" class="table table-sm table-hover table-bordered" style="width:100%; font-size:0.8em;">
                      <thead>
                        <tr> 
                          <th>SN</th>
                          <th>Item Code</th>
                          <th>Approved By</th>                          
                          <th>Status</th>
                          <th>Approved Date</th> 
                          <th class="text-right">Total Amount</th> 
                          <th class="text-right">Approved For Payment</th>
                          <th class="text-left">Reconcile</th>
                          <th>&nbsp;</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $i = 1;
                        foreach ($user->results() as $user) {

                        ?>

                          <tr>
                            <td><?php echo $i++ ; ?></td>
                            <td><?php echo $user->request_code; ?></td>
                            <td><?php echo $user->staffname; ?></td>
                            <td><?php echo $user->approval_status; ?></td>
                            <td><?php echo $user->date_time_approved; ?></td>
                            <td class="text-right"><?php 
                                $number = $user->amount;
                                $Total_Amount = number_format($number);
                            echo $Total_Amount; ?></td>
                            <td class="text-right"><?php 
                                $numb = $user->approved_amount;
                                $Total_Amt = number_format($numb);
                            echo $Total_Amt; ?></td>
                            <?php
                            
                                    if(!empty($user->reconcile)){
                            ?>
                            <td class="text-left pl-3 alert-success"><?php echo $user->reconcile; ?></td>
                            <?php
                            
                                    }else{
                                        
                                    ?>
                            <td class="text-left pl-3 alert-warning"></td>
                            <?php
                                    }
                                    ?>
                            <td>
                                
                                 

                                <!-- Default dropup button -->
                                    <div class="btn-group dropup">
                                      <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <i style="font-size:14px" class="fa">&#xf142;</i>
                                      </button>
                                      <div class="dropdown-menu">
                                        <!-- Dropdown menu links -->
                                        <div class="item_view" id="<?php echo $user->approval_records_id; ?>">
                                    <!-- Dropdown menu links -->
                                            <button class="dropdown-item">
                                             <i class="fa fa-search"></i>&nbsp; Item Details</button>
                                            </div>
                                      </div>
                                    </div>
                               
                             
                            </td>
                          </tr>

 
                        <?php
                        }
                        ?>

                      </tbody>
                    </table>
                  
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
     $(document).ready(function(){
          
         $('.resulter').hide();
         $('.resulter1').hide();
         
 
        $('.edituser_view').click(function (e) {
		
		var ed = $(this).attr('lang');
		var member_id = $(this).attr('id');
	
		//Pssing values to nextPage 
		var rsData = "eQvmTfgfru";
		var dataString = "rsData=" + rsData;
        //alert(dataString);
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: ed + "/edituser.php",
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

        $('.item_view').click(function (e) {
		
		let member_id = $(this).attr('id');
	
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			cache: false, type: 'post', async: true,
			url: "view/accounting/acc_reconciliation/payment.php",
			data:{
			    'member_id':member_id
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