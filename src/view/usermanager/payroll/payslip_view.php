<?php

require_once '../../core/init.php';

//echo $member_id;
$member_id = $_POST['member_id'];
$payroll_id = $_POST['payroll_id'];



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
                <div id="accounttile" class="col-sm-12">
                   
                    <div class="row my-3">
                      <div class="col-sm-12">
                        <div class="col-sm-12 mb-5">
                    
                    <script>
                        function printDiv() 
                            {
                            
                              var divToPrint=document.getElementById('DivIdToPrint');
                            
                              var newWin=window.open('','Print-Window');
                            
                              newWin.document.open();
                            
                              newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
                            
                              newWin.document.close();
                            
                              setTimeout(function(){newWin.close();},10);
                            
                            }
                    </script>
                    <div class="row mt-4 justify-content-center" id="DivIdToPrint">
                        <div class="col-sm-10">
                            <div id='DivIdToPrint'></div>
                            <button type='button' id='btn' onclick='printDiv();' class="farm-button-blend py-1 mr-1"><i class="fa fa-print" aria-hidden="true"></i> Print</button>
                   
                            <div class="row border-bottom justify-content-center">
                                <div class="container my-4">
                                    <div class="card mb-3" style="width:100%;">
                                        <div class="row my-3">
                                            <div class="col-sm-9">
                                          <?php
                    
                                                          $staff_record = Db::getInstance()->query("SELECT * FROM staff_record where id = $member_id");
                                        
                                                          if (!$staff_record->count()) {
                                                           ?>
                                                           <h3><?php echo 'Staff Payslip Adjustment';  ?></h3>
                                                           <?php
                                                          } else {
                                        
                                                            foreach($staff_record->results() as $staff_record){
                                                                
                                                        ?> 
                                                            <h3><?php echo $staff_record->firstname . ' ' . $staff_record->lastname . ' | Payslip'  ;  ?></h3>
                                                        <?php
                                                            }
                                                          }
                                                            ?>   
                                        </div>
                                            <div class="col-sm-3">
                                           <?php
                                                       $transactn_yy_mm = Db::getInstance()->query("SELECT * FROM payroll_statements 
                                                                    WHERE id = $payroll_id");
                                                        foreach ($transactn_yy_mm->results() as $transactn_yy_mm) 
                                                        $transaction_year_month = $transactn_yy_mm->transaction_year_month;
                                              ?>
                                          <button class="farm-button-cancel py-1 ml-0 edituser_view" id="<?php echo $member_id; ?>" lang="<?php echo $transaction_year_month; ?>">
                                            <span class="fa fa-chevron-left"></span> 
                                          </button>
                                        </div> 
                                        </div>
                                        <div class="row my-3">
                                            <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
                                            
                                    <?php
                    
                                        
                                        $payroll_statement = Db::getInstance()->query("SELECT a.*, b.level,
                                                                                        a.basic_salary + a.housing_allowance + a.transport_allowance + a.medical_allowance + a.utility_allowance + a.entertainment as total_payments,
                                                                                        b.basic_salary + b.housing_allowance + b.transport_allowance + b.medical_allowance + b.utility_allowance + b.entertainment as job_level_gross
                                                                                        FROM payroll_statements a 
                                                                                        LEFT JOIN job_level b ON a.job_level_id = b.id
                                                                                        WHERE a.id = $payroll_id
                                                                                        ORDER BY a.transaction_year_month");
                                        
                                                         if (!$payroll_statement->count()) {
                                                             
                                                                echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                                                                
                                                              } else {
                                                           
                                        
                                        	                    foreach ($payroll_statement->results() as $payroll_statement) { 
                                        
                                                                
                                                    $job_level_gross = $payroll_statement->job_level_gross;
                                                    $total_payments = $payroll_statement->total_payments; 
                                                    
                                                    //Pension
                                                    $pension = $job_level_gross * 8 / 100;
                                                    
                                                    $paye = 0;
                                                    
                                                    $job_level_gross = $payroll_statement->job_level_gross;
                                                    
                                                    $penalty =   $job_level_gross - $total_payments;
                                                    
                                        	?>
                                                           <h2>PERIOD: <?php
                                                                  
                                                                            $dateInput = $payroll_statement->transaction_year_month;
                            
                                                                            // Convert the date to a DateTime object
                                                                            $dateTime = new DateTime($dateInput);
                                                                            
                                                                            // Format the DateTime object as text
                                                                            $textDate = $dateTime->format('F Y'); // F represents the full month name, Y represents the full year
                                                                            
                                                                            // Output the text date
                                                                            echo $textDate; // Output: August 2023
                                                                          
                                                                  ?>
                                                            </h2>
                                                            
                                                        <table id="deptview" class="table table-hover table-bordered mt-4 text-right" style="width:100%; font-size:0.8rem">
                                                          <tbody>
                                                            
                                                            <tr align='right'>
                                                                <td><b>Basic Salary</b></td>
                                                                  <td><?php
                                                                  $number_basic_salary = $payroll_statement->basic_salary;
                                                                  $formatted_number = number_format($number_basic_salary);
                                                                  echo $formatted_number . '.00';
                                                                  
                                                                  ?></td>
                                                            
                                                            </tr>
                                                            <tr align='right'>
                                                                <td><b>Housing Allowance</b></td>
                                                                  <td><?php 
                                                                  $number_housing_allowance = $payroll_statement->housing_allowance;
                                                                  $formatted_number = number_format($number_housing_allowance);
                                                                  echo $formatted_number . '.00';
                                                                  
                                                                  ?></td>
                                                            
                                                            </tr>
                                                            <tr align='right'>
                                                                <td><b>Transport Allowance</b></td>
                                                                  <td><?php 
                                                                  $number_transport_allowance = $payroll_statement->transport_allowance;
                                                                  $formatted_number = number_format($number_transport_allowance);
                                                                  echo $formatted_number . '.00';
                                                                  
                                                                   ?></td>
                                                            
                                                            </tr>
                                                            <tr align='right'>
                                                                <td><b>Medical Allowance</b></td>
                                                                  <td><?php 
                                                                  $number_medical_allowance = $payroll_statement->medical_allowance;
                                                                  $formatted_number = number_format($number_medical_allowance);
                                                                  echo $formatted_number . '.00';
                                                                  
                                                                   ?></td>
                                                            
                                                            </tr>
                                                            <tr align='right'>
                                                                <td><b>Utility Allowance</b></td>
                                                                  <td><?php 
                                                                  $number_utility_allowance = $payroll_statement->utility_allowance;
                                                                  $formatted_number = number_format($number_medical_allowance);
                                                                  echo $formatted_number . '.00';
                                                                  
                                                                   ?></td>
                                                            
                                                            </tr>
                                                            <tr align='right'>
                                                                <td><b>Entertainment</b></td>
                                                                  <td><?php 
                                                                  $number_entertainment = $payroll_statement->entertainment;
                                                                  $formatted_number = number_format($number_medical_allowance);
                                                                  echo $formatted_number . '.00';
                                                                  
                                                                   ?></td>
                                                            
                                                            </tr>
                                                          </tbody>
                                                        </table>
                                                       
                                                </div>
                                            <div class="col-xl-6 col-sm-6 mb-xl-0 pt-5 mb-4">
                                                <p class="text-sm">Deductions</p>
                                                <table id="deptview" class="table table-hover table-bordered text-right" style="width:100%; font-size:0.8rem">
                                                            <tbody>
                                                               
                                                            <tr align='right'>
                                                                <td><b>Paye</b></td>
                                                                  <td><?php 
                                                                  
                                                                  $formatted_number = number_format($paye);
                                                                  echo $formatted_number . '.00';
                                                                  
                                                                      
                                                                         ?></td>
                                                            </tr>
                                                            <tr align='right'>
                                                                <td><b>Pension</b></td>
                                                                  <td><?php 
                                                                 
                                                                  $formatted_number = number_format($pension);
                                                                  echo  '-' . $formatted_number . '.00';
                                                                  
                                                                      
                                                                         ?></td>
                                                            </tr>
                                                            <tr align='right'>
                                                                <?php 
                                                                    if($job_level_gross > $total_payments){
                                                                        ?>
                                                                                      <td><b class="text-danger">Other deduction</b></td>
                                                                                      <td class="text-danger"><?php 
                                                                                            echo '-' . $penalty;
                                                                                             ?></td>
                                                                        <?php
                                                                        
                                                                    } else if($job_level_gross < $total_payments){
                                                                        
                                                                        ?>
                                                                                      <td><b class="text-success">Bonus</b></td>
                                                                                      <td class="text-success"><?php 
                                                                                            echo '+' . $total_payments - $job_level_gross;
                                                                                             ?></td>
                                                                        <?php
                                                                    }
                                                                ?>
                                                                
                                                            </tr>
                                                            <tr align='right'>
                                                                <td><b>Total Deductions:</b></td>
                                                                  <td>NGN <?php
                                                                    
                                                                  $deduction = $pension + $paye + ($penalty);
                                                                  $formatted_number = number_format($deduction);
                                                                  echo $formatted_number . '.00';
                                                                  
                                                                    
                                                    
                                                             ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan='2' class="text-left">
                                                                     <?php echo $payroll_statement->remarks; ?>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                        
                                            </div>
                                            <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
                                               
                                                <h3>Gross Salary: <?php
			
                $formatted_number_job_level_gross = number_format($job_level_gross);
                
				$f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
				echo ucwords($f->format($job_level_gross)." Naira Only");
				
				?> ( NGN <?php echo $formatted_number_job_level_gross . '.00'; ?>) </h3>
                                                               
                                                                        
                                                                        <h3>Net Salary: <?php
                $net_pay = $job_level_gross - $deduction;                                                        
				$formatted_number_net_pay = number_format($net_pay);  
				$f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
				echo ucwords($f->format($net_pay)." Naira Only");
				
				?> ( NGN <?php echo $formatted_number_net_pay . '.00'; ?>) </h3>
                                                
                                                               
                                                                
                                            </div>
                                            
                                        </div>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                        <?php
                        
                                 }
                         
                                          }
             ?>
              
                            
                    
                
               </div>
                      </div>
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
        
        $('.edituser_view').click(function (e) {
		
		
		let member_id = $(this).attr('id');
		let transaction_year_month = $(this).attr('lang');
		
        //alert(transaction_year_month);
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: "view/usermanager/payroll/view.php",
			data:{
			  
			    transaction_year_month: transaction_year_month
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
    })
    
</script>

