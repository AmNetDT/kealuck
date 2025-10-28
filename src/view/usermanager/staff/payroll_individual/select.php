<?php

require_once '../../core/init.php';

$id = 0;

$user = new User();
if ($user->isLoggedIn()) {
$userSyscategory = escape($user->data()->syscategory_id);
$username_id = escape($user->data()->id);
    
   if(!empty($_REQUEST['member_id']) && !empty($_REQUEST['id'])) {
        
        $id         = $_REQUEST['id'];
        $member_id  = $_REQUEST['member_id'];
       
?>

       <div class="container-fluid">
               <?php

                    
                    $payroll_statement = Db::getInstance()->query("SELECT a.*, b.level,
                                                                    a.basic_salary + a.housing_allowance + a.transport_allowance + a.medical_allowance + a.utility_allowance + a.entertainment as total_payments
                                                                    FROM payroll_statements a 
                                                                    LEFT JOIN job_level b ON a.job_level_id = b.id
                                                                    WHERE a.employee_id = $member_id AND a.transaction_year_month LIKE '%$id%'
                                                                    ORDER BY a.transaction_year_month");
                    
                                     if (!$payroll_statement->count()) {
                                         
                                            echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                                            
                                          } else {
                                            ?>
                                            
                       
                    <table id="deptview" class="table table-hover table-bordered" style="width:100%; font-size:0.8rem">
                                        <thead>
                                          <tr>
                                            <th>Period</th>
                                            <th>Job Level</th>
                                            <th>Basic Salary</th>
                                            <th>Housing Allowance</th>
                                            <th>Transport Allowance</th>
                                            <th>Medical Allowance</th>
                                            <th>Utility Allowance</th>
                                            <th>Entertainment</th>
                                            <th>Gross Salary</th>
                                            <th>&nbsp;</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                    
                        
                    
                        <?php 
                    
                    	                    foreach ($payroll_statement->results() as $payroll_statement) { 
                    
                    	?>
                        
                                           <tr>
                                              <td><?php
                                              
                                                        $dateInput = $payroll_statement->transaction_year_month;
        
                                                        // Convert the date to a DateTime object
                                                        $dateTime = new DateTime($dateInput);
                                                        
                                                        // Format the DateTime object as text
                                                        $textDate = $dateTime->format('F Y'); // F represents the full month name, Y represents the full year
                                                        
                                                        // Output the text date
                                                        echo $textDate; // Output: August 2023
                                                      
                                              ?></td>
                                              <td><?php echo $payroll_statement->level; ?></td>
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
                                              <td>
                                   
                                  <div class="dropdown">
                                <button class="btn btn-default dropleft" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                  <i style="font-size:14px" class="fa">&#xf142;</i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <?php
                                            
                                                                
                                            
                                            $findt = Db::getInstance()->query("SELECT * FROM approval WHERE order_description = '$textDate'"); 
                                             if(!$findt->count()){
                                                 
                                                 
                                  if($userSyscategory === 1){
                                  ?>
                                    <div class="adjust_view" id="<?php echo $payroll_statement->id; ?>" lang="<?php echo $payroll_statement->employee_id; ?>">
                                        <button class="dropdown-item btn btn-default">
                                        <i class="fa fa-edit" aria-hidden="true"></i>    &nbsp; Adjustment</button>

                                    </div>
                                    <?php
                                    
                                            }
                                    
                                    ?>
                                    
                                    <div class="dropdown-divider"></div>
                                    
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


  <?php
          
    }else{
        
         
        $member_id = $_POST['member_id'];
        $transact_ = $_POST['transact_'];

?>


        
       <div class="container-fluid">
                <?php

                  $payroll_statement = Db::getInstance()->query("SELECT a.*, b.level,
                                                                a.basic_salary + a.housing_allowance + a.transport_allowance + a.medical_allowance + a.utility_allowance + a.entertainment as total_payments
                                                                FROM payroll_statements a 
                                                                LEFT JOIN job_level b ON a.job_level_id = b.id
                                                                WHERE a.employee_id = $member_id AND a.transaction_year_month LIKE '%$transact_%'
                                                                ORDER BY a.transaction_year_month");
                    
                                     if (!$payroll_statement->count()) {
                                         
                                            echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                                            
                                          } else {
                                            ?>
                                            
                       
                    <table id="deptview" class="table table-hover table-bordered" style="width:100%; font-size:0.8rem">
                                        <thead>
                                          <tr>
                                            <th>Period</th>
                                            <th>Job Level</th>
                                            <th>Basic Salary</th>
                                            <th>Housing Allowance</th>
                                            <th>Transport Allowance</th>
                                            <th>Medical Allowance</th>
                                            <th>Utility Allowance</th>
                                            <th>Entertainment</th>
                                            <th>Gross Salary</th>
                                            <th>&nbsp;</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                    
                        
                    
                        <?php 
                    
                    	                    foreach ($payroll_statement->results() as $payroll_statement) { 
                    
                    	?>
                        
                                            <tr>
                                              <td><?php
                                              
                                                        $dateInput = $payroll_statement->transaction_year_month;
        
                                                        // Convert the date to a DateTime object
                                                        $dateTime = new DateTime($dateInput);
                                                        
                                                        // Format the DateTime object as text
                                                        $textDate = $dateTime->format('F Y'); // F represents the full month name, Y represents the full year
                                                        
                                                        // Output the text date
                                                        echo $textDate; // Output: August 2023
                                                      
                                              ?></td>
                                              <td><?php echo $payroll_statement->level; ?></td>
                                              <td><?php echo $payroll_statement->basic_salary; ?></td>
                                              <td><?php echo $payroll_statement->housing_allowance; ?></td>
                                              <td><?php echo $payroll_statement->transport_allowance; ?></td>
                                              <td><?php echo $payroll_statement->medical_allowance; ?></td>
                                              <td><?php echo $payroll_statement->utility_allowance; ?></td>
                                              <td><?php echo $payroll_statement->entertainment; ?></td>
                                              <td><?php echo $payroll_statement->total_payments; ?></td>
                                               <td>
                                 <div class="dropdown">
                                <button class="btn btn-default dropleft" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                  <i style="font-size:14px" class="fa">&#xf142;</i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                     <?php
                                            
                                                                
                                            
                                            $findt = Db::getInstance()->query("SELECT * FROM approval WHERE order_description = '$textDate'"); 
                                             if(!$findt->count()){
                                                 
                                                  if($userSyscategory === 1){
                                  ?>
                                    <div class="adjust_view" id="<?php echo $payroll_statement->id; ?>" lang="<?php echo $payroll_statement->employee_id; ?>">
                                        <button class="dropdown-item btn btn-default">
                                        <i class="fa fa-edit" aria-hidden="true"></i>    &nbsp; Adjustment</button>

                                    </div>
                                    <?php
                                    
                                                  }
                                    
                                    ?>
                                    
                                    
                                    <div class="dropdown-divider"></div>
                                    
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
	    
	   
      $('.adjust_view').click(function (e) {
		
		let member_id = $(this).attr('lang');
		let payroll_id = $(this).attr('id');
		
        //alert(id);
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: "view/usermanager/staff/payroll_individual/adjust.php",
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
	
      $('.update_view').click(function (e) {
		
		let member_id = $(this).attr('lang');
		let payroll_id = $(this).attr('id');
		
        //alert(id);
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: "view/usermanager/staff/payroll_individual/update_level.php",
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
			url: "view/usermanager/staff/payroll_individual/payslip_view.php",
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
 