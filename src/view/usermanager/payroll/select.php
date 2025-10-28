<?php

require_once '../../core/init.php';


$user = new User();
if ($user->isLoggedIn()) {
$userSyscategory = escape($user->data()->syscategory_id);
$username_id = escape($user->data()->id);



   $transact_year = Db::getInstance()->query("SELECT * FROM transaction_year order by year desc limit 1");
   foreach($transact_year->results() as $transact_)
   $transact_ = $transact_->year;
    
   if(!empty($_REQUEST['transaction_year_month'])) {
        
     $transaction_year_month = $_REQUEST['transaction_year_month'];
       
       
?>

        
  
    
       <div class="container-fluid">
               <?php
 
                    
                    $sqlQuery = Db::getInstance()->query("SELECT id,
                                                            SUM(`basic_salary`) as basic_salary, 
                                                            SUM(`housing_allowance`) as housing_allowance, 
                                                            SUM(`transport_allowance`) as transport_allowance, 
                                                            SUM(`medical_allowance`) as medical_allowance, 
                                                            SUM(`utility_allowance`) as utility_allowance, 
                                                            SUM(`entertainment`) as entertainment, 
                                                             SUM(`basic_salary` + `housing_allowance` + `transport_allowance` + `medical_allowance` + `utility_allowance` + `entertainment`) as total_payments,
                                                            `transaction_year_month` 
                                                            FROM payroll_statements 
                                                            WHERE transaction_year_month LIKE '%$transaction_year_month%'
                                                            GROUP BY transaction_year_month");
                    
                                     if (!$sqlQuery->count()) {
                                         
                                            echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                                            
                                          } else {
                                            ?>
                                            
                       
                    <table id="deptview" class="table table-hover table-bordered" style="width:100%; font-size:0.8rem">
                                        <thead>
                                          <tr>
                                            <th>Period</th>
                                            <th>Basic Salary</th>
                                            <th>Housing Allowance</th>
                                            <th>Transport Allowance</th>
                                            <th>Medical Allowance</th>
                                            <th>Utility Allowance</th>
                                            <th>Entertainment</th>
                                            <th>Total Payment</th>
                                            <th>Status</th>
                                            <th>&nbsp;</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                    
                        
                    
                        <?php 
                    
                    	                    foreach ($sqlQuery->results() as $payroll_statement) { 
                                             $dateInput = $payroll_statement->transaction_year_month;
                                            
                    	?>
                          
                                            <tr>
                                              <td><?php
                                              
                                                       
        
                                                        // Convert the date to a DateTime object
                                                        $dateTime = new DateTime($dateInput);
                                                        
                                                        // Format the DateTime object as text
                                                        $textDate = $dateTime->format('F Y'); // F represents the full month name, Y represents the full year
                                                        
                                                        // Output the text date
                                                        echo $textDate; // Output: August 2023
                                                      
                                              ?></td>
                                              <td><?php 
                                              
                                                            $basic_salary = $payroll_statement->basic_salary;
                                                            $Tbasic_salary = number_format($basic_salary);
                                                            echo $Tbasic_salary;
                                                            
                                                            ?></td>
                                              <td><?php
                                              
                                                            $housing_allowance = $payroll_statement->housing_allowance;
                                                            $Thousing_allowance = number_format($housing_allowance);
                                                            echo $Thousing_allowance;
                                                            
                                                            ?></td>
                                              <td><?php
                                              
                                                            $transport_allowance = $payroll_statement->transport_allowance;
                                                            $Ttransport_allowance = number_format($transport_allowance);
                                                            echo $Ttransport_allowance;
                                                            
                                                            ?></td>
                                              <td><?php
                                              
                                                            $medical_allowance = $payroll_statement->medical_allowance;
                                                            $Tmedical_allowance = number_format($medical_allowance);
                                                            echo $Tmedical_allowance;
                                                           
                                                            ?></td>
                                              <td><?php
                                              
                                                            $utility_allowance = $payroll_statement->utility_allowance;
                                                            $Tutility_allowance = number_format($utility_allowance);
                                                            echo $Tutility_allowance;
                                                           
                                                            ?></td>
                                              <td><?php
                                              
                                                            $entertainment = $payroll_statement->entertainment;
                                                            $Tentertainment = number_format($entertainment);
                                                            echo $Tentertainment;
                                                           
                                                            ?></td>
                                              <td><?php
                                              
                                                            $total_payments = $payroll_statement->total_payments;
                                                            $Ttotal_payments = number_format($total_payments);
                                                            echo $Ttotal_payments;
                                                           
                                                            ?></td>
                                              
                             <?php
                                   
                                  
        
                                    // Convert the date to a DateTime object
                                    $dateTime = new DateTime($dateInput);
                                    
                                    // Format the DateTime object as text
                                    $textDate = $dateTime->format('F Y'); // F represents the full month name, Y represents the full year
                                                        
                                    
                                    
                                     $findtax = Db::getInstance()->query("SELECT * FROM approval WHERE order_description = '$textDate'");  
                                     
                                     if(!$findtax->count()){
                                  
                                        echo '<td class="alert-danger">Pending</td>';
                                  
                                  
                                     }else{
                                         
                                          foreach ($findtax->results() as $findtax) { 
                                              $finding = $findtax->approval_status;
                                              
                                              if($finding === 'Approved'){
                                     
                                        echo '<td class="alert-success">Approved</td>';
                                      
                                              }else if($finding === 'Not Approved'){
                                     
                                      
                                        echo '<td class="alert-dark">Not Approved</td>';
                                      
                                      
                                              }else if($finding === 'Pending'){
                                     
                                      
                                        echo '<td class="alert-danger">Pending</td>';
                                      
                                      
                                              }else{
                                     
                                      
                                        echo '<td class="alert-danger">Pending</td>';
                                      
                                      
                                              }
                                              
                                          }
                                              
                                     }
                                     ?>
                                              <td>
                                       
                                  <div class="dropdown">
                                      
                                    <button class="btn btn-default dropleft" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                      <i style="font-size:14px" class="fa">&#xf142;</i>
                                    </button>
                                    <div class="dropdown-menu">
                                      
                                        <div class="edituser_view" id="<?php echo $payroll_statement->id; ?>" lang='<?php echo $payroll_statement->transaction_year_month; ?>'>
                                            <button class="dropdown-item">
                                                 <i class="fa fa-info-circle "></i>&nbsp; Details</button>
                    
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

             <?php
                                          }
             
             ?>
            </div>


  <?php
          
    }else{
        
         

?>


        
       <div class="container-fluid">
                <?php

                    
                    $sqlQuery = Db::getInstance()->query("SELECT id,
                                                            SUM(`basic_salary`) as basic_salary, 
                                                            SUM(`housing_allowance`) as housing_allowance, 
                                                            SUM(`transport_allowance`) as transport_allowance, 
                                                            SUM(`medical_allowance`) as medical_allowance, 
                                                            SUM(`utility_allowance`) as utility_allowance, 
                                                            SUM(`entertainment`) as entertainment,
                                                            SUM(`basic_salary` + `housing_allowance` + `transport_allowance` + `medical_allowance` + `utility_allowance` + `entertainment`) as total_payments,
                                                            `transaction_year_month` 
                                                            FROM payroll_statements
                                                            where transaction_year_month LIKE '%$transact_%'
                                                            GROUP BY transaction_year_month");
                    
                                     if (!$sqlQuery->count()) {
                                         
                                            echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                                            
                                          } else {
                                            ?>
                                          
                       
                    <table id="deptview" class="table table-hover table-bordered" style="width:100%; font-size:0.8rem">
                                        <thead>
                                          <tr>
                                            <th>Period</th>
                                            <th>Basic Salary</th>
                                            <th>Housing Allowance</th>
                                            <th>Transport Allowance</th>
                                            <th>Medical Allowance</th>
                                            <th>Utility Allowance</th>
                                            <th>Entertainment</th>
                                            <th>Total Payment</th>
                                            <th>Status</th>
                                            <th>&nbsp;</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                    
                        
                    
                        <?php 
                    
                    	                    foreach ($sqlQuery->results() as $payroll_statement) { 
                                            $dateInput = $payroll_statement->transaction_year_month;
                    	?>
                       
                                            <tr>
                                              <td><?php
                                              
                                                        
        
                                                        // Convert the date to a DateTime object
                                                        $dateTime = new DateTime($dateInput);
                                                        
                                                        // Format the DateTime object as text
                                                        $textDate = $dateTime->format('F Y'); // F represents the full month name, Y represents the full year
                                                        
                                                        // Output the text date
                                                        echo $textDate; // Output: August 2023
                                                      
                                              ?></td>
                                              <td><?php echo $payroll_statement->basic_salary; ?></td>
                                              <td><?php echo $payroll_statement->housing_allowance; ?></td>
                                              <td><?php echo $payroll_statement->transport_allowance; ?></td>
                                              <td><?php echo $payroll_statement->medical_allowance; ?></td>
                                              <td><?php echo $payroll_statement->utility_allowance; ?></td>
                                              <td><?php echo $payroll_statement->entertainment; ?></td>
                                              <td><?php echo $payroll_statement->total_payments; ?></td>
                                              <?php
                                    
                                    
                                  
        
                                    // Convert the date to a DateTime object
                                    $dateTime = new DateTime($dateInput);
                                    
                                    // Format the DateTime object as text
                                    $textDate = $dateTime->format('F Y'); // F represents the full month name, Y represents the full year
                                                        
                                    
                                    
                                     $findtax = Db::getInstance()->query("SELECT * FROM approval WHERE order_description = '$textDate'");  
                                     
                                     if(!$findtax->count()){
                                  
                                        echo '<td class="alert-danger">Pending</td>';
                                  
                                  
                                     }else{
                                         
                                          foreach ($findtax->results() as $findtax) { 
                                              $finding = $findtax->approval_status;
                                              
                                              if($finding === 'Approved'){
                                     
                                        echo '<td class="alert-success">Approved</td>';
                                      
                                              }else if($finding === 'Not Approved'){
                                     
                                      
                                        echo '<td class="alert-dark">Not Approved</td>';
                                      
                                      
                                              }else if($finding === 'Pending'){
                                     
                                      
                                        echo '<td class="alert-danger">Pending</td>';
                                      
                                      
                                              }else{
                                     
                                      
                                        echo '<td class="alert-danger">Pending</td>';
                                      
                                      
                                              }
                                              
                                          }
                                              
                                     }
                                     ?>
                                              <td>
                                       
                                  <div class="dropdown">
                                      
                                    <button class="btn btn-default dropleft" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                      <i style="font-size:14px" class="fa">&#xf142;</i>
                                    </button>
                                    <div class="dropdown-menu">
                                      
                                        <div class="edituser_view" lang='<?php echo $payroll_statement->transaction_year_month; ?>'>
                                            <button class="dropdown-item">
                                                 <i class="fa fa-info-circle "></i>&nbsp; Details</button>
                    
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
        <?php
                  }
                
                ?>
                            
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
 
   
	
      $('.singledelete').on('click', function(e){
            
	        let del = $(this).attr('lang');
	        let title = $(this).attr('title');
	        //alert(del)
	        let confirmation = confirm("Are you sure you want to remove the item?");
	       
	       
	       if (confirmation) { 
	       
        
         
	        $.ajax({
	           	url: 'view/assets_mgt/maintenance/delete.php',
			    type: 'POST',
	            data:{
	                  del     :   del,
	                  title   :   title
	            },
	            cache: false,
	            success:function(data){
	                $(".success_alert").html(data);
                    $(".success_alert").show();
	            }
	        });
	        
	       }
	        e.preventDefault();
	    });
	  $('.edituser_view').click(function (e) {
		
	    let transaction_year_month = $(this).attr('lang');
		
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

    event.preventDefault();
	});
        
 </script>
 