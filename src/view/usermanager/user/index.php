<?php

require_once '../../core/init.php';

$user = new User();
if ($user->isLoggedIn()) {
$username = escape($user->data()->id);
$user_id = escape($user->data()->username);
?>

  <div id="body_general">
    <div class="container-fluid p-0 bg-success">
        <div id="accounttile">
          <div class="col-sm-12 col-sm-6">
            <span id="close" class="fa fa-close p-1 btn-danger text-lg"></span>
          </div>
        </div>
<?php

       $staffa = Db::getInstance()->query("SELECT CONCAT(sr.firstname,' ', sr.othername,' ',sr.lastname) as staffname, sr.user_id as user_id, sr.id as id,
                    sr.firstname, sr.othername, sr.lastname, sr.email, sr.phone, sr.image, sr.date_of_birth, sr.next_of_kin as next_of_kin, sr.next_of_kin_phone as next_of_kin_phone,
                    sr.address as staff_address, sr.next_of_kin_address as next_of_kin_address, sr.next_of_kin_email as next_of_kin_email,
                    sr.gross_salary as gross_salary, sr.working_hours as working_hours, sr.work_mobile as work_mobile, sr.work_email as work_email, sr.gender as gender, sr.marital_status as marital_status,
                    sr.bank_name as bank_name, sr.bank_acc as bank_acc, sr.edu_school as edu_school, sr.edu_field_of_study as edu_field_of_study, sr.edu_certificate_level as edu_certificate_level,
                    sr.edu_date as edu_date, sr.address as address, sr.emergency_contact_name as emergency_contact_name, sr.emergency_phone as emergency_phone,
                    sr.nationality as nationality, sr.national_identification_no as national_identification_no, sr.passport_no as passport_no,
                    sy.name as syscategory, wl.location as worklocation,
                    u.supervisor_id as supervisor,
                    jt.name as jobtitle, d.name as department, 
                    sg.guarantor_fullname as guarantor_fullname, sg.guarantor_address as guarantor_address, sg.guarantor_phone as guarantor_phone, 
                    sg.guarantor_email as guarantor_email, sg.guarantor_occupation as guarantor_occupation, sg.relation_to_emp as relation_to_emp, 
                    sg.guarantor_image as guarantor_image
                    FROM  users u 
                    LEFT JOIN staff_record sr ON u.username = sr.user_id
                    LEFT JOIN job_title jt ON u.jobtitle_id = jt.id
                    LEFT JOIN departments d ON u.department_id = d.id
                    LEFT JOIN worklocation wl ON u.worklocation_id = wl.id
                    LEFT JOIN staff_guarantor sg ON sr.user_id = sg.user_id
                    LEFT JOIN syscategory sy ON sy.id = u.syscategory_id
                    WHERE sr.user_id = '$user_id'");
                    if ($staffa->count()) {
                        foreach ($staffa->results() as $staff) {
?>
    
      <div class="jumbotron jumbotron-fluid pt-5 bg-white">
        <div id="accounttile" class="container">
          <h3>Profile Settings</h3>
          <div class="row">
            <div class="container">
              <div class="card mb-3" style="max-width: 100%;">
                <div class="row no-gutters">
                  <div class="col-sm-2">
                    <?php if (!empty($staff->image)) {
                            echo '<img src="view/usermanager/staff/' . $staff->image . '" class="card-img" alt="">';
                        } else {
                            echo '<img class="img-thumbnail border" src="view/usermanager/staff/add_user_icon.jpg" alt="" />';
                        } ?>
                  </div>
                  <div class="col-sm-10">
                    <div class="card-body">
                      <div class="row border-bottom justify-content-center">
                                <div class="container my-4">
                                    <div class="card mb-3" style="max-width:100%;">
                                        <div class="row">
                                                
                                            <div class="col-sm-4" style="font-size:0.9rem">
                                                   
                                                        <ul class="list-group">
                                                            
                                                          <li class="list-group-item d-flex justify-content-between align-items-center">Department <span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->department; ?></span></li>
                                                          <li class="list-group-item d-flex justify-content-between align-items-center">Job title <span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->jobtitle; ?></span></li>
                                                          <li class="list-group-item d-flex justify-content-between align-items-center">Supervisor<span class="badge badge-light badge-pill text-dark p-2"> <?php 
                                                                  
                                                                  $supe = $staff->supervisor;
                                                                  
                                                                  $stafa = Db::getInstance()->query("SELECT CONCAT(firstname,'  ',lastname) as staffname FROM staff_record WHERE id = $supe");
                                                                  foreach($stafa->results() as $stafa){
                                                                      
                                                                      echo $stafa->staffname;
                                                                      
                                                                  }
                                                                  
                                                                  ?></span></li>
                                                          <li class="list-group-item d-flex justify-content-between align-items-center">Work mobile <span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->work_mobile; ?></span></li>
                                                          <li class="list-group-item d-flex justify-content-between align-items-center">Work email<span class="text-dark p-2"> <?php echo $staff->work_email; ?></span></li>
                                                          <li class="list-group-item d-flex justify-content-between align-items-center">Working hours per month<span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->working_hours; ?></span></li>
                                                          <li class="list-group-item d-flex justify-content-between align-items-center">Work Location <span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->work_mobile; ?></span></li>
                                                          
                                                          
                                                        </ul>
    
                                                       
                                                    </div>
                                            <div class="col-sm-8">
                                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                  <li class="nav-item" role="presentation">
                                                    <a class="nav-link farm-tab-button active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Private Information</a>
                                                  </li>
                                                  <li class="nav-item" role="presentation">
                                                    <a class="nav-link farm-tab-button" id="next_kin-tab" data-toggle="tab" href="#next_kin" role="tab" aria-controls="next_kin" aria-selected="false">Next of Kin</a>
                                                  </li>
                                                  <li class="nav-item" role="presentation">
                                                    <a class="nav-link farm-tab-button" id="guarantor-tab" data-toggle="tab" href="#guarantor" role="tab" aria-controls="guarantor" aria-selected="false">Guarantor</a>
                                                  </li>
                                                  <li class="nav-item" role="presentation">
                                                    <a class="nav-link farm-tab-button" id="hr-tab" data-toggle="tab" href="#hr" role="tab" aria-controls="hr" aria-selected="false">HR Settings</a>
                                                  </li>
                                                </ul>
                                                <div class="tab-content" id="myTabContent">
                                                  <div class="tab-pane fade show active p-3" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                       <div style="font-size:0.9rem; float:left; width:100%;">
                                                   
                                                        <ul class="list-group">
                                                          <li class="list-group-item list-group-item-success d-flex justify-content-between align-items-center">Fullname<span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->staffname; ?></span></li>
                                                          <li class="list-group-item d-flex justify-content-between align-items-center">Date of birth<span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->date_of_birth; ?></span></li>
                                                          <li class="list-group-item d-flex justify-content-between align-items-center">Gender<span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->gender; ?></span>Marital status<span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->marital_status; ?></span></li>
                                                          <li class="list-group-item d-flex justify-content-between align-items-center"><b>Phone</b><span class="text-dark p-2"> <?php echo $staff->phone; ?></span><b>Email</b><span class="text-dark p-2"> <?php echo $staff->email; ?></span></li>
                                                          <li class="list-group-item d-flex justify-content-between align-items-center">Nationality<span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->nationality; ?></span></li>
                                                          <li class="list-group-item d-flex justify-content-between align-items-center">National identity no<span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->national_identification_no; ?></span>Passport no<span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->passport_no; ?></span></li>
                                                          <li class="list-group-item d-flex justify-content-between align-items-center">Bank name<span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->bank_name; ?></span>Bank account<span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->bank_acc; ?></span></li>
                                                          <li class="list-group-item list-group-item-success d-flex justify-content-between align-items-center">Emergency contact person<span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->emergency_contact_name; ?></span></li>
                                                          <li class="list-group-item d-flex justify-content-between align-items-center">Emergency contact phone<span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->emergency_phone; ?></span></li>
                                                          <li class="list-group-item list-group-item-success d-flex justify-content-between align-items-center">Educational Institute<span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->edu_school; ?></span></li>
                                                          <li class="list-group-item d-flex justify-content-between align-items-center">Field of study<span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->edu_field_of_study; ?></span></li>
                                                          <li class="list-group-item d-flex justify-content-between align-items-center">Certificate level<span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->edu_certificate_level; ?></span></li>
                                                          <li class="list-group-item d-flex justify-content-between align-items-center">Date<span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->edu_date; ?></span></li>
                                                     </ul>
                                                       
                                                    </div>
                                                  </div>
                                                  <div class="tab-pane fade p-3" id="next_kin" role="tabpanel" aria-labelledby="next_kin-tab">
                                                      
                                                      <div style="font-size:0.9rem; float:left; width:100%;">
                                                   
                                                        <ul class="list-group">
                                                           <li class="list-group-item list-group-item-success d-flex justify-content-between align-items-center">Next of Kin<span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->next_of_kin; ?></span></li>
                                                          <li class="list-group-item d-flex justify-content-between align-items-center">Phone<span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->next_of_kin_phone; ?></span></li>
                                                          <li class="list-group-item d-flex justify-content-between align-items-center">Email<span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->next_of_kin_email; ?></span></li>
                                                          <li class="list-group-item d-flex justify-content-between align-items-center">Address<span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->next_of_kin_address; ?></span></li>
                                                         </ul>
                                                       
                                                    </div>
                                                   
                                                  </div>
                                                  <div class="tab-pane fade p-3" id="guarantor" role="tabpanel" aria-labelledby="guarantor-tab">
                                                     
                                                       <div style="float:left; width:22.5%; margin-right:2.5%">
                                                        
                                                                <?php if (!empty($staff->guarantor_image)) {
                                                                    echo '<img src="view/usermanager/staff/' . $staff->guarantor_image . '" class="card-img" alt="">';
                                                                } else {
                                                                     echo '<img class="img-thumbnail border" src="view/usermanager/staff/add_user_icon.jpg" alt="" /><p style="text-align:center">Guarantor</p>';
                                                                } ?>
                                                                 
                                                        </div>
                                                      <div style="float:left; width:75%; font-size:0.9rem;">
                                                   
                                                        <ul class="list-group">
                                                          <li class="list-group-item list-group-item-success d-flex justify-content-between align-items-center">Guarantor<span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->guarantor_fullname; ?></span></li>
                                                          <li class="list-group-item d-flex justify-content-between align-items-center">Occupation<span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->guarantor_occupation; ?></span></li>
                                                          <li class="list-group-item d-flex justify-content-between align-items-center">Relationship with Staff<span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->relation_to_emp; ?></span></li>
                                                          <li class="list-group-item d-flex justify-content-between align-items-center">Address<span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->guarantor_address; ?></span></li>
                                                          <li class="list-group-item d-flex justify-content-between align-items-center">Phone<span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->guarantor_phone; ?></span></li>
                                                          <li class="list-group-item d-flex justify-content-between align-items-center">Email<span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->guarantor_email; ?></span></li>
                                                         
                                                          </ul>
                                                       
                                                    </div>
                                                    
                                                  </div>
                                                  <div class="tab-pane fade p-3" id="hr" role="tabpanel" aria-labelledby="hr-tab">
                                                      <div style="font-size:0.9rem; float:left; width:100%;">
                                                          
                                                          <ul class="list-group">
                                                              <li class="list-group-item list-group-item-success d-flex justify-content-between align-items-center">Related User<span class="badge badge-light badge-pill text-dark p-2"><?php echo $staff->user_id ?></span</li>
                                                              <li class="list-group-item d-flex justify-content-between align-items-center">Gross Salary<span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->gross_salary ?></span></li>
                                                              
                                                              <li class="list-group-item d-flex justify-content-between align-items-center">App Login Privilege<span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->syscategory ?></span></li>
                                                              
                                                              <li class="list-group-item d-flex justify-content-between align-items-center">Total Work Hour<span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->working_hours; ?></span></li>
                                                              
                                                              <li class="list-group-item d-flex justify-content-between align-items-center">Annual Income<span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->gross_salary; ?></span></li>
                                                          </ul>
                                                                
                                                  </div>
                                                </div>
                                            </div>
                                               
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Guarantor Modal -->
<div class="modal fade" id="guarantormodal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="farm-color modal-header p-2">
            <p class="modal-title font-weight-bolder text-white" id="staticBackdropLabel"><span class="fa fa-user-plus"> <?php echo $staff->staffname; ?> Gurantor</span></p>
            <button type="button" class="bg-secondary px-2 border text-white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php
            $staffg = $staff->user_id;
            //echo $staffg;
            $staffguarant = Db::getInstance()->query("SELECT * FROM `staff_guarantor` WHERE user_id='$staffg'");
            foreach ($staffguarant->results() as $staffguarant) {
        ?>
        <script>
              guarantor_image.onchange = evt => {
                  const [file] = guarantor_image.files
                  if (file) {
                    blah.src = URL.createObjectURL(file);
                    
                }
              }  
                
          </script> 
        
         
         <form id="uploadForm" method="post" enctype="multipart/form-data">
             
          <div class="modal-body">
              <p class="login-card-description">
            View/Update Guarantor</p>
                <div class="row mt-0 mb-3 pt-0">
                    <div class="col-sm-12 alert alert-success m-0 success_alert"></div>
                    <div class="col-sm-12 alert alert-warning m-0 warning_alert"></div>
                 </div>
          
           <div class="row">
                    <div class="col-sm-3">
                        <div class="image-upload">
                            <label for="guarantor_image">
                                <?php if (!empty($staffguarant->guarantor_image)) {
                                    echo '<img id="blah" src="view/usermanager/staff/' . $staffguarant->guarantor_image . '" class="img-thumbnail border" alt=""><p style="text-align:center"><p style="text-align:center">' . $staffguarant->guarantor_fullname . '</p>';
                                } else {
                                     echo '<img id="blah" class="img-thumbnail border" src="view/usermanager/staff/add_user_icon.jpg" alt="" /><p style="text-align:center">Guarantor</p>';
                                } ?>
                                </label>
                                <input accept="image/*" id="guarantor_image" name="guarantor_image" type="file" class="d-none" />
                                </div>
                        </div>
                    
                <div class="col-sm-9">
                    <div class="row">
                      <div class="form-group col-sm-12">
                    <label for="guarantor_fullname">Guarantor Fullname</label>
                    <input type="text" class="form-control" id="guarantor_fullname" name="guarantor_fullname" value="<?php echo $staffguarant->guarantor_fullname; ?>" placeholder="Guarantor Fullname">
                    </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-sm-6">
                        <label for="guarantor_email">Email</label>
                        <input type="email" class="form-control" id="guarantor_email" name="guarantor_email" value="<?php echo $staffguarant->guarantor_email; ?>" placeholder="Guarantor Email">
                      </div>
                      <div class="form-group col-sm-6">
                        <label for="guarantor_phone">Phone</label>
                        <input type="phone" class="form-control" id="guarantor_phone" name="guarantor_phone" value="<?php echo $staffguarant->guarantor_phone; ?>" placeholder="Guarantor Phone">
                      </div>
                     </div>
            </div>
            </div>
              <div class="row">
              <div class="form-group col-sm-12">
                  <label for="guarantor_address">Guarantor Address</label>
                  <textarea class="form-control" id="guarantor_address" name="guarantor_address" rows="3" placeholder="Guarantor Address"><?php echo $staffguarant->guarantor_address; ?></textarea>
              </div>

              </div>
            <div class="row">
                <div class="form-group col-sm-6">
                <label for="relation_to_emp"> Relation to Employee</label>
                <input type="text" class="form-control" id="relation_to_emp" name="relation_to_emp" value="<?php echo $staffguarant->relation_to_emp; ?>" placeholder="Relation to Employee">
              </div>
               <div class="form-group col-sm-6">
                <label for="guarantor_occupation">Occupation</label>
                <input type="text" class="form-control" id="guarantor_occupation" name="guarantor_occupation" value="<?php echo $staffguarant->guarantor_occupation; ?>" placeholder="Guarantor Occupation">
                
              </div>
              
            </div> 
            
          
          <input type="hidden" value="<?php echo $staffguarant->user_id; ?>" id="user_id" name="user_id" />
      <input type="hidden" value="<?php echo $staffguarant->id; ?>" id="id" name="id" />
    </div>
      <div class="modal-footer">
        <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0" data-dismiss="modal">Close</button>
        <button type="button" class="py-1 px-2 border farm-color mx-0 SaveGuarantor">Update</button>
      </div>
      </form>
      <?php
                                                            }
      ?>
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
    <?php
                        }
                    }
   

} else {
  $user->logout();
  Redirect::to('../../login/');
}


?>