<?php

require_once '../../core/init.php';


$member_id = $_REQUEST['member_id'];

$user = new User();
 $userSyscategory = escape($user->data()->syscategory_id);


   $transact_ = date('Y');
  // echo $transact_;
   
if ($user->isLoggedIn()) {
    $username = escape($user->data()->id);
    $userSyscategory = escape($user->data()->syscategory_id);
    
    //echo $member_id;
?>


  <form>
      <input type="hidden" value="<?php echo $transact_; ?>" id="trans">
      <input type="hidden" value="<?php echo $member_id; ?>" id="member_id">
  </form>
    
   <div id="body_general">
    <div class="container-fluid p-0 bg-success">
        <div id="accounttile">
          <div class="col-sm-12 col-sm-6">
            <span id="close" class="fa fa-close p-1 btn-danger text-lg"></span>
          </div>
          </div>
        </div>
      <div class="jumbotron jumbotron-fluid pt-5 bg-white">
        <div id="accounttile" class="container">
            <div class="row m-3 mb-4">
                 <?php

                                      $staff_record = Db::getInstance()->query("SELECT * FROM staff_record where id = $member_id");
                    
                                      if (!$staff_record->count()) {
                                       ?>
                                       <h3><?php echo 'Staff Payslip';  ?></h3>
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
              
                <div class="row justify-content-end">
                    <div class="col-sm-9">
                        <form>
                              <label class="mr-2">Sort by transaction year</label>
                              <select id="inputTransaction_year" name="inputTransaction_year" class="farm-button-cancel py-1 pl-4 mt-2">
                                   <?php

                                      $transaction_year = Db::getInstance()->query("SELECT * FROM transaction_year order by year desc");
                    
                                      if (!$transaction_year->count()) {
                                       ?>
                                       <div class='row'><h3 class='m-5' style="text-align:center">No item to be displayed</h3></div>
                                       <?php
                                      } else {
                    
                                        foreach($transaction_year->results() as $year){
                                            
                                    ?> 
                                <option value="<?php echo $year->year; ?>"><?php echo $year->year; ?></option>
                                    <?php
                                        
                                        }
                                      }  
                                    ?>
                              </select>
                              <input type="hidden" value="<?php echo $transact_; ?>" id="trans">
                              <input type="hidden" value="<?php echo $member_id; ?>" id="member_id">
                          </form>
                    </div>
                    <div class="col-sm-3">
                      <button class="farm-button-cancel py-1 ml-0 prev_page" id="<?php echo $member_id; ?>">
                        <span class="fa fa-chevron-left"></span>
                      </button>
                      <?php

                                      $staff_record = Db::getInstance()->query("SELECT * FROM payroll where employee_id = $member_id");
                    
                                      if (!$staff_record->count()) {
                                       ?>
                    <button class="farm-button py-1 ml-0" id="add_button" data-toggle="modal" data-target="#addModal">
                        <span class="fa fa-plus"> Create Salary</span>
                      </button>
                                       <?php
                                      }else{
                                          
                                             if ($userSyscategory == 1) {

                    
                                          ?>
                                            <button class="farm-button py-1 ml-0"  data-toggle="modal" data-target="#updateModal">
                                             <span class=" fa fa-edit"> Update Level</span>
                                            </button>                  
                                                         <?php     
                                                     } 
                                            }
                                        ?>
                      
                      <button class="farm-button-icon-button py-1 ml-0 edituser_view" id="<?php echo $member_id; ?>" lang="<?php echo $transact_; ?>">
                        <span class=" fa fa-refresh"></span>
                      </button>
                    </div>
                    
                </div>
         
              <div class="col-sm-12 m-0 p-0">
                          <div class="row">
                            <div class="col-sm-12 transactions_click_view">
                              <div class="col-sm-12 success_alert edituser_view"  id="<?php echo $member_id; ?>"></div>
                              <div class="col-sm-12 warning_alert edituser_view"  id="<?php echo $member_id; ?>"></div>
                                <div id="userr"></div>
                                <div id="load"></div>
                           
                            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <div id="addModal" class="modal fade" data-backdrop="static">
    <div class="modal-dialog modal-md">
      
        <div class="modal-content">
          <div class="farm-color modal-header p-2">
            <p class="modal-title" id="staticBackdropLabel">Add Staff Level</p>
            <button type="button" class="bg-secondary px-2 border text-white edituser_view" id="<?php echo $member_id; ?>" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          
              <div class="row mt-0 mb-3 pt-0">
                 
                    <div class="col-sm-12 success_alert" id="success_alert"></div>
                    <div class="col-sm-12 warning_alert" id="warning_alert"></div>
                    
                  </div>
              <form id="staff_to_payroll_form" method="post">
            
                    <div class="modal-body pt-0">
                      <div class="row">
                        <div class="col-sm-6">
                             <div class="row my-3">
                          
                                <div class="form-group col-sm-12">
                                    <label class="mr-2">Level</label>
                                    <select id="job_level_id" name="job_level_id" class="form-control farm-button-cancel">
                                                <option value="0">-- Choose Level</option>
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
                                    <input type="hidden" id="employee_id" name="employee_id" value="<?php echo $member_id; ?>" >
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
                    <input type="hidden" name="employee_id" id="employee_id" value="<?php echo $member_id; ?>" />
                    <button type="button" class="py-1 px-2 border farm-color mx-0 savestaff_to_payroll">Add</button>
                    <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0 edituser_view" id="<?php echo $member_id; ?>" data-dismiss="modal" aria-label="Close">Close</button>
                  
                  </div>
          </form>
        </div>
    </div>
  </div>
  <div id="updateModal" class="modal fade" data-backdrop="static">
    <div class="modal-dialog modal-md">
      
        <div class="modal-content">
          <div class="farm-color modal-header p-2">
            <p class="modal-title" id="staticBackdropLabel">Update Staff Level</p>
            <button type="button" class="bg-secondary px-2 border text-white edituser_view" id="<?php echo $member_id; ?>" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          
              <div class="row mt-0 mb-3 pt-0">
                 
                    <div class="col-sm-12 success_alert" id="success_alert"></div>
                    <div class="col-sm-12 warning_alert" id="warning_alert"></div>
                    
                  </div>
              <form id="update_staff_to_payroll_form" method="post">
             <?php
                      $staff_level = Db::getInstance()->query("SELECT a.*, a.id as payroll_id, b.id as level_id, b.level 
                      FROM payroll a
                      LEFT JOIN job_level b ON a.job_level_id = b.id
                      WHERE employee_id = $member_id");
                      foreach($staff_level->results() as $staff_level){
                      ?>
                    <div class="modal-body pt-0">
                      <div class="row">
                        <div class="col-sm-6">
                             <div class="row my-3">
                          
                                <div class="form-group col-sm-12">
                                    <label class="mr-2">Level</label>
                                    <select id="job_level_id_u" name="job_level_id_u" class="form-control farm-button-cancel">
                                       
                                        <option value="<?php echo $staff_level->level_id; ?>"><?php echo $staff_level->level; ?></option>
                                                
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
                                    <input type="hidden" id="employee_id_u" name="employee_id_u" value="<?php echo $member_id; ?>" >
                                 </div>
                             </div>
                             <div class="row my-3">
                                 <div class="form-group col-sm-12">
                                  <input type="text" class="form-control is-valid" id="basic_salary_u" name="basic_salary_u" placeholder="<?php echo $staff_level->basic_salary; ?>" required readonly>
                                  <div class="valid-feedback text-dark">
                                    Basic Salary
                                  </div>
                                </div>
                             </div>
                             <div class="row my-3">
                                 <div class="form-group col-sm-12">
                                  <input type="text" class="form-control is-valid" id="housing_allowance_u" name="housing_allowance_u" placeholder="<?php echo $staff_level->housing_allowance; ?>" required readonly>
                                  <div class="valid-feedback text-dark">
                                    Housing Allowance
                                  </div>
                                </div>
                             </div>
                             <div class="row my-3">
                                 <div class="form-group col-sm-12">
                                  <input type="text" class="form-control is-valid" id="transport_allowance_u" name="transport_allowance_u" placeholder="<?php echo $staff_level->transport_allowance; ?>" required readonly>
                                  <div class="valid-feedback text-dark">
                                    Transport Allowance
                                  </div>
                                </div>
                             </div>
                         </div>
                        <div class="col-sm-6 pt-5">
                             
                         <div class="row mt-4 pt-5">
                             <div class="form-group col-sm-12">
                              <input type="text" class="form-control is-valid" id="medical_allowance_u" name="medical_allowance_u" placeholder="<?php echo $staff_level->medical_allowance; ?>" required readonly>
                              <div class="valid-feedback text-dark">
                                Medical Allowance
                              </div>
                            </div>
                         </div>
                         <div class="row my-3">
                             <div class="form-group col-sm-12">
                              <input type="text" class="form-control is-valid" id="utility_allowance_u" name="utility_allowance_u" placeholder="<?php echo $staff_level->utility_allowance; ?>" required readonly>
                              <div class="valid-feedback text-dark">
                                Utility Allowance
                              </div>
                            </div>
                         </div>
                         <div class="row my-3">
                             <div class="form-group col-sm-12">
                              <input type="text" class="form-control is-valid" id="entertainment_u" name="entertainment_u" placeholder="<?php echo $staff_level->entertainment; ?>" required readonly>
                              <div class="valid-feedback text-dark">
                                Entertainment
                              </div>
                            </div>
                         </div>
                    </div>
                    </div>
                  </div>
                    
                  <div class="modal-footer">
                      
                    <input type="hidden" name="id_u" id="id_u" value="<?php echo $staff_level->payroll_id; ?>" />
                    
                    <button type="button" class="py-1 px-2 border farm-color mx-0 update_savestaff_to_payroll">Update</button>
                    <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0 edituser_view" id="<?php echo $member_id; ?>" data-dismiss="modal" aria-label="Close">Close</button>
                  
                  </div>
                  <?php
                  
                      }
                  
                  ?>
          </form>
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
   $(document).ready(function(event) {
           
       
        $('.success_alert').hide();
        $('.warning_alert').hide();
        
         
          
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
     	
     	$("#job_level_id_u").change(function(){  
	    let id = $(this).find(":selected").val();
		let dataString = 'job_level_id_u='+ id;  
		
		//alert(dataString);
	
		$.ajax({
			url: 'view/usermanager/staff/payroll_individual/getlevel_payslip.php',
            dataType: 'json',
			data: dataString,  
			cache: false,
			success:function(response){
                
                let len = response.length;

                
                    for( let i = 0; i<len; i++){
                   
                   
                    let job_level_id        = response[i]['job_level_id']
                    let basic_salary        = response[i]['basic_salary']
                    let housing_allowance   = response[i]['housing_allowance']
                    let transport_allowance = response[i]['transport_allowance']
                    let medical_allowance   = response[i]['medical_allowance']
                    let utility_allowance   = response[i]['utility_allowance']
                    let entertainment       = response[i]['entertainment']
                  
                  //alert(description)
                  
                   $('#basic_salary_u').val(basic_salary);
                   $('#housing_allowance_u').val(housing_allowance);
                   $('#transport_allowance_u').val(transport_allowance);
                   $('#medical_allowance_u').val(medical_allowance);
                   $('#utility_allowance_u').val(utility_allowance);
                   $('#entertainment_u').val(entertainment);
                  }
    				 	
    			} 
    		});
     	}); 
     	
        $('.savestaff_to_payroll').on('click', function(e){
        
                    let form = $('#staff_to_payroll_form')[0]; // You need to use standard javascript object here 
                    let formData = new FormData(form); 
                   
                   //alert(formData);
                   
        		
        		$.ajax({
        				url: 'view/usermanager/staff/payroll_individual/insert.php',
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
        
        $('.update_savestaff_to_payroll').on('click', function(e){
        
                    let form = $('#update_staff_to_payroll_form')[0]; // You need to use standard javascript object here 
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
        
        $('.prev_page').click(function () {
        
        	let id = $(this).attr('id');
        
        //alert(id);
        
        $("#loader_httpFeed").show();
        $.ajax({
        	type: "POST",
        	url: "view/usermanager/staff/view.php",
        	data:{
        	    id : id
        	},
        	cache: false,
        	success: function (msg) {
        		$("#contentbar_inner").html(msg);
        		$("#loader_httpFeed").hide();
        	}
        }); 
        
        });
        
        $('.edituser_view').click(function (e) {
        	
        	let member_id = $(this).attr('id');
        	
        	$("#loader_httpFeed").show();
        	$.ajax({
        		type: "POST",
        		url: "view/usermanager/staff/payroll_individual/index.php",
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
        
        $('.singledelete').on('click', function(e){
                
                let del = $(this).attr('lang');
                
                let confirmation = confirm("Are you sure you want to remove the item?");
               
               
               if (confirmation) { 
               
            
             
                $.ajax({
                   	url: 'view/usermanager/payroll/individual/delete.php',
        		    type: 'POST',
                    data:{
                          'del':del
                    },
                    cache: false,
                    success:function(data){
                        $(".success_alert").html(data);
                        $(".success_alert").show();
                        $('#sload').html(''); 
                    }
                });
                
               }
                e.preventDefault();
            });
        
        $('#inputTransaction_year').change(function(evt){ 
                
            let id = $(this).find(":selected").val(); 
            
            let member_id = $('#member_id').val(); 
        	let transact_ = $('#trans').val(); 
            	//alert(id)
        
            $.ajax({
                type: "GET",
                url: "view/usermanager/staff/payroll_individual/select.php",
                //dataType: 'json',
        		data: {
        		    id: id,
        		    member_id: member_id,
        		    transact_: transact_
        		},
                cache: false,
        		beforeSend: function() {
        		    
                    $('#load').html('<img src="loader.png" alt="reload" width="20" height="20" style="margin-top:10px;">');
        			
                },
                success: function(html) {
                    $("#userr").html(html);
                    $('#load').html(''); 
                }
            });
        
        
         evt.preventDefault();
        
        
        });


    



    event.preventDefault();
	});
	
    $(document).ready(function(evt){ 
        let member_id = $('#member_id').val(); 
		let transact_ = $('#trans').val(); 
		
		
		//alert(member_id)
	
        $.ajax({
            type: "POST",
            url: "view/usermanager/staff/payroll_individual/select.php",
            //dataType: 'json',
			data: {
			    member_id: member_id,
			    transact_: transact_
			},
            cache: false,
    		beforeSend: function() {
    		    
                $('#load').html('<img src="loader.png" alt="reload" width="20" height="20" style="margin-top:10px;">');
    			
            },
            success: function(html) {
                $("#userr").html(html);
                $('#load').html(''); 
            }
        });
        
        
         evt.preventDefault();
        
      
       });
 </script>
 

  