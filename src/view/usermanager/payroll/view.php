<?php

require_once '../../core/init.php';

$transaction_year_month = $_POST['transaction_year_month'];


$user = new User();
if ($user->isLoggedIn()) {
    $username = escape($user->data()->id);
   
    $userSyscategory = escape($user->data()->syscategory_id);
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

            $users = Db::getInstance()->query("SELECT concat(c.firstname, ' ', c.lastname) as registered,
                                                SUM(a.basic_salary + a.housing_allowance + a.transport_allowance + a.medical_allowance + a.utility_allowance + a.entertainment) as total_payments
                                                FROM payroll_statements a
                                                LEFT JOIN users b ON a.added_by = b.id
                                                LEFT JOIN staff_record c ON b.username = c.user_id 
                                                WHERE a.transaction_year_month ='$transaction_year_month' ");
                  
            foreach ($users->results() as $use) {
                
                
            ?>
            
  
                <div class="row my-3 mb-4 justify-content-between">
                    <div class="col-sm-6">
                       <h3>Payroll for the month of <?php
                                              
                                                        $dateInput = $transaction_year_month;
        
                                                        // Convert the date to a DateTime object
                                                        $dateTime = new DateTime($dateInput);
                                                        
                                                        // Format the DateTime object as text
                                                        $textDate = $dateTime->format('F Y'); // F represents the full month name, Y represents the full year
                                                        
                                                        // Output the text date
                                                        echo $textDate; // Output: August 2023
                                                      
                                              ?></h3>     
                    </div>  
                    <div class="col-sm-2">
                      
                    </div> 
                </div>
              
                <div class="row justify-content-between mr-2">
                    <div class="col-sm-12 success_alert mr-0"></div>
                    <div class="col-sm-12 warning_alert mr-0"></div>
                </div>
                
                  
                           
                    <div class="row justify-content-between">
                     
                           <div class="col-sm-3">
                             <?php
                                    
                                    
                                    $dateInput = $transaction_year_month;
        
                                    // Convert the date to a DateTime object
                                    $dateTime = new DateTime($dateInput);
                                    
                                    // Format the DateTime object as text
                                    $textDate = $dateTime->format('F Y'); // F represents the full month name, Y represents the full year
                                                        
                                    
                                    
                                     $findtax = Db::getInstance()->query("SELECT * FROM approval WHERE order_description = '$textDate'");  
                                     
                                     if(!$findtax->count()){
                                  ?>
                               
                               
                              <button type="button" class="farm-button-cancel py-1 ml-0 request_proceed" id="<?php echo $transaction_year_month; ?>">
                                <span class="fa fa-save"> Request Approval </span>
                              </button> 
                              
                              <?php
                                      }else{
                                          
                                     foreach ($findtax->results() as $findtax) { 
                                        
                                        
                                            ?> 
                                               
                              <button type="button" class="farm-button-disabled py-1 ml-0" >
                                <?php if(empty($findtax->approval_status) &&  $findtax->approval_status === ''){
                                                echo '<i class="fa fa-spinner" aria-hidden="true"></i> Pending'; } else { echo $findtax->approval_status; } ?>
                              </button>
                              
                              <?php
                                         
                                     }
                                      }
                                         ?>
                            
                             </div>
                        
                            <div class="col-sm-6 px-0 mr-0">
                                
                            </div>
                            
                            
                            <div class="col-sm-3 text-right">
                    
                                  <button type="button" class="farm-button-cancel py-1 ml-0 prev_page" id="#">
                                    <span class="fa fa-chevron-left"></span>
                                  </button>  
                                  <button type="button" class="farm-button-icon-button py-1 ml-0 current_page" id="<?php echo $transaction_year_month; ?>">
                                    <span class="fa fa-refresh"></span>
                                  </button>
                                     
                            </div>
                           </div>  
                   
                  
                            
                 
                <div class="row justify-content-end mt-3">
                    <div class="col-sm-3">
                      <div class="card">
                        <div class="card-header p-2">
                          <div class="text-end pt-1">
                            <h6 class="mb-0 text-dark" style="font-size:0.85em">
                              <b>Total Amount</b> | NGN <?php
                                              
                                                            $total_payments = $use->total_payments;
                                                            $Ttotal_payments = number_format($total_payments);
                                                            echo $Ttotal_payments;
                                                           
                                                            ?>
                             </h6> 
                         
                          
                            </div>
                        </div>
                      </div>
                 </div>
                 
                    <div class="col-sm-3">
                     <div class="card">
                        <div class="card-header p-2">
                          <div class="text-end pt-1">
                            <h6 class="mb-0 text-dark" style="font-size:0.85em">
                              <b>Prepare by:</b> <?php echo $use->registered; ?>
                              </h6> 
                          </div>
                        </div>
                      </div>
                 </div>
                </div>
                <div class="row justify-content-between mt-3">
                    <div class="col-sm-12">
                      <?php

                    
                    $sqlQuery = Db::getInstance()->query("SELECT a.*, concat(b.firstname, ' ', b.lastname) as employee,
                    `basic_salary` + `housing_allowance` + `transport_allowance` + `medical_allowance` + `utility_allowance` + `entertainment` as total_payments
                                            FROM payroll_statements a
                                            Left Join staff_record b on a.employee_id = b.id
                                            WHERE a.transaction_year_month ='$transaction_year_month'");
                    
                                     if (!$sqlQuery->count()) {
                                         
                                            echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                                            
                                          } else {
                                            ?>
                                          
                       
                    <table id="deptview" class="table table-hover table-bordered" style="width:100%; font-size:0.8rem">
                                        <thead>
                                          <tr>
                                            <th>Employee</th>
                                            <th class="text-right pr-3">Basic Salary</th>
                                            <th class="text-right pr-3">Housing Allowance</th>
                                            <th class="text-right pr-3">Transport Allowance</th>
                                            <th class="text-right pr-3">Medical Allowance</th>
                                            <th class="text-right pr-3">Utility Allowance</th>
                                            <th class="text-right pr-3">Entertainment</th>
                                            <th class="text-right pr-3">Total Payment</th>
                                            <th>&nbsp;</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                    
                        
                    
                        <?php 
                    
                    	                    foreach ($sqlQuery->results() as $payroll_statement) { 
                    
                    	?>
                       
                                            <tr>
                                              <td><?php echo $payroll_statement->employee; ?></td>
                                              <td class="text-right pr-3"><?php
                                              
                                                            $basic_salary = $payroll_statement->basic_salary;
                                                            $Tbasic_salary = number_format($basic_salary);
                                                            echo $Tbasic_salary;
                                                           
                                                            ?></td>
                                              <td class="text-right pr-3"><?php
                                              
                                                            $housing_allowance = $payroll_statement->housing_allowance;
                                                            $Thousing_allowance = number_format($housing_allowance);
                                                            echo $Thousing_allowance;
                                                           
                                                           ?></td>
                                              <td class="text-right pr-3"><?php
                                              
                                                            $transport_allowance = $payroll_statement->transport_allowance;
                                                            $Ttransport_allowance = number_format($transport_allowance);
                                                            echo $Ttransport_allowance;
                                                           
                                                            ?></td>
                                              <td class="text-right pr-3"><?php
                                              
                                                            $medical_allowance = $payroll_statement->medical_allowance;
                                                            $Tmedical_allowance = number_format($medical_allowance);
                                                            echo $Tmedical_allowance;
                                                           
                                                            ?></td>
                                              <td class="text-right pr-3"><?php
                                              
                                                            $utility_allowance = $payroll_statement->utility_allowance;
                                                            $Tutility_allowance = number_format($utility_allowance);
                                                            echo $Tutility_allowance;
                                                           
                                                            ?></td>
                                              <td class="text-right pr-3"><?php
                                              
                                                            $entertainment = $payroll_statement->entertainment;
                                                            $Tentertainment = number_format($entertainment);
                                                            echo $Tentertainment;
                                                           
                                                            ?></td>
                                              <td class="text-right pr-3"><?php
                                              
                                                            $total_payments = $payroll_statement->total_payments;
                                                            $Ttotal_payments = number_format($total_payments);
                                                            echo $Ttotal_payments;
                                                           
                                                            ?></td>
                                              <td>
                                   
                                  <div class="dropdown">
                                <button class="btn btn-default dropleft" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                  <i style="font-size:14px" class="fa">&#xf142;</i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <?php
                                    
                                            $findt = Db::getInstance()->query("SELECT * FROM approval WHERE order_description = '$textDate'"); 
                                             if(!$findt->count()){
                                                 
                                                  if($userSyscategory == 1){
                                  ?>
                                    
                                  <div class="adjust_view" id="<?php echo $payroll_statement->id; ?>" lang="<?php echo $payroll_statement->employee_id; ?>">
                                        <button class="dropdown-item btn btn-default">
                                    <i class="fa fa-print" aria-hidden="true"></i>    &nbsp; Adjustment</button>

                                    </div>
                                    
                                    <div class="dropdown-divider"></div>
                                    <?php
                                                  }
                                    ?>
                                    
                                  <div class="payslip_view" id="<?php echo $payroll_statement->id; ?>" lang="<?php echo $payroll_statement->employee_id; ?>">
                                        <button class="dropdown-item btn btn-default">
                                            <i class="fa fa-print" aria-hidden="true"></i>    &nbsp; Print
                                                         </button>
                                  </div>
                                    <?php
                                             }else{
                                    ?>
                                    
                                  <div class="payslip_view" id="<?php echo $payroll_statement->id; ?>" lang="<?php echo $payroll_statement->employee_id; ?>">
                                        <button class="dropdown-item btn btn-default">
                                            <i class="fa fa-print" aria-hidden="true"></i>    &nbsp; Print
                                                         </button>
                                  </div>
                                  <?php
                                             }
                                  
                                  ?>
                                 </div>
                                </div> 
                            </td>
                                            </tr>
                       
                        <?php
                                 }
                                         
                        ?>
                        </tbody>
                    </table>
        <?php
                  }
                
                ?>
                            
                                </div>
                </div>
            
            
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
          
            $('.success_alert').hide();
            $('.warning_alert').hide();
          
          
        $('.request_proceed').on('click',function (e) {
    		
    		let transaction_year_month = $(this).attr('id');
    	
            //alert(member_id);
    		
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
    	
    
        $('.prev_page').click(function (e) {
		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/usermanager/payroll/index.php",
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
    	
            //alert(dataString);
    		
    		$("#loader_httpFeed").show();
    			$.ajax({
        			type: "POST",
        			data: {
        			    transaction_year_month:transaction_year_month
        			},
        			url: 'view/usermanager/payroll/view.php',  
        			cache: false,
        			success: function (msg) {
        				$("#contentbar_inner").html(msg);
        				$("#loader_httpFeed").hide();
        			}
        		});
    		e.preventDefault();
    	});
    	
        $('.singledelete').on('click', function(e){
                
                  if (confirm("Are you sure you want to remove this item?") == true) {
                      
                    	let tablename =   $(this).attr('title');
    		            let id = $(this).attr('id');
    		            let purchase_id = $(this).attr('lang');
    		             
    		            
                    $.ajax({
            
        				type: "POST",
        				url: 'view/manufacturing/operations/delete.php',
                		data: {
                		    tablename   : tablename,
                            id  : id,
                            purchase_id  : purchase_id
                		    
                		},
                        success:function(data){
                            $(".success_alert").html(data);
                            $(".success_alert").show();
                        }, 
                        error:function(data){
                            $(".warning_alert").html(data);
                            $(".warning_alert").show();
                        }
                    }); 
                
                    
                    
                  } else {
                    return false;
                    
                  }
                
                
                e.preventDefault();
            });
         
         
        
      $('.adjust_view').click(function (e) {
		
		let member_id = $(this).attr('lang');
		let payroll_id = $(this).attr('id');
		
        //alert(id);
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: "view/usermanager/payroll/adjust.php",
			data:{
			    member_id : member_id,
			    payroll_id : payroll_id
			},
			cache: false,
			success: function (msg) {
				$("#contentbar_inner").html(msg);
				$("#loader_httpFeed").hide();
			}
		});
		e.preventDefault();
	});   
	
	 $('.payslip_view').click(function (e) {
		
		let member_id = $(this).attr('lang');
		let payroll_id = $(this).attr('id');
		
        //alert(id);
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: "view/usermanager/payroll/payslip_view.php",
			data:{
			    member_id : member_id,
			    payroll_id : payroll_id
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

