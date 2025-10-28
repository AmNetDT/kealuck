<?php

require_once '../../core/init.php';


//$transact_ = $_REQUEST['transact_'];
$member_id = $_POST['member_id'];
$payroll_id = $_POST['payroll_id'];

$user = new User();

   
if ($user->isLoggedIn()) {
    $username = escape($user->data()->id);
    $userSyscategory = escape($user->data()->syscategory_id);
    
    //echo $member_id;
?>


  
    
  
    
    <div id="body_general">
    <div id="accounttile">
      <div class="col-sm-12 col-sm-10">
        <span id="close" class="fa fa-close p-1 btn-danger text-lg"></span>
      </div>
    </div>

    <div class="col-md-6 offset-md-3">
        <div id="accounttile" class="container">
          
            

            <div class="jumbotron bg-white">
              
                <div class="col-md-12">
                <div class="row justify-content-between">
                    <div class="col-md-9">
                      <?php

                                      $staff_record = Db::getInstance()->query("SELECT * FROM staff_record where id = $member_id");
                    
                                      if (!$staff_record->count()) {
                                       ?>
                                       <h3><?php echo 'Staff Payslip Adjustment';  ?></h3>
                                       <?php
                                      } else {
                    
                                        foreach($staff_record->results() as $staff_record){
                                            
                                    ?> 
                                        <h3><?php echo $staff_record->firstname . ' ' . $staff_record->lastname . ' | Adjustment'  ;  ?></h3>
                                    <?php
                                        }
                                      }
                                        ?>   
                    </div>
                   <div class="col-md-3">
                       <?php
                                   $transact_year = Db::getInstance()->query("SELECT * FROM transaction_year order by year desc limit 1");
                                   foreach($transact_year->results() as $transact_)
                                   $transact_ = $transact_->year;
                          ?>
                      <button class="farm-button-cancel py-1 ml-0 edituser_view" id="<?php echo $member_id; ?>" lang="<?php echo $transact_; ?>">
                        <span class="fa fa-chevron-left"></span> 
                      </button>
                    </div> 
                </div>
         <?php

           

            $users = Db::getInstance()->query("SELECT a.*, b.level,
                                                a.basic_salary + a.housing_allowance + a.transport_allowance + a.medical_allowance + a.utility_allowance + a.entertainment as total_payments
                                                FROM payroll_statements a 
                                                LEFT JOIN job_level b ON a.job_level_id = b.id
                                                WHERE a.employee_id = $member_id AND a.id = $payroll_id");
            foreach ($users->results() as $use) {

            ?>
             <form method="POST" autocomplete="off" class="formAdujst">
                 <div class="row">
                     <div class="col-sm-12 success_alert"></div>
                 </div>
                 <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                            <label for="username">Gross Salary</label>
                         <div class="input-group mb-2">
                         <div class="input-group-prepend">
                          <div class="input-group-text">Per Month</div>
                        </div>
                         <input type="text" name="total_payments" value="<?php echo $use->total_payments; ?>" id="total_payments" name="total_payments" class="form-control" disabled />
                         </div>
                     </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                            <label for="username">Work Level</label>
                         <div class="input-group mb-2">
                         <input type="text" name="total_payments" value="<?php echo $use->level; ?>" id="total_payments" name="total_payments" class="form-control" disabled />
                         </div>
                     </div>
                     </div>
                 </div>
                 <div class="row">
             <div class="form-group col-md-6">
                <label for="basic_salary">Basic Salary</label>
                <input type='text' value='<?php echo $use->basic_salary; ?>' placeholder='0.00' id='basic_salary' name="basic_salary" class='form-control' />
              </div>
              <div class="col-md-6">
                <label for="housing_allowance">Housing Allowance</label>
                <input type='text' value='<?php echo $use->housing_allowance; ?>' placeholder='0.00' id='housing_allowance' name="housing_allowance" class='form-control' />
                </div>
              </div>
                 <div class="row">
                   <div class="form-group col-md-6">
                        <label for="transport_allowance">Transport Allowance</label>
                <input type='text' value='<?php echo $use->transport_allowance; ?>' placeholder='0.00' id='transport_allowance' name="transport_allowance" class='form-control' />
                        
                      </div>
                     <div class="col-md-6">
                        <div class="form-group">
                         <label for="medical_allowance">Medical Allowance</label>
                <input type='text' value='<?php echo $use->medical_allowance; ?>' placeholder='0.00' id='medical_allowance' name="medical_allowance" class='form-control' />
                         
                     </div>
                    </div> 
                     
                     
                 </div>
                  <div class="row">
                   <div class="form-group col-md-6">
                        <label for="utility_allowance">Utility Allowance</label>
                <input type='text' value='<?php echo $use->utility_allowance; ?>' placeholder='0.00' id='utility_allowance' name="utility_allowance" class='form-control' />
                        
                      </div>
                     <div class="col-md-6">
                        <div class="form-group">
                         <label for="entertainment">Entertainment</label>
                <input type='text' value='<?php echo $use->entertainment; ?>' placeholder='0.00' id='entertainment' name="entertainment" class='form-control' />
                         
                     </div>
                    </div> 
                     
                     
                 </div>
                  <div class="row">
                   <div class="form-group col-md-12">
                        <label for="remarks">Remarks</label>
                            <textarea class="form-control" id="remarks" name="remarks" rows="3"><?php echo $use->remarks; ?></textarea>
                      </div>
                     
                     
                 </div>
                  
                 <input type="hidden" name="id" id="id" value="<?php echo $use->id; ?>" />
                 <div class="row">
                 <div class="col-md-12" id="submitButton">
                     <button type="button" id="SaveStaff" class="btn btn-light mb-3 SaveStaff">
                         <span class="fa fa-edit"> Adjust</span>
                     </button>
                 </div>
                </div>
             </form>
         <?php }
            ?>
   


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
		let transact_ = $(this).attr('lang');
		
        //alert(id);
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "GET",
			url: "view/usermanager/staff/payroll_individual/index.php",
			data:{
			    member_id : member_id,
			    transact_: transact_
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
       
                let form = $('.formAdujst')[0]; // You need to use standard javascript object here
                let formData = new FormData(form);  
                
                //alert(formData)
           
                    $.ajax({
        				url: 'view/usermanager/staff/payroll_individual/update.php',
        				data: formData,
                        type: 'POST',
                        contentType: false,  // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                        processData: false, // NEEDED, DON'T OMIT THIS
                        success:function(data){
                            $(".success_alert").html(data);
                            $(".success_alert").show();
				            $("#loader_httpFeed").hide();
                        },
                        error:function(data){
                            $(".warning_alert").html(data);
                            $(".warning_alert").show();
				            $("#loader_httpFeed").hide();
                        }
                    }); 
                
            });
            
	    
	    
	    
	event.preventDefault();
    })
    
</script>
 