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

           

            $users = Db::getInstance()->query("SELECT a.*, b.level, b.id as level_id,
                                                FROM payroll a 
                                                LEFT JOIN job_level b ON a.job_level_id = b.id
                                                WHERE a.employee_id = $member_id AND a.id = $payroll_id");
            foreach ($users->results() as $use) {

            ?>
              <form id="staff_to_payroll_form" method="post">
            
                    <div class="modal-body pt-0">
                      <div class="row">
                        <div class="col-sm-6">
                             <div class="row my-3">
                          
                                <div class="form-group col-sm-12">
                                    <label class="mr-2">Level</label>
                                    <select id="job_level_id" name="job_level_id" class="form-control farm-button-cancel">
                                                <option value="<?php echo $use->level_id; ?>"><?php echo $use->level; ?></option>
                                       <?php
                
                                          $job_level = Db::getInstance()->query("SELECT * FROM job_level order by level desc");
                        
                                          if (!$job_level->count()) {
                                           ?>
                                           <div class='row'><h3 class='m-5' style="text-align:center">No item to be displayed</h3></div>
                                           <?php
                                          } else {
                        
                                            foreach($job_level->results() as $job_level){
                                                
                                        ?> 
                                                <option value="<?php echo $job_level->id; ?>"><?php echo $job_level->level; ?></option>
                                        <?php
                                            
                                            }
                                          }  
                                        ?>
                                  </select>
                                  
                    <input type="hidden" name="employee_id" id="employee_id" value="<?php echo $use->employee_id; ?>" />
                                 </div>
                             </div>
                             <div class="row my-3">
                                 <div class="form-group col-sm-12">
                                  <input type="text" class="form-control is-valid" id="basic_salary" name="basic_salary" placeholder="0.00" required readonly>
                                  <div class="valid-feedback text-dark">
                                    Basic Salary
                                  </div>
                                </div>
                             </div>
                             <div class="row my-3">
                                 <div class="form-group col-sm-12">
                                  <input type="text" class="form-control is-valid" id="housing_allowance" name="housing_allowance" placeholder="0.00" required readonly>
                                  <div class="valid-feedback text-dark">
                                    Housing Allowance
                                  </div>
                                </div>
                             </div>
                             <div class="row my-3">
                                 <div class="form-group col-sm-12">
                                  <input type="text" class="form-control is-valid" id="transport_allowance" name="transport_allowance" placeholder="0.00" required readonly>
                                  <div class="valid-feedback text-dark">
                                    Transport Allowance
                                  </div>
                                </div>
                             </div>
                         </div>
                        <div class="col-sm-6 pt-5">
                             
                         <div class="row mt-4 pt-5">
                             <div class="form-group col-sm-12">
                              <input type="text" class="form-control is-valid" id="medical_allowance" name="medical_allowance" placeholder="0.00" required readonly>
                              <div class="valid-feedback text-dark">
                                Medical Allowance
                              </div>
                            </div>
                         </div>
                         <div class="row my-3">
                             <div class="form-group col-sm-12">
                              <input type="text" class="form-control is-valid" id="utility_allowance" name="utility_allowance" placeholder="0.00" required readonly>
                              <div class="valid-feedback text-dark">
                                Utility Allowance
                              </div>
                            </div>
                         </div>
                         <div class="row my-3">
                             <div class="form-group col-sm-12">
                              <input type="text" class="form-control is-valid" id="entertainment" name="entertainment" placeholder="0.00" required readonly>
                              <div class="valid-feedback text-dark">
                                Entertainment
                              </div>
                            </div>
                         </div>
                    </div>
                    </div>
                  </div>
                    
                  <div class="modal-footer">
                    <input type="hidden" name="id" id="id" value="<?php echo $use->id; ?>" />
                    <button type="button" class="py-1 px-2 border farm-color mx-0 savestaff_to_payroll">Update</button>
                    <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0 edituser_view" id="<?php echo $member_id; ?>" data-dismiss="modal" aria-label="Close">Close</button>
                  
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
	
	     
        $("#job_level_id").change(function(){  
	    let id = $(this).find(":selected").val();
		let dataString = 'job_level_id='+ id;  
		
		//alert(dataString);
	
		$.ajax({
			url: 'view/usermanager/staff/payroll_individual/getlevel_payslip.php',
            dataType: 'json',
			data: dataString,  
			cache: false,
			success:function(response){
                
                let len = response.length;

                $("#metric_units").empty();
                
                    for( let i = 0; i<len; i++){
                   
                   
                    let job_level_id            = response[i]['job_level_id']
                    let basic_salary        = response[i]['basic_salary']
                    let housing_allowance   = response[i]['housing_allowance']
                    let transport_allowance = response[i]['transport_allowance']
                    let medical_allowance   = response[i]['medical_allowance']
                    let utility_allowance   = response[i]['utility_allowance']
                    let entertainment       = response[i]['entertainment']
                  
                  //alert(description)
                  
                   $('#basic_salary').val(basic_salary);
                   $('#housing_allowance').val(housing_allowance);
                   $('#transport_allowance').val(transport_allowance);
                   $('#medical_allowance').val(medical_allowance);
                   $('#utility_allowance').val(utility_allowance);
                   $('#entertainment').val(entertainment);
                  }
    				 	
    			} 
    		});
     	}); 
     	 
	    
       $('.savestaff_to_payroll').on('click', function(e){
        
                    let form = $('#staff_to_payroll_form')[0]; // You need to use standard javascript object here 
                    let formData = new FormData(form); 
                   
                   //alert(formData);
                   
        		
        		$.ajax({
        				url: 'view/usermanager/staff/payroll_individual/update_job_level.php',
        				data: formData,
                        type: 'POST',
                        contentType: false,  // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                        processData: false, // NEEDED, DON'T OMIT THIS
                        success:function(data){
                            $(".success_alert").html(data);
                            $(".success_alert").show();
                            $('#sload').html(''); 
                        }, 
                        error:function(data){
                            $(".warning_alert").html(data);
                            $(".warning_alert").show();
                        }
                    }); 
                        
               e.preventDefault();
        });
            
	    
	    
	    
	event.preventDefault();
    })
    
</script>
 