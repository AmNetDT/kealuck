<?php

require_once '../../core/init.php';

$member_id = $_POST['user_id'];
//echo $member_id;
$user = new User();
if ($user->isLoggedIn()) {

?>

    <div id="body_general">

        <div id="accounttile">
            <div class="col-sm-12 col-sm-6">
                <span id="close" class="fa fa-close p-1 btn-danger text-lg"></span>
            </div>
        </div>
        
        <div class="container">
             <?php

                    $staffa = Db::getInstance()->query("SELECT CONCAT(sr.firstname,' ', sr.othername,' ',sr.lastname) as staffname, sr.user_id as user_id, sr.id as id,
                    sr.firstname, sr.othername, sr.lastname, sr.email, sr.phone, sr.image, sr.date_of_birth as date_of_birth, sr.next_of_kin as next_of_kin, sr.next_of_kin_phone as next_of_kin_phone,
                    sr.address as staff_address, sr.next_of_kin_address as next_of_kin_address, sr.next_of_kin_email as next_of_kin_email,
                    sr.next_of_kin_date_of_birth as next_of_kin_date_of_birth, sr.next_of_kin_gender as next_of_kin_gender, sr.next_of_kin_marital_status as next_of_kin_marital_status,
                    sr.gross_salary as gross_salary, sr.working_hours as working_hours, sr.work_mobile as work_mobile, sr.work_email as work_email, sr.gender as gender, sr.marital_status as marital_status,
                    sr.bank_name as bank_name, sr.bank_acc as bank_acc, sr.edu_school as edu_school, sr.edu_field_of_study as edu_field_of_study, sr.edu_certificate_level as edu_certificate_level,
                    sr.edu_date as edu_date, sr.address as address, sr.emergency_contact_name as emergency_contact_name, sr.emergency_phone as emergency_phone,
                    sr.nationality as nationality, sr.national_identification_no as national_identification_no, sr.passport_no as passport_no,
                    sy.name as syscategory, wl.location as worklocation,
                    jt.name as jobtitle, d.name as department, 
                    u.supervisor_id as supervisor,
                    u.department_id as department_id
                    FROM staff_record sr 
                    LEFT JOIN users u ON u.username = sr.user_id
                    LEFT JOIN job_title jt ON u.jobtitle_id = jt.id
                    LEFT JOIN departments d ON u.department_id = d.id
                    LEFT JOIN worklocation wl ON u.worklocation_id = wl.id
                    LEFT JOIN syscategory sy ON sy.id = u.syscategory_id
                    WHERE sr.user_id = '$member_id'");

                    if ($staffa->count()) {
                        foreach ($staffa->results() as $staff) {
                    ?>
            <script>
              image.onchange = evt => {
                  const [file] = image.files
                  if (file) {
                    blah.src = URL.createObjectURL(file);
                    
                }
              }  
                
          </script>
                   <form id="uploadForm" method="post" enctype="multipart/form-data">
            <div class="jumbotron jumbotron-fluid pt-3 bg-white">
                <div id="accounttile" class="container">
                    <div class="row mt-2">
                        <div class="container">
                            <div class="col-md-12">
                               <div class="row justify-content-end"> 
                                <div class="col-9">
                    <h3 style="line-height:1.0em"><?php echo $staff->staffname ?><br/><span style="font-size:0.9rem;"><?php echo $staff->user_id ?></span></h3>
                                </div>
                                <div class="col-3 pl-0"> 
                                    <h2>Payment slip</h2>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="container">
                            <div class="col-md-12">
                             <div class="row justify-content-end mb-3"> 
                                <div class="col-9">
                                    <div class="col-md-1 p-0" style="font-size:0.9rem">   
                                        <div class="image-upload">
                                            <label for="image">
                                                <?php if (!empty($staff->image)) {
                                                    echo '<img id="blah" src="view/usermanager/staff/' . $staff->image . '" class="img-thumbnail border" alt=""><p style="text-align:center">';
                                                } else {
                                                    echo '<img id="blah" class="img-thumbnail border" src="view/usermanager/staff/add_user_icon.jpg" alt="" />';
                                                } ?>
                                                </label>
                                                <input accept="image/*" id="image" name="image" type="file" class="d-none" />
                                                <input type="hidden" id="pimage" name="pimage" value="<?php echo $staff->image; ?>" />
                                                </div>
                                        </div>
                                    </div>
                                <div class="col-3 mx-0 px-0">
                                    <input type="hidden" value="<?php echo $member_id; ?>" id="user_id" name="user_id" />
                                    <input type="hidden" value="<?php echo $staff->id; ?>" id="id" name="id" />
                                      <button class="farm-button-cancel py-1 ml-0 editstaff" lang="view/usermanager/staff/" id="<?php echo $staff->id; ?>">
                                        <span class="fa fa-chevron-left"></span>
                                      </button> 
                                      <button type="button" class="farm-button py-1 ml-0 SaveStaff">
                                        <span class="fa fa-save"> Save</span>
                                      </button> 
                                      <button type="button" class="farm-button py-1 ml-0 SaveStaff">
                                        <span class="fa fa-print"></span>
                                      </button>
                                      <button class="farm-button-icon-button py-1 ml-0 editstaff_view" lang="view/usermanager/staff/" id="<?php echo $staff->user_id; ?>">
                                        <span class="fa fa-refresh"></span> 
                                      </button>
                                     
                                </div>
                             </div>
                             <div class="row">
                                 <div class="success_alert"></div>
                                 <div class="warning_alert"></div>
                             </div>
                            </div>
                    
                            <div class="row border-bottom justify-content-center">
                                <div class="container my-4">
                                    <div class="card mb-2" style="max-width:100%;">
                                        <div class="row no-gutters">
                                            
                                            <div class="col-md-12" style="font-size:0.9rem;">
                                              
                                                   <nav>
                                                      <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                        <a class="nav-link farm-tab-button active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Monthly Enumeration</a>
                                                        <a class="nav-link farm-tab-button" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Leave Record</a>
                                                        <a class="nav-link farm-tab-button" id="nav-kin-tab" data-toggle="tab" href="#nav-kin" role="tab" aria-controls="nav-kin" aria-selected="false">Loan</a>
                                                      </div>
                                                    </nav>
                                                    <div class="tab-content py-4" id="nav-tabContent">
                                                      <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                                          <div class="row">
                                                          <div class="col-6">
                                                          
                                                              <div class="form-row">
                                                                <div class="col-md-4 mb-3">
                                                                  <label for="firstname">First name</label>
                                                                  <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $staff->firstname ?>" required>
                                                                </div>
                                                                <div class="col-md-4 mb-3">
                                                                  <label for="othername">Other name</label>
                                                                  <input type="text" class="form-control" id="othername" name="othername" value="<?php echo $staff->othername ?>">
                                                                  <small id="passwordHelpInline" class="text-muted">
                                                                      (Optional)
                                                                    </small>
                                                                </div>
                                                                <div class="col-md-4 mb-3">
                                                                  <label for="lastname">Last name</label>
                                                                  <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $staff->lastname ?>" required>
                                                                </div>
                                                              </div>
                                                              <div class="form-row">
                                                                <div class="col-md-6 mb-3">
                                                                  <label for="phone">Work Mobile</label>
                                                                  <input type="text" class="form-control" id="work_mobile" name="work_mobile" value="<?php echo $staff->work_mobile ?>">
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                  <label for="email">Work Email</label>
                                                                  <input type="text" class="form-control" id="work_email" name="work_email" value="<?php echo $staff->work_email ?>">
                                                                </div>
                                                                <div class="col-md-3 mb-3">
                                                                  <label>Department</label>
                                                                  <p class="card-text"><small class="text-muted"><?php echo $staff->jobtitle ?></small></p>
                                                                </div>
                                                                <div class="col-md-3 mb-3">
                                                                  <label>Job Title</label>
                                                                  <p class="card-text"><small class="text-muted"><?php echo $staff->jobtitle ?></small></p>
                                                                </div>
                                                                <div class="col-md-3 mb-2">
                                                                  <label for="location_id">Work Location</label>
                                                                  <p class="card-text"><small class="text-muted"><?php echo $staff->worklocation ?></small></p>
                                                                 
                                                                </div>
                                                                <div class="col-md-3 mb-3">
                                                                  <label for="supervisor">Supervisor</label>
                                                                  <p class="card-text"><small class="text-muted"><?php echo $staff->supervisor ?></small></p>
                                                                </div>
                                                              </div>
                                                              
                                                           </div> 
                                                           <div class="col-6" style="border-left:solid 1px #999">
                                                         
                                                              <div class="form-row">
                                                                <div class="col-md-6 mb-3">
                                                                  <label for="working_hours">Working hours</label>
                                                                  <div class="input-group mb-2 mr-sm-2">
                                                                    <input type="text" class="form-control" id="working_hours" name="working_hours" value="<?php echo $staff->working_hours ?>">
                                                                    <div class="input-group-prepend">
                                                                      <div class="input-group-text">hours per month</div>
                                                                    </div>
                                                                  </div>

                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                  <label for="working_hours">Gross salary</label>
                                                                  <div class="input-group mb-2 mr-sm-2">
                                                                      <div class="input-group-prepend">
                                                                      <div class="input-group-text">Annual</div>
                                                                    </div>
                                                                    <input type="text" class="form-control" id="gross_salary" name="gross_salary" value="<?php echo $staff->gross_salary ?>">
                                                                  </div>

                                                                </div>
                                                              </div>
                                                              
                                                           </div> 
                                                          </div>
                                                        </div>
                                                      <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                                          <div class="row">
                                                          <div class="col-6">
                                                          
                                                              <div class="form-row">
                                                                <div class="col-md-12 mb-3">
                                                                  <label for="address">Address</label>
                                                                  <textarea class="form-control" id="address" name="address" rows="3"><?php echo $staff->address ?></textarea>
                                                                </div>
                                                              </div>
                                                              <div class="form-row">
                                                                <div class="col-md-6 mb-2">
                                                                  <label for="phone">Mobile</label>
                                                                  <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $staff->phone ?>">
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                  <label for="email">Email</label>
                                                                  <input type="text" class="form-control" id="email" name="email" value="<?php echo $staff->email ?>">
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                  <label for="bank_acc">Bank Name</label>
                                                                  <input type="text" class="form-control" id="bank_name" name="bank_name" value="<?php echo $staff->bank_name ?>">
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                  <label for="bank_acc">Bank Account Number</label>
                                                                  <input type="text" class="form-control" id="bank_acc" name="bank_acc" value="<?php echo $staff->bank_acc ?>">
                                                                </div>
                                                                 <div class="form-row">
                                                                <div class="col-md-6 mb-3">
                                                                  <label for="date_of_birth">Date of Birth</label>
                                                                  <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="<?php echo $staff->date_of_birth ?>">
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                  <label for="marital_status">Marital Status</label>
                                                                  <select class="custom-select" id="marital_status" name="marital_status" required>
                                                                    <option selected value="<?php echo $staff->marital_status; ?>"><?php echo $staff->marital_status; ?></option>
                                                                    <option value="Single">Single</option>
                                                                    <option value="Married">Married</option>
                                                                    <option value="Widowed">Widowed</option>
                                                                    <option value="Widower">Widower</option>
                                                                    <option value="Separated">Separated</option>
                                                                    <option value="Divorced">Divorced</option>
                                                                  </select>
                                                                </div>
                                                                </div>
                                                                <div class="form-row">
                                                                <div class="col-md-6 mb-3">
                                                                  <label for="emergency_contact_name">Emergency Contact</label>
                                                                  <input type="text" class="form-control" id="emergency_contact_name" name="emergency_contact_name" value="<?php echo $staff->emergency_contact_name; ?>" required>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                  <label for="emergency_phone">Emergency Phone</label>
                                                                  <input type="text" class="form-control" id="emergency_phone" name="emergency_phone" value="<?php echo $staff->emergency_phone; ?>" required>
                                                                </div>
                                                                </div>
                                                              </div>
                                                              
                                                           </div> 
                                                           <div class="col-6" style="border-left:solid 1px #999">
                                                         
                                                              <div class="form-row">
                                                                <div class="col-md-6 mb-3">
                                                                  <label for="edu_certificate_level">Certificate Level</label>
                                                                  <div class="input-group mb-2 mr-sm-2">
                                                                    <select class="custom-select" id="edu_certificate_level" name="edu_certificate_level">
                                                                        <option selected value="<?php echo $staff->edu_certificate_level; ?>"><?php echo $staff->edu_certificate_level; ?></option>
                                                                        <option value="O'Level Certificate SSCE/WAEC">O'Level Certificate SSCE/WAEC</option>
                                                                        <option value="Certificate">Certificate</option>
                                                                        <option value="Bachelor BSc/BA">Bachelor BSc/BA</option>
                                                                        <option value="Master MSc/MBA">Master MSc/MBA</option>
                                                                        <option value="Doctor PhD">Doctor PhD</option>
                                                                    </select>
                                                                  </div>

                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                  <label for="edu_date">Date</label>
                                                                  <input type="date" class="form-control" id="edu_date" name="edu_date" value="<?php echo $staff->edu_date; ?>">
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                  <label for="edu_field_of_study">Field of Study</label>
                                                                  <div class="input-group mb-2 mr-sm-2">
                                                                  <textarea class="form-control" id="edu_field_of_study" name="edu_field_of_study" rows="3"><?php echo $staff->edu_field_of_study; ?></textarea>
                                                                  </div>

                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                  <label for="edu_school">School</label>
                                                                  <div class="input-group mb-2 mr-sm-2">
                                                                  <textarea class="form-control" id="edu_school" name="edu_school" rows="3"><?php echo $staff->edu_school; ?></textarea>
                                                                  </div>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                  <label for="nationality">Nationality (Country)</label>
                                                                  <input type="text" class="form-control" id="nationality" name="nationality" value="<?php echo $staff->nationality; ?>" required>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                  <label for="national_identification_no">Identification No</label>
                                                                  <input type="text" class="form-control" id="national_identification_no" name="national_identification_no" value="<?php echo $staff->national_identification_no; ?>" required>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                  <label for="passport_no">Passport No</label>
                                                                  <input type="text" class="form-control" id="passport_no" name="passport_no" value="<?php echo $staff->passport_no; ?>" >
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                  <label for="gender">Gender</label>
                                                                  <select class="custom-select" id="gender" name="gender" required>
                                                                    <option selected value="<?php echo $staff->gender; ?>"><?php echo $staff->gender; ?></option>
                                                                    <option value="Male">Male</option>
                                                                    <option value="Female">Female</option>
                                                                    <option value="Other">Other</option>
                                                                  </select>
                                                                </div>
                                                                
                                                              </div>
                                                              
                                                           </div> 
                                                          </div>
                                                      </div>
                                                      <div class="tab-pane fade" id="nav-kin" role="tabpanel" aria-labelledby="nav-kin-tab">
                                                          <div class="row">
                                                          <div class="col-6">
                                                              <div class="form-row">
                                                                <div class="col-md-8 mb-3">
                                                                  <label for="next_of_kin">Full name</label>
                                                                  <input type="text" class="form-control" id="next_of_kin" name="next_of_kin" value="<?php echo $staff->next_of_kin ?>">
                                                                </div>
                                                                <div class="col-md-4 mb-3">
                                                                  <label for="next_of_kin_date_of_birth">Date of Birth</label>
                                                                  <input type="date" class="form-control" id="next_of_kin_date_of_birth" name="next_of_kin_date_of_birth" 
                                                                  value="<?php echo $staff->next_of_kin_date_of_birth; ?>" required />
                                                                </div>
                                                             </div>
                                                              <div class="form-row">
                                                                <div class="col-md-12 mb-3">
                                                                  <label for="next_of_kin_address">Address</label>
                                                                  <textarea class="form-control" id="next_of_kin_address" name="next_of_kin_address" rows="3"><?php echo $staff->next_of_kin_address ?></textarea>
                                                                </div>
                                                              </div>
                                                              <div class="form-row">
                                                                <div class="col-md-6 mb-2">
                                                                  <label for="next_of_kin_phone">Mobile</label>
                                                                  <input type="text" class="form-control" id="next_of_kin_phone" name="next_of_kin_phone" value="<?php echo $staff->next_of_kin_phone ?>">
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                  <label for="next_of_kin_email">Email</label>
                                                                  <input type="text" class="form-control" id="next_of_kin_email" name="next_of_kin_email" value="<?php echo $staff->next_of_kin_email ?>">
                                                                </div>
                                                              </div>
                                                              
                                                           </div> 
                                                           <div class="col-6" style="border-left:solid 1px #999">
                                                         
                                                              <div class="form-row">
                                                                <div class="col-md-6 mb-3">
                                                                  <label for="next_of_kin_gender">Gender</label>
                                                                  <select class="custom-select" id="next_of_kin_gender" name="next_of_kin_gender" required>
                                                                    <option selected value="<?php echo $staff->next_of_kin_gender; ?>"><?php echo $staff->next_of_kin_gender; ?></option>
                                                                    <option value="Male">Male</option>
                                                                    <option value="Female">Female</option>
                                                                    <option value="Other">Other</option>
                                                                  </select>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                  <label for="next_of_kin_marital_status">Marital Status</label>
                                                                  <select class="custom-select" id="next_of_kin_marital_status" name="next_of_kin_marital_status" required> 
                                                                    <option selected value="<?php echo $staff->next_of_kin_marital_status; ?>"><?php echo $staff->next_of_kin_marital_status; ?></option>
                                                                    <option value="Single">Single</option>
                                                                    <option value="Married">Married</option>
                                                                    <option value="Widowed">Widowed</option>
                                                                    <option value="Widower">Widower</option>
                                                                    <option value="Separated">Separated</option>
                                                                    <option value="Divorced">Divorced</option>
                                                                  </select>
                                                                </div>
                                                              </div>
                                                              
                                                           </div> 
                                                          </div>
                                                      </div>
                                                    </div>

                                                
                                                </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                </div>
               </div>
              </div>
            </div>
                  </form>
            <?php
                     } 
                    }
                    ?>
        </div>
    </div>

<?php

} else {
    $user->logout();
    Redirect::to('../../login/');
}


?>

<script>
    $(document).ready(function (){
         $('.success_alert').hide();
         $('.warning_alert').hide();
    })
</script>

<script>
    $(document).ready(function(event) {
     
       
       $('.SaveStaff').on('click', function(){
       
                let form = $('form')[0]; // You need to use standard javascript object here
                let formData = new FormData(form);  
                
                //alert(formData)
           
                    $.ajax({
        				url: 'view/usermanager/staff/updatepayroll.php',
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
   });    
     
           
     
     
</script>
<script>

   $(document).ready(function(event) {
       
    	$('.editstaff_view').click(function (e) {
		
		let ed = $(this).attr('lang');
		let id = $(this).attr('id');
	
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: ed + "/edit_payroll.php",
			data:{
			    'user_id':id
			},
			cache: false,
			success: function (msg) {
				$("#contentbar_inner").html(msg);
				$("#loader_httpFeed").hide();
			}
		});
		e.preventDefault();
	});   
       
      	$('.editstaff').click(function (e) {
		
		let ed = $(this).attr('lang');
		let id = $(this).attr('id');
	
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: ed + "/view.php",
			data:{
			    'id':id
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
